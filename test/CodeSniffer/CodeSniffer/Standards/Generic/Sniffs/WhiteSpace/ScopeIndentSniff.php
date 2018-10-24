<?php
/**
 * Generic_Sniffs_Whitespace_ScopeIndentSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Generic_Sniffs_Whitespace_ScopeIndentSniff.
 *
 * Checks that control structures are structured correctly, and their content
 * is indented correctly. This sniff will throw errors if tabs are used
 * for indentation rather than spaces.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: 2.0.0RC2
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Generic_Sniffs_WhiteSpace_ScopeIndentSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Does the indent need to be exactly right.
     *
     * If TRUE, indent needs to be exactly $indent spaces. If FALSE,
     * indent needs to be at least $indent spaces (but can be more).
     *
     * @var bool
     */
    public $exact = false;

    /**
     * List of tokens not needing to be checked for indentation.
     *
     * Useful to allow Sniffs based on this to easily ignore/skip some
     * tokens from verification. For example, inline html sections
     * or php open/close tags can escape from here and have their own
     * rules elsewhere.
     *
     * @var array
     */
    public $ignoreIndentationTokens = array();

    /**
     * Any scope openers that should not cause an indent.
     *
     * @var int[]
     */
    protected $nonIndentingScopes = array();

    /**
     * Stores the indent of the PHP open tags we found.
     *
     * This value is used to calculate the expected indent of top level structures
     * so we don't assume they are always at column 1. If PHP code is embedded inside
     * HTML (etc.) code, then the starting column for that code may not be column 1.
     *
     * @var int[]
     */
    private $_openTagIndents = array();

    /**
     * Stores the indent of the PHP close tags we found.
     *
     * This value is used to calculate the expected indent of top level structures
     * so we don't assume they are always at column 1. If PHP code is embedded inside
     * HTML (etc.) code, then the starting column for that code may not be column 1.
     *
     * @var int[]
     */
    private $_closeTagIndents = array();

    /**
     * The current file that we are processing.
     *
     * @var string
     */
    protected $currentFile = '';


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $tokens   = PHP_CodeSniffer_Tokens::$scopeOpeners;
        $tokens[] = T_OPEN_TAG;
        $tokens[] = T_OPEN_TAG_WITH_ECHO;
        $tokens[] = T_CLOSE_TAG;
        return $tokens;

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $fileName = $phpcsFile->getFilename();
        if ($this->currentFile !== $fileName) {
            $this->currentFile      = $fileName;
            $this->_openTagIndents  = array();
            $this->_closeTagIndents = array();
        }

        $tokens = $phpcsFile->getTokens();

        // We only want to record the indent of open tags, not process them.
        if ($tokens[$stackPtr]['code'] == T_OPEN_TAG
            || $tokens[$stackPtr]['code'] == T_OPEN_TAG_WITH_ECHO
        ) {
            $indent = ($tokens[$stackPtr]['column'] - 1);
            if (empty($this->_closeTagIndents) === false
                && $indent === $this->_closeTagIndents[0]
            ) {
                array_shift($this->_closeTagIndents);
            } else {
                array_unshift($this->_openTagIndents, $indent);
            }

            return;
        }

        if ($tokens[$stackPtr]['code'] == T_CLOSE_TAG) {
            $indent = ($tokens[$stackPtr]['column'] - 1);
            if ($indent === $this->_openTagIndents[0]) {
                array_shift($this->_openTagIndents);
            } else {
                array_unshift($this->_closeTagIndents, $indent);
            }

            return;
        }

        // If this is an inline condition (ie. there is no scope opener), then
        // return, as this is not a new scope.
        if (isset($tokens[$stackPtr]['scope_opener']) === false) {
            return;
        }

        if ($tokens[$stackPtr]['code'] === T_ELSE) {
            $next = $phpcsFile->findNext(
                PHP_CodeSniffer_Tokens::$emptyTokens,
                ($stackPtr + 1),
                null,
                true
            );

            // We will handle the T_IF token in another call to process.
            if ($tokens[$next]['code'] === T_IF) {
                return;
            }
        }

        // Find the first token on this line.
        $firstToken = $stackPtr;
        for ($i = $stackPtr; $i >= 0; $i--) {
            // Record the first code token on the line.
            if (isset(PHP_CodeSniffer_Tokens::$emptyTokens[$tokens[$i]['code']]) === false) {
                $firstToken = $i;
            }

            // It's the start of the line, so we've found our first php token.
            if ($tokens[$i]['column'] === 1) {
                break;
            }
        }

        $scopeOpener = $tokens[$stackPtr]['scope_opener'];
        $scopeCloser = $tokens[$stackPtr]['scope_closer'];

        // Based on the conditions that surround this token, determine the
        // indent that we expect this current content to be.
        $expectedIndent = $this->calculateExpectedIndent($tokens, $firstToken);

        // Don't process the first token if it is a closure because they have
        // different indentation rules as they are often used as function arguments
        // for multi-line function calls. But continue to process the content of the
        // closure because it should be indented as normal.
        if ($tokens[$firstToken]['code'] !== T_CLOSURE
            && $tokens[$firstToken]['column'] !== $expectedIndent
        ) {
            // If the scope opener is a closure but it is not the first token on the
            // line, then the first token may be a variable or array index as so
            // should not require exact indentation unless the exact member var
            // is set to TRUE.
            $exact = true;
            if ($tokens[$stackPtr]['code'] === T_CLOSURE) {
                $exact = $this->exact;
            }

            if ($exact === true || $tokens[$firstToken]['column'] < $expectedIndent) {
                $error = 'Line indented incorrectly; expected %s spaces, found %s';
                $data  = array(
                          ($expectedIndent - 1),
                          ($tokens[$firstToken]['column'] - 1),
                         );

                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Incorrect', $data);
                if ($fix === true) {
                    $diff = ($expectedIndent - $tokens[$firstToken]['column']);
                    if ($diff > 0) {
                        $spaces = str_repeat(' ', ($expectedIndent - 1));
                        $phpcsFile->fixer->replaceToken(($firstToken - 1), $spaces);
                    } else {
                        // We need to remove some padding, but we'll do it for all lines
                        // until the end of this code block if the exact flag is not on
                        // or else the rest of the block will look out of place, but
                        // not cause any errors to be generated. But do not change the
                        // indent of the closing brace as other sniffs check this.
                        $phpcsFile->fixer->beginChangeset();
                        $phpcsFile->fixer->substrToken(($firstToken - 1), 0, $diff);
                        if ($this->exact === false) {
                            for ($i = $firstToken; $i < ($scopeCloser - 1); $i++) {
                                if ($tokens[$i]['code'] === T_WHITESPACE
                                    && $tokens[$i]['column'] === 1
                                ) {
                                    $phpcsFile->fixer->substrToken($i, 0, $diff);
                                }
                            }
                        }

                        $phpcsFile->fixer->endChangeset();
                    }//end if
                }//end if
            }//end if
        }//end if

        // Some scopes are expected not to have indents.
        if (in_array($tokens[$firstToken]['code'], $this->nonIndentingScopes) === false) {
            $indent = ($expectedIndent + $this->indent);
        } else {
            $indent = $expectedIndent;
        }

        $newline     = false;
        $commentOpen = false;
        $inHereDoc   = false;

        // Only loop over the content between the opening and closing brace, not
        // the braces themselves.
        for ($i = ($scopeOpener + 1); $i < $scopeCloser; $i++) {
            // If this token is another scope, skip it as it will be handled by
            // another call to this sniff.
            if (isset(PHP_CodeSniffer_Tokens::$scopeOpeners[$tokens[$i]['code']]) === true) {
                if (isset($tokens[$i]['scope_opener']) === true) {
                    $i = $tokens[$i]['scope_closer'];

                    // If the scope closer is followed by a semi-colon, the semi-colon is part
                    // of the closer and should also be ignored. This most commonly happens with
                    // CASE statements that end with "break;", where we don't want to stop
                    // ignoring at the break, but rather at the semi-colon.
                    $nextToken = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($i + 1), null, true);
                    if ($tokens[$nextToken]['code'] === T_SEMICOLON) {
                        $i = $nextToken;
                    }
                } else {
                    // If this token does not have a scope_opener index, then
                    // it's probably an inline scope, so let's skip to the next
                    // semicolon. Inline scopes include inline if's, abstract
                    // methods etc.
                    $nextToken = $phpcsFile->findNext(T_SEMICOLON, $i, $scopeCloser);
                    if ($nextToken !== false) {
                        $i = $nextToken;
                    }
                }//end if

                $newline = false;
                continue;
            }//end if

            // If this is a HEREDOC then we need to ignore it as the
            // whitespace before the contents within the HEREDOC are
            // considered part of the content.
            if ($tokens[$i]['code'] === T_START_HEREDOC
                || $tokens[$i]['code'] === T_START_NOWDOC
            ) {
                $inHereDoc = true;
                continue;
            } else if ($inHereDoc === true) {
                if ($tokens[$i]['code'] === T_END_HEREDOC
                    || $tokens[$i]['code'] === T_END_NOWDOC
                ) {
                    $inHereDoc = false;
                }

                continue;
            }

            if ($tokens[$i]['column'] === 1) {
                // We started a newline.
                $newline = true;
            }

            if ($newline === true && $tokens[$i]['code'] !== T_WHITESPACE && $tokens[$i]['code'] !== T_DOC_COMMENT_WHITESPACE) {
                // If we started a newline and we find a token that is not
                // whitespace, then this must be the first token on the line that
                // must be indented.
                $newline    = false;
                $firstToken = $i;

                $column = $tokens[$firstToken]['column'];

                // Ignore the token for indentation if it's in the ignore list.
                if (in_array($tokens[$firstToken]['code'], $this->ignoreIndentationTokens)
                    || in_array($tokens[$firstToken]['type'], $this->ignoreIndentationTokens)
                ) {
                    continue;
                }

                // Special case for non-PHP code.
                if ($tokens[$firstToken]['code'] === T_INLINE_HTML) {
                    $trimmedContentLength = strlen(ltrim($tokens[$firstToken]['content']));
                    if ($trimmedContentLength === 0) {
                        continue;
                    }

                    $contentLength = strlen($tokens[$firstToken]['content']);
                    $column        = ($contentLength - $trimmedContentLength + 1);
                }

                // Check to see if this constant string spans multiple lines.
                // If so, then make sure that the strings on lines other than the
                // first line are indented appropriately, based on their whitespace.
                if (isset(PHP_CodeSniffer_Tokens::$stringTokens[$tokens[$firstToken]['code']]) === true) {
                    if (isset(PHP_CodeSniffer_Tokens::$stringTokens[$tokens[($firstToken - 1)]['code']]) === true) {
                        // If we find a string that directly follows another string
                        // then its just a string that spans multiple lines, so we
                        // don't need to check for indenting.
                        continue;
                    }
                }

                // This is a special condition for C-style comments, which
                // contain whitespace between each line.
                if ($tokens[$firstToken]['code'] === T_COMMENT) {
                    $content = trim($tokens[$firstToken]['content']);
                    if (preg_match('|^/\*|', $content) !== 0) {
                        // Check to see if the end of the comment is on the same line
                        // as the start of the comment. If it is, then we don't
                        // have to worry about opening a comment.
                        if (preg_match('|\*/$|', $content) === 0) {
                            // We don't have to calculate the column for the
                            // start of the comment as there is a whitespace
                            // token before it.
                            $commentOpen = true;
                        }
                    } else if ($commentOpen === true) {
                        if ($content === '') {
                            // We are in a comment, but this line has nothing on it
                            // so let's skip it.
                            continue;
                        }

                        $contentLength        = strlen($tokens[$firstToken]['content']);
                        $trimmedContentLength = strlen(ltrim($tokens[$firstToken]['content']));

                        $column = ($contentLength - $trimmedContentLength + 1);
                        if (preg_match('|\*/$|', $content) !== 0) {
                            $commentOpen = false;
                        }

                        // We are in a comment, so the indent does not have to
                        // be exact. The important thing is that the comment opens
                        // at the correct column and nothing sits closer to the left
                        // than that opening column.
                        if ($column > $indent) {
                            continue;
                        }
                    }//end if
                }//end if

                // The token at the start of the line, needs to have its column
                // greater than the relative indent we set above. If it is less,
                // an error should be shown.
                if ($column !== $indent
                    && ($this->exact === true || $column < $indent)
                ) {
                    $type  = 'IncorrectExact';
                    $error = 'Line indented incorrectly; expected ';
                    if ($this->exact === false) {
                        $error .= 'at least ';
                        $type   = 'Incorrect';
                    }

                    $error .= '%s spaces, found %s';
                    $data   = array(
                               ($indent - 1),
                               ($column - 1),
                              );

                    $fix = $phpcsFile->addFixableError($error, $firstToken, $type, $data);
                    if ($fix === true) {
                        if ($column === 1) {
                            $phpcsFile->fixer->addContentBefore($firstToken, str_repeat(' ', ($indent - $column)));
                        } else {
                            $spaces = str_repeat(' ', ($indent - 1));
                            if ($tokens[$firstToken]['code'] === T_INLINE_HTML) {
                                $newContent = $spaces.ltrim($tokens[$firstToken]['content']);
                                $phpcsFile->fixer->replaceToken($firstToken, $newContent);
                            } else {
                                $phpcsFile->fixer->replaceToken(($firstToken - 1), $spaces);
                            }
                        }
                    }
                }//end if
            }//end if
        }//end for

    }//end process()


    /**
     * Calculates the expected indent of a token.
     *
     * Returns the column at which the token should be indented to, so 1 means
     * that the token should not be indented at all.
     *
     * @param array $tokens   The stack of tokens for this file.
     * @param int   $stackPtr The position of the token to get indent for.
     *
     * @return int
     */
    protected function calculateExpectedIndent(array $tokens, $stackPtr)
    {
        $conditionStack = array();

        $inParenthesis = false;
        if (isset($tokens[$stackPtr]['nested_parenthesis']) === true
            && empty($tokens[$stackPtr]['nested_parenthesis']) === false
        ) {
            $inParenthesis = true;
        }

        // Empty conditions array (top level structure).
        if (empty($tokens[$stackPtr]['conditions']) === true) {
            if ($inParenthesis === true) {
                // Wrapped in parenthesis means it is probably in a
                // function call (like a closure) so we have to assume indent
                // is correct here and someone else will check it more
                // carefully in another sniff.
                return $tokens[$stackPtr]['column'];
            } else {
                return ($this->_openTagIndents[0] + 1);
            }
        }

        $indent = 0;

        $tokenConditions = $tokens[$stackPtr]['conditions'];
        foreach ($tokenConditions as $id => $condition) {
            // If it's not an indenting scope i.e., it's in our array of
            // scopes that don't indent, skip it.
            if (in_array($condition, $this->nonIndentingScopes) === true) {
                continue;
            }

            if ($condition === T_CLOSURE) {
                // Closures cause problems with indents because the code inside them
                // is not technically inside the function yet, so the indent
                // is always off by one. So instead, use the
                // indent of the closure as the base value.
                $lastContent = $id;
                for ($i = ($id - 1); $i > 0; $i--) {
                    if ($tokens[$i]['line'] !== $tokens[$id]['line']) {
                        // Changed lines, so the last content we saw is what
                        // we want.
                        break;
                    }

                    if (in_array($tokens[$i]['code'], PHP_CodeSniffer_Tokens::$emptyTokens) === false) {
                        $lastContent = $i;
                    }
                }

                $indent = ($tokens[$lastContent]['column'] - 1);
            }//end if

            $indent += $this->indent;
        }//end foreach

        // Take the indent of the open tag into account.
        if ($this->_openTagIndents[0] > $indent) {
            $indent = $this->_openTagIndents[0];
        } else {
            $indent += $this->_openTagIndents[0];
        }

        // Increase by 1 to indiciate that the code should start at a specific column.
        // E.g., code indented 4 spaces should start at column 5.
        $indent++;

        return $indent;

    }//end calculateExpectedIndent()


}//end class

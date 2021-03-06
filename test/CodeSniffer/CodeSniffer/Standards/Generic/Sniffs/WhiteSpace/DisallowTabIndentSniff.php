<?php
/**
 * Generic_Sniffs_WhiteSpace_DisallowTabIndentSniff.
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
 * Generic_Sniffs_WhiteSpace_DisallowTabIndentSniff.
 *
 * Throws errors if tabs are used for indentation.
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
class Generic_Sniffs_WhiteSpace_DisallowTabIndentSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                   'JS',
                                   'CSS',
                                  );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_OPEN_TAG);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $error  = 'Spaces must be used to indent lines; tabs are not allowed';

        for ($i = ($stackPtr + 1); $i < $phpcsFile->numTokens; $i++) {
            if ($tokens[$i]['column'] !== 1 || $tokens[$i]['code'] !== T_WHITESPACE) {
                continue;
            }

            // If tabs are being converted to spaces, the original content
            // should be used instead of the converted content.
            if (isset($tokens[$i]['orig_content']) === true) {
                $content = $tokens[$i]['orig_content'];
            } else {
                $content = $tokens[$i]['content'];
            }

            $tabFound = false;
            if ($content[0] === "\t") {
                $phpcsFile->recordMetric($i, 'Line indent', 'tabs');
                $tabFound = true;
            } else if ($content[0] === ' ') {
                if (strpos($content, "\t") !== false) {
                    $phpcsFile->recordMetric($i, 'Line indent', 'mixed');
                    $tabFound = true;
                } else {
                    $phpcsFile->recordMetric($i, 'Line indent', 'spaces');
                }
            }
 
            if ($tabFound === false) {
                continue;
            }

            $fix = $phpcsFile->addFixableError($error, $i, 'TabsUsed');
            if ($fix === true) {
                // Replace tabs with spaces, using an indent of 4 spaces.
                // Other sniffs can then correct the indent if they need to.
                $newContent = str_replace("\t", '    ', $tokens[$i]['content']);
                $phpcsFile->fixer->replaceToken($i, $newContent);
            }
        }//end for

        // Ignore the rest of the file.
        return ($phpcsFile->numTokens + 1);

    }//end process()


}//end class

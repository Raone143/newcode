<?php print_r($_POST);?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="padding: 0; margin: 0;">
<input type="hidden" name="cmd" value="_xclick/" />
<input type="hidden" name="business" value="surya.merchant@gmail.com" />
<input type="hidden" name="quantity" value="1" />
<input type="hidden" name="item_name" value="Surya" />
<input type="hidden" name="item_number" value="1" />
<input type="hidden" name="amount" value="30" />
<input type="hidden" name="shipping" value="0" />
<input type="hidden" name="no_note" value="It is for testing" />
<!--<input type="hidden" name="notify_url" value="Your notify url">-->
<input type="hidden" name="currency_code" value="INR" />
<input type="hidden" name="return" value="<?php echo "http://localhost/test/c.php";?>">
<input type="submit" name="submit" id="submit" value="submit"/>
</form>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="surya.merchant@gmail.com">
<input type="hidden" name="item_name" value="hat">
<input type="hidden" name="item_number" value="123">
<input type="hidden" name="amount" value="15.00">
<input type="hidden" name="first_name" value="John">
<input type="hidden" name="last_name" value="Doe">
<input type="hidden" name="address1" value="9 Elm Street">
<input type="hidden" name="address2" value="Apt 5">
<input type="hidden" name="city" value="Berwyn">
<input type="hidden" name="state" value="PA">
<input type="hidden" name="zip" value="19312">
<input type="hidden" name="night_phone_a" value="610">
<input type="hidden" name="night_phone_b" value="555">
<input type="hidden" name="night_phone_c" value="1234">
<input type="hidden" name="email" value="surya@gmail.com">
<input type="hidden" name="return" value="<?php echo "http://localhost/test/c.php";?>">
<input type="image" name="submit" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">
</form>

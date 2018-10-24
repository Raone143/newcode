<select name="nakshtra" id="nakshtra">
	<option alt="Anuradha / Anusham / Anizham"
		title="Anuradha / Anusham / Anizham" value="17">Anuradha / Anusham /
		Anizham</option>
	<option alt="Ardra / Thiruvathira" title="Ardra / Thiruvathira"
		value="6">Ardra / Thiruvathira</option>
	<option alt="Ashlesha / Ayilyam" title="Ashlesha / Ayilyam" value="9">Ashlesha
		/ Ayilyam</option>
	<option alt="Ashwini / Ashwathi" title="Ashwini / Ashwathi" value="1">Ashwini
		/ Ashwathi</option>
	<option alt="Bharani" title="Bharani" value="2">Bharani</option>
	<option alt="Chitra / Chitha" title="Chitra / Chitha" value="14">Chitra
		/ Chitha</option>
	<option alt="Dhanista / Avittam" title="Dhanista / Avittam" value="23">Dhanista
		/ Avittam</option>
	<option alt="Hastha / Atham" title="Hastha / Atham" value="13">Hastha /
		Atham</option>
	<option alt="Jyesta / Kettai" title="Jyesta / Kettai" value="18">Jyesta
		/ Kettai</option>
	<option alt="Krithika / Karthika" title="Krithika / Karthika" value="3">Krithika
		/ Karthika</option>
	<option alt="Makha / Magam" title="Makha / Magam" value="10">Makha /
		Magam</option>
	<option alt="Moolam / Moola" title="Moolam / Moola" value="19">Moolam /
		Moola</option>
	<option alt="Mrigasira / Makayiram" title="Mrigasira / Makayiram"
		value="5">Mrigasira / Makayiram</option>
	<option alt="Poorvabadrapada / Puratathi"
		title="Poorvabadrapada / Puratathi" value="25">Poorvabadrapada /
		Puratathi</option>
	<option alt="Poorvapalguni / Puram / Pubbhe"
		title="Poorvapalguni / Puram / Pubbhe" value="11">Poorvapalguni /
		Puram / Pubbhe</option>
	<option alt="Poorvashada / Pooradam" title="Poorvashada / Pooradam"
		value="20">Poorvashada / Pooradam</option>
	<option alt="Punarvasu / Punarpusam" title="Punarvasu / Punarpusam"
		value="7">Punarvasu / Punarpusam</option>
	<option alt="Pushya / Poosam / Pooyam" title="Pushya / Poosam / Pooyam"
		value="8">Pushya / Poosam / Pooyam</option>
	<option alt="Revathi" title="Revathi" value="27">Revathi</option>
	<option alt="Rohini" title="Rohini" value="4">Rohini</option>
	<option alt="Shatataraka / Sadayam / Satabishek"
		title="Shatataraka / Sadayam / Satabishek" value="24">Shatataraka /
		Sadayam / Satabishek</option>
	<option alt="Shravan / Thiruvonam" title="Shravan / Thiruvonam"
		value="22">Shravan / Thiruvonam</option>
	<option alt="Swati / Chothi" title="Swati / Chothi" value="15">Swati /
		Chothi</option>
	<option alt="Uttarabadrapada / Uthratadhi"
		title="Uttarabadrapada / Uthratadhi" value="26">Uttarabadrapada /
		Uthratadhi</option>
	<option alt="Uttarapalguni / Uthram" title="Uttarapalguni / Uthram"
		value="12">Uttarapalguni / Uthram</option>
	<option alt="Uttarashada / Uthradam" title="Uttarashada / Uthradam"
		value="21">Uttarashada / Uthradam</option>
	<option alt="Vishaka / Vishakam" title="Vishaka / Vishakam" value="16">Vishaka
		/ Vishakam</option>
</select>

<script>
var ele = document.getElementById('nakshtra');
var logs = "array(";
var length = ele.children.length
for(var i=0; i<length;i++) {
    var v = ele.children[i].value;
	var t = ele.children[i].text;

	logs += "'"+v+"'=>";
	logs += "'"+t+"',";
	
	          
}

logs += ")";
document.writeln(logs);  
</script>
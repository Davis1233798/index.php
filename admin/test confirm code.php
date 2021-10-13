<?php session_start(); ?>
<body>
<img id="captcha" src="'site_path'/securimage/securimage_show.php" alt="CAPTCHA Image" />

<input type="text" name="captcha_code" size="10" maxlength="6" />

<a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
</body>
<?php
	$db = new PDO('mysql:host=localhost;dbname=odiet_db;charset=utf8', 'odiet_dbu', 'ODiet3068*');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
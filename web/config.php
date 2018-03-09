<?php
$config = json_decode(file_get_contents('config'), true);

if (!defined('DB_HOST')) define('DB_HOST', $config.db.host);
if (!defined('DB_USER')) define('DB_USER', $config.db.user);
if (!defined('DB_PASS')) define('DB_PASS', $config.db.pass);
if (!defined('DB_NAME')) define('DB_NAME', $config.db.name);
if (!defined('DB_CHAR')) define('DB_CHAR', $config.db.char);
require('db.php');
?>

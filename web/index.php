<?php
require('config.php');

$stmt = Database::run("SELECT * FROM table")->fetch();


?>

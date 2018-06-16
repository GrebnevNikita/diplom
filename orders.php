<?php
// Include config file
include_once 'config.php';
include_once "header.php";
session_start();
if (!empty($_SESSION['login_user'])) {

// sql вывести заказы ссылками
	// каждый заказ внутри редактировать можно, менять статус и удалять.
}

include_once "footer.php";
?>



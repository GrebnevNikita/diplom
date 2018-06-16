<?
if (session_id() == '' || !isset($_SESSION)) {
	session_start();
}

$product_id = $_POST['product_id'];

if (!empty($_SESSION['products'][$product_id])) {
	unset($_SESSION['products'][$product_id]);
}

?>
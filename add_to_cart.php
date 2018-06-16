<?
if (session_id() == '' || !isset($_SESSION)) {
	session_start();
}

$product_id = $_POST['product_id'];

if (!empty($_SESSION['products'][$product_id])) {
	$_SESSION['products'][$product_id]['count']++;
} else {
	$_SESSION['products'][$product_id] = array();
	$_SESSION['products'][$product_id]['count'] = 1;
}

?>
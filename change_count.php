<?
if (session_id() == '' || !isset($_SESSION)) {
	session_start();
}

$product_id = $_POST['product_id'];
$product_count = $_POST['product_count'];

if (!empty($_SESSION['products'][$product_id])) {
	$_SESSION['products'][$product_id]['count'] = $product_count;
}
?>
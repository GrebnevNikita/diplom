<?php
include_once "header.php";

$Entity_Id = "0";

// print_r($_SESSION['products']);
if (!empty($_SESSION['products'])) {
	foreach ($_SESSION['products'] as $key => $value) {
		$Entity_Id = $Entity_Id . ',' . $key;

	}
}

$Summ = 0;

$sql = "SELECT  id,name,  price,  img_path FROM entity where id in (" . $Entity_Id . ")";
// echo $sql;

echo "
<form id=\"approve_and_send\" action=\"/approve_and_send.php\" method=\"post\"></form>
<h2>Пожалуйста, запоните все поля формы</h2>
<p>Имя:
    <input name=\"Fname\" form=\"approve_and_send\" value=\"" . $_POST['Fname'] . "\">
</p>
<p>Email:
    <input name=\"email\" form=\"approve_and_send\" value=\"" . $_POST['email'] . "\">
</p>
<p> Телефон:
    <input name=\"phone\" class=\"phone\" type=\"number\" value=\"" . $_POST['phone'] . "\" form=\"approve_and_send\" >
</p>
<p>
    <input type=\"submit\" value=\"Подтвердить заказ\" form=\"approve_and_send\"> </p>";
$result3 = $link->query($sql);
if ($result3->num_rows > 0) {

	echo "<div class=\"row\">";

	while ($row = $result3->fetch_assoc()) {
		$Summ = $Summ + (int) $row["price"] * (int) $_SESSION['products'][$row["id"]]["count"];
		echo "

   <div class=\"cart_entity\" id=\"cart_block_" . $row["id"] . "\">
<a href=\"/entity.php?entity=" . $row["id"] . "\">
   	<div class=\"image\" style=\" background: url(/img/" . $row["img_path"] . ");\" ></div>
            <div class=\"name\">" . $row["name"] . "</div>  </a>
            <div class=\"price\">" . $row["price"] . " <i class=\"fa fa-rub\"></i></div>
   	 <input class=\"count\"  onchange=\"change_count(" . $row["id"] . ",this)\"  type=\"number\" value=\"" . $_SESSION['products'][$row["id"]]["count"] . "\" >
   	 <div class=\"btn  btn-danger removeFromCart\" onclick=\"remove_from_cart('" . $row["id"] . "')\" >X</div>

   		</div>
   		</br>
            ";
	}

	echo "</div>";
}

if (empty($_SESSION['products'])) {
	echo 'Ваша корзина пуста';
} else {
	echo '<p class="summ">Товаров в корзине на сумму ' . $Summ . '<i class="fa fa-rub"></i></p>

	';
}
$link->close();
?>



        <?php
include_once "footer.php";
?>



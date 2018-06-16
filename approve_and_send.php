<?php
include_once "header.php";

$Entity_Id = "0";

$Fname = $_POST['Fname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$milliseconds = round(microtime(true) * 1000) . "";
$_SESSION['order_id'] = $milliseconds;

if (!empty($_SESSION['products'])) {
	foreach ($_SESSION['products'] as $key => $value) {
		$Entity_Id = $Entity_Id . ',' . $key;

	}
}

$Summ = 0;

$sql = "SELECT  id,name,  price,  img_path FROM entity where id in (" . $Entity_Id . ")";
// echo $sql;
$VALUES = "";
$result3 = $link->query($sql);
if ($result3->num_rows > 0) {

	echo "<div class=\"row\">";

	while ($row = $result3->fetch_assoc()) {
		$Summ = $Summ + (int) $row["price"] * (int) $_SESSION['products'][$row["id"]]["count"];

		$VALUES = $VALUES . $row["id"] . "t" . $_SESSION['products'][$row["id"]]["count"] . "z";
		echo "
   <div class=\"cart_entity\" id=\"cart_block_" . $row["id"] . "\">
	<a href=\"/entity.php?entity=" . $row["id"] . "\">
   	<div class=\"image\" style=\" background: url(/img/" . $row["img_path"] . ");\" ></div>
            <div class=\"name\">" . $row["name"] . "</div>  </a>
            <div class=\"price\">" . $row["price"] . " <i class=\"fa fa-rub\"></i></div>
   	 <div class=\"count_div\">" . $_SESSION['products'][$row["id"]]["count"] . "</div>

   		</div>
   		</br>
            ";

	}
	$VALUES = substr($VALUES, 0, -1);
	echo "</div>";
}
if (!empty($_SESSION['products'])) {
	$sql2 = "INSERT INTO orders (id,ordered_ids_and_count,order_name,order_phone,order_email,order_state)
	VALUES ("
		. $milliseconds . ","
		. $VALUES . ",\""
		. $Fname . "\",\""
		. $email . "\",\""
		. $phone . "\",0)";

	echo $sql2;
	$result4 = $link->query($sql2);

	echo '<p>Ваш заказ №<strong>' . $milliseconds . '"</strong>, на сумму  <strong>' . $Summ . '</strong><i class="fa fa-rub"></i>, успешно зарегистрирован, копия отправлена на email, ждите ответа администратора по телефону <strong>' . $phone . '"</strong> или на email <strong>' . $email . '"</strong></p>';
	unset($_SESSION['products']);
} else {
	echo '<p>Корзина пуста</p>';
}

$link->close();
?>



        <?php
include_once "footer.php";
?>



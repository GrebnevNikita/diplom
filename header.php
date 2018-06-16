    <?php
include_once "config.php";
?>

<!DOCTYPE html>
<html lang="ru-ru">

<head>
    <base href="http://the-beautiful-creation.ru/" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="rights" content="Рыболобик" />
    <meta name="description" content="Магазин рыболовных товаров" />
    <title>Рыболовный магазин "Рыболобик"</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- META FOR IOS & HANDHELD -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <!-- LINK FOR FAVICON -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
    <!-- Suport IE8: media query, html5 -->
    <script src="" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="css/jquery.mmenu.all.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
 <script src="js/jquery-noconflict.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script   src="functions.js" type="text/javascript"></script>


</head>

<body id="" class="">
    <div id="header">
        <div class="row">
            <div class="col-md-4"><a href="/"><img src="img/logo.png"></a></div>
            <div class="col-md-4">Адрес: Санкт-Петербург, Заневский пр. д.71, "Заневский каскад 2", 1-й этаж, секция 1-12 м. Ладожская</div>
            <div class="col-md-4">
                <a href=""><i class="fa fa-vk fa-3" style="font-size: 27px; padding: 0px 5px;"></i></a>
                <br>
                <a href="tel:+7812292-20-60">+7(812) <strong>292-20-60</strong></a>
            </div>
        </div>
        <div id="menu">
            <div class="menu-icon"><i class="fa fa-bars fa-3" aria-hidden="true"></i></div>
            <div class="divUL">
             <a  class="first_a" href="catalog.php">Каталог</a>

<div class="menu_catalog">


<?php
if (session_id() == '' || !isset($_SESSION)) {
	// session isn't started
	session_start();
}
// Check connection
if ($link->connect_error) {
	die("Connection failed: " . $link->connect_error);
}
$sql = "SELECT  id,parent_id,description FROM categories";
$result = $link->query($sql);

while ($row = $result->fetch_assoc()) {

	$new_array_menu[$row['id']]['id'] = $row['id'];
	$new_array_menu[$row['id']]['parent_id'] = $row['parent_id'];
	$new_array_menu[$row['id']]['description'] = $row['description'];

}
$sql = "SELECT  category , COUNT(category) FROM entity group by category";
$result2 = $link->query($sql);

while ($row2 = $result2->fetch_assoc()) {
	$new_array_count[$row2['category']]['COUNT(category)'] = $row2['COUNT(category)'];
	$new_array_count[$row2['category']]['category'] = $row2['category'];

}

function get_cat($args_1, $args_2, $args_3) {
	echo '<ul> ';

	foreach ($args_1 as $catt) {
		if (($catt["parent_id"]) == ($args_2)) {

			// if (is_array($args_3[$catt['id']]) && ($args_3[$catt['id']]['COUNT(category)'] > 0)) {
			echo '<li><a href="/catalog.php?category=' . $args_3[$catt["id"]]['COUNT(category)'] . '"> ' . $catt["description"] . '</a> ';
			// } else {
			// 	echo '<li>' . $catt["description"];
			// }

			unset($args_1[$catt["id"]]);
			echo '</li>';
			get_cat($args_1, $catt["id"], $args_3);
		}
	}
	echo '</ul> ';

}
get_cat($new_array_menu, 0, $new_array_count);

?>



</div>


                <a href="">Новости</a>
                <a href="pay.php">Доставка</a>
                 <a href="pay.php">Оплата</a>
                <a href="dostavka.php">Акции</a>
                <a href="contacts.php">Контакты</a>
                <a href="o_nas.php">О нас</a>
            </div>
        </div>
    </div>

    <div id="content">



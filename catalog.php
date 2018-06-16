    <?php
include_once "header.php";
// include_once "add_to_cart.php";
?>
<?php
session_start();
if (!empty($_SESSION['login_user'])) {
	echo ' <a href="/new_entiy.php">Новый товар</a>';
}
// Check connection
// if ($link->connect_error) {
// 	die("Connection failed: " . $link->connect_error);
// }

// $sql = "SELECT  id,parent_id,description FROM categories";
// $result = $link->query($sql);

// while ($row = $result->fetch_assoc()) {

// 	$new_array_menu[$row['id']]['id'] = $row['id'];
// 	$new_array_menu[$row['id']]['parent_id'] = $row['parent_id'];
// 	$new_array_menu[$row['id']]['description'] = $row['description'];

// }

// $sql = "SELECT  category , COUNT(category) FROM entity group by category";
// $result2 = $link->query($sql);
// while ($row2 = $result2->fetch_assoc()) {
// 	$new_array_count[$row2['category']]['COUNT(category)'] = $row2['COUNT(category)'];
// 	$new_array_count[$row2['category']]['category'] = $row2['category'];

// }

// function get_cat($args_1, $args_2, $args_3) {
// 	echo '<ul> ';

// 	foreach ($args_1 as $catt) {
// 		if (($catt["parent_id"]) == ($args_2)) {

// 			if (is_array($args_3[$catt['id']]) && ($args_3[$catt['id']]['COUNT(category)'] > 0)) {
// 				echo '<li><a href="/catalog.php?category=' . $args_3[$catt["id"]]['COUNT(category)'] . '"> ' . $catt["description"] . '</a> (' . $args_3[$catt["id"]]['COUNT(category)'] . ')';
// 			} else {

// 				echo '<li>' . $catt["description"];

// 			}

// 			unset($args_1[$catt["id"]]);
// 			echo '</li>';
// 			get_cat($args_1, $catt["id"], $args_3);
// 		}
// 	}
// 	echo '</ul> ';

// }
// get_cat($new_array_menu, 0, $new_array_count);

?>


<form id="search" action="/catalog.php" method="post"></form>
  <p>Название содержит:<input name="fraze" form="search" value="<?echo $_POST['fraze'] ?>">
  </p>
  <p> Цена от: <input name="price-min" class="price" type="number" form="search" value="<?echo $_POST['price-min'] ?>"> до

  <input name="price-max" type="number" class="price" form="search" value="<?echo $_POST['price-max'] ?>">

  </p>Категория:
   <select name="categories" form="search">

<?
function get_cat_select($args_1, $args_2, $args_3) {
	$flag_cat = 0;
	$parent = 0;
	foreach ($args_1 as $catt) {
		// есть ли у args_2 подкатегории
		echo $catt["parent_id"];
		if ($catt["id"] == $args_2) {
			$parent = $catt["parent_id"];
		}
		if ($catt["parent_id"] == $args_2) {
			$flag_cat = 1;
			break;
		}

	}
	if ($flag_cat == 0) {
		foreach ($args_1 as $catt2) {
			// ищим выводим все айди с родителем таким
			if ($parent == $catt2["parent_id"]) {
				echo '11111';
				unset($args_1[$catt2["id"]]);
				if ($args_2 == $_POST['categories']) {
					echo '<option value="' . $catt2["id"] . '" selected="selected" >' . $catt2["description"] . '</option>';
				} else {
					echo '<option value="' . $catt2["id"] . '" >' . $catt2["description"] . '</option>';
				}

			}

		}

	}
	foreach ($args_1 as $catt3) {
		// есть ли подкатегории
		if ($catt3["parent_id"] == $args_2) {
			$args_3 = $args_3 + 1;
			unset($args_1[$catt3["id"]]);
			echo '222';
			echo '<optgroup style="padding-left:' . $args_3 * 3 . 'px;" label="' . $catt3["description"] . '"> ';
			get_cat_select($args_1, $catt3["id"], $catt3["description"], $args_3);
			echo '</optgroup> ';

		}
	}

}

get_cat_select($new_array_menu, 0, 0);
?>

</select>
 <br><br>
  <p><input type="submit" value="Поиск"  form="search"> </p>

<?
// echo $_POST['fraze'];
// echo $_POST['price-min'];
// echo $_POST['price-max'];
// echo $_POST['categories'];
// echo $_GET['category'];

if ($_GET["category"] > 0) {
	$categorySql = "category=" . $_GET["category"] . " and ";

} else if ($_POST['categories'] != null) {
	$categorySql = "category=" . $_POST['categories'] . " and ";
} else {
	$categorySql = "";
}

if (($_POST['price-min'] >= 0 && $_POST['price-min'] >= 0) && ($_POST['price-min'] < $_POST['price-max'])) {
	$priceSql = " price>=" . $_POST['price-min'] . " and price<=" . $_POST['price-max'] . " and ";
} else {
	$priceSql = "";
}

$sql = "SELECT  id,name, description, price, count, img_path FROM entity where " . $categorySql . $priceSql . " name LIKE '%" . $_POST['fraze'] . "%'";
// echo $sql;

if (session_status() == PHP_SESSION_ACTIVE) {
	// echo 'Session is active';
}
// $_SESSION['products']['2']['price'] = $_SESSION['products']['2']['price'] + 2;
// $_SESSION['products']['2']['count']++;
// print_r($_SESSION);
// echo "string\n";
// echo "string\n";
// echo count($_SESSION['products']);

$result3 = $link->query($sql);
if ($result3->num_rows > 0) {

	echo "<div class=\"row\">";

	while ($row = $result3->fetch_assoc()) {
		echo "<div class=\"col-md-4 col-sm-6\">";

		echo "<div class=\"entity\">
		<a href=\"/entity.php?entity=" . $row["id"] . "\">
            <div class=\"image\" style=\" background: url(/img/" . $row["img_path"] . ");\" ></div>
            <div class=\"notToOverflow\">
            <h3 class=\"name\">" . $row["name"] . "</h3>
            </div>
            </a>
            <div  class=\" btn btn-warning addToCart\"  onclick=\"add_to_cart('" . $row["id"] . "')\" >В корзину</div>
            <div class=\"price\">" . $row["price"] . " <i class=\"fa fa-rub\"></i></div>";
		if (!empty($_SESSION['login_user'])) {
			echo ' <div onclick="remove_enrity(' . $row["id"] . ')">Удалить</div>
			<a href="/edit_entiry.php?id_edit=' . $row["id"] . '">Редактировать</a>';
		}

		echo "</div></div>";
	}
	echo "</div";
} else {
	echo "Поиск не дал результатов";
}
$link->close();
?>
   <?php
include_once "footer.php";
?>
<!-- // <div class=\"image\" style=\" background: url(/img/" . $row["img_path"] . ");\" ><img src=\"/img/" . $row["img_path"] . "\"></div> -->
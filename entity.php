
            <?php
include_once "header.php";

$Entity_Id = $_GET['entity'];

$sql = "SELECT  id,name, description, price, count, img_path FROM entity where id=" . $Entity_Id . "";
// echo $sql;

$result3 = $link->query($sql);
if ($result3->num_rows > 0) {

	echo "<div class=\"row\">";

	while ($row = $result3->fetch_assoc()) {
		echo "<div class=\"col-md-4 col-sm-12\">

   <div class=\"entity\">
   <div class=\"image\" style=\" background: url(/img/" . $row["img_path"] . ");\" ></div>
  <div class=\"addToCart\">" . $row["id"] . "</div>
            <div class=\"price\">" . $row["price"] . " <i class=\"fa fa-rub\"></i></div>
            <div  class=\" btn btn-warning addToCart\"  onclick=\"add_to_cart('" . $row["id"] . "')\" >В корзину</div>
     </div>
   </div>";

		echo "<div class=\"col-md-8 col-sm-12\">";
		echo "
            <h3 class=\"name\">" . $row["name"] . "</h3>
            <div class=\"description\">" . $row["description"] . "</div>";
		echo "</div>";
	}

	echo "</div>";
} else {
	echo "Поиск не дал результатов";
}
$link->close();
?>



        <?php
include_once "footer.php";
?>

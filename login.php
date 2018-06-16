<?php
// Include config file
include_once 'config.php';
include_once "header.php";
session_start();
// Store Session Data

if (empty($_SESSION['login_user'])) {
	$_SESSION['login_user'] = $_POST['username'];

}
if (empty($_SESSION['login_user'])) {
	echo '
    <div class="wrapper">
        <form id="login_in" action="/login.php" method="post">
                 <p>Логин</label></p>
                <p> <input form="login_in" type="text" name="username" class="form-control" ></p>
                <p> <label>Пароль</label></p>
                <p> <input form="login_in" type="password" name="password" class="form-control"></p>
               <p>  <input form="login_in" type="submit" class="btn btn-primary" value="Войти"></p>
        </form>
    </div>
    ';

} else {
	echo '
 <form id="login_out" action="/login.php" method="post">
 <p> Здравствуй ' . $_SESSION["login_user"] . ',</p>
                <p> <input onclick="logout()"; form="login_out" type="submit" class="btn btn-primary" value="Выйти"></p>
            </form>



            </br>
            <a href="/orders.php">Заказы</a>
';
}

// $_POST['username'] = null;
// $_POST['password'] = null;

include_once "footer.php";
?>


<?
session_start();

include 'DB/connect.php';
include 'templates/header.php';

if (isset($_POST['login'])){

$login=$_POST['login'];
$password=md5($_POST['password']);
$result=mysqli_query($link,"SELECT login,password FROM users WHERE login='$login' && password='$password'");

if (mysqli_num_rows($result)==1){
	$_SESSION['admin']=md5('administrator');
	header('location:index.php');
}
}
if (isset($_SESSION['admin'])){
if ($_SESSION['admin']==md5('administrator')){
	
	header('location:panel.php?page=news&type=view');
}} else {
	

$head=new head;
$head->title='Панель администратора';
$head->description='';
$head->styles='index.css';
$head->js='index';
$head->header();	
	
	
echo '



<div class="index_block_0">
<form method="POST" class="f0" action="index.php">
<span class="s0">Войти в аккаунт</span>
<input placeholder="Логин" type="text" name="login">
<input placeholder="Пароль" type="password" name="password">
<div class="b1">
<input type="checkbox"><span>Запомнить</span>
<button>Войти</button>
</div>
<div class="b0"></div>
<span class="s1">Забыли пароль?</span>
<img class="i0" src="images/foxstudio_logo.png">
</form>
</div>


</body>
</html>

';
} 

?>
<?
session_start();
if (isset($_SESSION['admin'])){
if ($_SESSION['admin']==md5('administrator')){

include 'DB/connect.php';
include 'templates/header.php';

$head=new head;
$head->title='Панель администратора';
$head->description='';
$head->styles='panel.css';
$head->js='panel';
$head->header();	

include 'pages.php';//Подключение страниц для редактирования
?>

<header></header>


<div class="panel_block_0">
<div class="b1">
<img src="images/logo.svg">
</div>

<div class="b0">

<?
for ($i=0;$i<count($pages);$i++){
echo '<a href="panel.php?page='.$pages[$i][0].'&type=view">'.$pages[$i][1].'</a>';
}
?>

<a href="panel.php?page=setting">Настройки</a>
<a href="api/exit.php">Выход</a>

</div>

<a class="a0" href="index.php">
<img src="images/icon0.png">
</a>

</div>


<div class="panel_block_1">

	
 <?
get_page();
 ?>
 
</div>

<footer>
<img src="images/logo.svg">
Разработано компанией Fox Studio 2020
</footer>

</body>
</html>
<?
} else {
	header('location:index.php');
	
}


} else {	
	header('location:index.php');
}
?>
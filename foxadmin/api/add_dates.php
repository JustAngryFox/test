<?php

include 'templates/add_template.php';

class dates{
		
	
function visit_city(){
session_start();
include '../DB/connect.php';
$city_id=$_POST['city_id'];
$traveler_id=$_SESSION['id'];
$result=mysqli_query($link,"SELECT * FROM cities_visit WHERE city_id='$city_id' && traveler_id='$traveler_id'");

if (mysqli_num_rows($result)==0){

$_POST['traveler_id']=$_SESSION['id'];
$add_dates=new add_dates;
$add_dates->table_name='cities_visit';
$add_dates->column_name=['city_id','traveler_id'];
$add_dates->redirect=FALSE;
$add_dates->answer=FALSE;
$add_dates->upload_dates();
return json_encode('Операция успешно выполнена');
} else {
return json_encode('Вы уже выполняли эту операцию');	
}

}
	
	
function put_rating(){
session_start();
include '../DB/connect.php';
$traveler_id=$_SESSION['id'];
$show_place=$_POST['showplace'];	
$result=mysqli_query($link,"SELECT * FROM place_rating WHERE place_id='$show_place' && traveler_id='$traveler_id'");

if (mysqli_num_rows($result)==0){
$_POST['traveler_id']=$_SESSION['id'];	
$_POST['place_id']=$_POST['showplace'];
$add_dates=new add_dates;
$add_dates->table_name='place_rating';
$add_dates->redirect=FALSE;
$add_dates->column_name=['place_id','traveler_id','rating'];
$add_dates->upload_dates();

$result=mysqli_query($link,"SELECT AVG(rating) as avg FROM place_rating WHERE place_id='$show_place'");
$dates=mysqli_fetch_array($result);
$rating=$dates['avg'];


$result=mysqli_query($link,"UPDATE attraction SET rating='$rating' WHERE id='$show_place'");

}

echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}	
	
	
	
	
function authorization(){
session_start();
include '../DB/connect.php';	
$login=$_POST['login'];
$password=md5($_POST['password']);
$result=mysqli_query($link,"SELECT * FROM travelers WHERE login='$login' && password='$password'");
if (mysqli_num_rows($result)>0){
$dates=mysqli_fetch_array($result);	
$_SESSION['name']=$dates['name'];
$_SESSION['id']=$dates['id'];
$_SESSION['login']=$dates['login'];
}

echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';

}	
	
function close_authorization(){
session_start();
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['login']);
echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}	
	
function registration(){
include '../DB/connect.php';	
session_start();
$_POST['password']=md5($_POST['password']);
$_SESSION['name']=$_POST['name'];
$_SESSION['login']=$_POST['login'];

$result=mysqli_query($link,"SELECT * FROM travelers WHERE login='".$_POST['login']."'");
if (mysqli_num_rows($result)==0){

if ($result=mysqli_query($link,"INSERT INTO travelers (name,login,password) VALUES ('".$_POST['name']."','".$_POST['login']."','".$_POST['password']."')")){
	echo 'Данные успешно загруженны <br/>';
}
$id=mysqli_insert_id($link);
$_SESSION['id']=$id;

} 

echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}	



function edit_travelers(){
if (isset($_POST['del'])){
$add_dates=new add_dates;
$add_dates->table_name='travelers';
$add_dates->del_dates();	
}

if (isset($_POST['update'])){
$add_dates=new add_dates;
$add_dates->table_name='travelers';
$add_dates->column_name=['name','image'];
$add_dates->update_dates();	
}
}	
	

function add_cities(){
$add_dates=new add_dates;
$add_dates->table_name='cities';
$add_dates->column_name=['name','image'];
$add_dates->upload_dates();
}

function edit_cities(){
if (isset($_POST['del'])){
$add_dates=new add_dates;
$add_dates->table_name='cities';
$add_dates->del_dates();	
}

if (isset($_POST['update'])){
$add_dates=new add_dates;
$add_dates->table_name='cities';
$add_dates->column_name=['name','image'];
$add_dates->update_dates();	
}
}

function add_attraction(){
$add_dates=new add_dates;
$add_dates->table_name='attraction';
$add_dates->column_name=['name','city','image','distance'];
$add_dates->upload_dates();
}

function edit_attraction(){
if (isset($_POST['del'])){
$add_dates=new add_dates;
$add_dates->table_name='attraction';
$add_dates->del_dates();	
}

if (isset($_POST['update'])){
$add_dates=new add_dates;
$add_dates->table_name='attraction';
$add_dates->column_name=['name','city','image','distance'];
$add_dates->update_dates();	
}
}

function change_password(){
	
if (isset($_POST['update'])){
$add_dates=new add_dates;
$add_dates->table_name='users';
$_POST['password']=md5($_POST['password']);
$add_dates->column_name=['password'];
$add_dates->update_dates();	
}
}

	
function upload_img(){
	
include '../DB/connect.php';	

$folder=$_POST['folder'];

$date=date('Y-m-d');

$url=new uploads('/'.$folder.'/');

$url=strval($url); 

$description='none';

$path='/'.$folder.'/'.$url;

$result=mysqli_query($link,"INSERT INTO images (url,description,date) values ('{$path}','{$description}','{$date}')");

echo $path;
	
}

	
function update_img(){
	$img_name=$_POST['img_name'];
		move_uploaded_file($_FILES['img']['tmp_name'],'../images'.$img_name);
		
		if ($_FILES['img']['type']=='image/jpeg'){
		$image=imagecreatefromjpeg('../images'.$img_name);
		} else if ($_FILES['img']['type']=='image/png'){
		$image=imagecreatefrompng('../images'.$img_name);
		}
$new_img=imagescale($image,1150);
$new_img=imagejpeg($new_img,'../images'.$img_name);
					
	echo $img_name;
}

	

function delete_posts(){
include '../../DB/connect.php';	
$id_posts=explode('|',$_POST['id_posts']);
for ($i=0;$i<count($id_posts)-1;$i++){
$id=$id_posts[$i];
$result=mysqli_query($link,"DELETE FROM news WHERE id='$id'");

}
}


}






$dates=new dates;
if (method_exists($dates,$_POST['function'])){
$func=$_POST['function'];
$dates->$func();
}

?>
<?php
class dates{
	
public $response;

function check_city_visit(){
session_start();
include '../DB/connect.php';
$city_id=$_POST['city_id'];
$traveler_id=$_SESSION['id'];
$result=mysqli_query($link,"SELECT * FROM cities_visit WHERE city_id='$city_id' AND traveler_id='$traveler_id'");
if (mysqli_num_rows($result)>0){
	return json_encode('visit');
} else {
	return json_encode('not visit');
}
	
}

function get_visit_list(){
include '../DB/connect.php';
$place_id=$_POST['id'];
$result=mysqli_query($link,"SELECT * FROM travelers,place_rating WHERE travelers.id=place_rating.traveler_id AND place_rating.place_id='$place_id'");

if(mysqli_num_rows($result)>0){

$i=0;
while ($dates=mysqli_fetch_array($result)){
$response[$i]['name']=$dates['name'];	
$response[$i]['rating']=$dates['rating'];	
$i++;
}	
	
return json_encode($response);	
}
}


function check_rating(){
session_start();
include '../DB/connect.php';
$place_id=$_POST['id'];
$traveler_id=$_SESSION['id'];
$result=mysqli_query($link,"SELECT * FROM place_rating WHERE place_id='$place_id' AND traveler_id='$traveler_id'");

if(mysqli_num_rows($result)>0){
$dates=mysqli_fetch_array($result);
return json_encode($dates['rating']);	
} else {
return '';	
}
	
}


function get_visit_showplace(){
	
include '../DB/connect.php';
$traveler_id=$_POST['traveler_id'];
$result=mysqli_query($link,"SELECT * FROM attraction,place_rating WHERE attraction.id=place_rating.place_id AND place_rating.traveler_id='$traveler_id'");

if(mysqli_num_rows($result)>0){

$i=0;
while ($dates=mysqli_fetch_array($result)){
$response[$i]['name']=$dates['name'];	
$response[$i]['rating']=$dates['rating'];	
$i++;
}	
	
return json_encode($response);	
}

}



function get_visit_travelers(){
include '../DB/connect.php';
$city_id=$_POST['city_id'];
$result=mysqli_query($link,"SELECT * FROM travelers,cities_visit WHERE cities_visit.traveler_id=travelers.id AND cities_visit.city_id='$city_id'");

if(mysqli_num_rows($result)>0){

$i=0;
while ($dates=mysqli_fetch_array($result)){
$response[$i]=$dates['name'];	
$i++;
}	
	
return json_encode($response);	
} 
}



function get_visit_cities(){
include '../DB/connect.php';
$traveler_id=$_POST['traveler_id'];
$result=mysqli_query($link,"SELECT * FROM cities,cities_visit WHERE cities.id=cities_visit.city_id AND cities_visit.traveler_id='$traveler_id'");

if(mysqli_num_rows($result)>0){

$i=0;
while ($dates=mysqli_fetch_array($result)){
$response[$i]=$dates['name'];	
$i++;
}	
	
return json_encode($response);	
}
}
	

function get_travelers(){
$get_dates=new get_dates;
$get_dates->table_name='travelers';
$get_dates->column_name=['id','name','login'];
$this->response=$get_dates->dates();
return json_encode($get_dates->dates());		
}



function get_authorization(){
session_start();
if (isset($_SESSION['name'])){	
$response['name']=$_SESSION['name'];
$response['id']=$_SESSION['id'];
$response['login']=$_SESSION['login'];


return json_encode($response);
} else {
return json_encode('none');	
}


}



function get_showplace(){
include '../DB/connect.php';
$result=mysqli_query($link,"SELECT * FROM attraction,cities WHERE cities.id=attraction.city AND attraction.id='".$_POST['id']."'");

$dates=mysqli_fetch_array($result);
$response['name']=$dates[1];
$response['city']=$dates['name'];
$response['rating']=$dates['rating'];
$response['image']=$dates[4];
$response['distance']=$dates['distance'];
return json_encode($response);		
}



function get_cities(){
$get_dates=new get_dates;
$get_dates->table_name='cities';
$get_dates->column_name=['id','name','image'];
$get_dates->order='id DESC';

if (isset($_POST['city_id'])){
$get_dates->where='id='.$_POST['city_id'];	
}

$this->response=$get_dates->dates();
return json_encode($get_dates->dates());	
}



function get_attraction(){
$get_dates=new get_dates;
$get_dates->table_name='attraction';
$get_dates->column_name=['id','name','city','image','distance','rating'];

//Фильтрация по городам
if ($_POST['city_id']!='false'){
$cities=explode(',',$_POST['city_id']);	
$where='(city='.$cities[0];
for ($i=1;$i<count($cities)-1;$i++){
$where.=' OR city='.$cities[$i];	
}
$where.=')';
} 
//Фильтрация по городам

//Фильтрация по расстоянию

if ($_POST['distance']!='false'){
$distance=explode(',',$_POST['distance']);	

$distance = array_diff($distance, array(''));


	$max_distance=max($distance);
	$min_distance=min($distance);


if ($_POST['city_id']!='false'){
$where.='AND distance >= '.$min_distance.' AND distance <= '.$max_distance;
} else {
$where=' distance >= '.$min_distance.' AND distance <= '.$max_distance;
}
}


//Фильтрация по расстоянию

//Фильтрация по оценке

if ($_POST['rating']!='false'){
$rating=explode(',',$_POST['rating']);	

$rating = array_diff($rating, array(''));


	$max_rating=max($rating);
	$min_rating=min($rating);


if ($_POST['city_id']!='false' OR $_POST['distance']!='false'){
	
$where.='AND rating >= '.$min_rating.' AND rating <= '.$max_rating;
} else {
$where=' rating >= '.$min_rating.' AND rating <= '.$max_rating;
}
}
//Фильтрация по оценке


if (isset($where)){
$get_dates->where=$where;
}

$get_dates->order='id DESC';
$this->response=$get_dates->dates();
return json_encode($get_dates->dates());	
}
 
	


}




class get_dates {

public $table_name;
public $column_name;
public $order;
public $where;
public $response;
public $column_with_lang=[];

function dates(){
	
if(isset($_COOKIE['lang'])){
$lang=$_COOKIE['lang'];	
} else {
$lang=0;	
}

if(file_exists('foxadmin/DB/connect.php')){
include 'foxadmin/DB/connect.php';
} else {
include '../DB/connect.php';	
}
	
for ($i=0;$i<count($this->column_name);$i++){
$columns[$i]=$this->column_name[$i];
}	

if (!empty($this->where)){
$where=' WHERE '.$this->where;	
} else {
$where=' ';
}

if (!empty($this->order)){
$order=' order by '.$this->order;	
} else {
$order=' ';
}

if ($result=mysqli_query($link,"SELECT ".implode(',',$columns)." FROM ".$this->table_name.$where.$order." ")){

$i=0;

while ($dates=mysqli_fetch_array($result)){
	
for ($g=0;$g<count($this->column_name);$g++){	
	
if(in_array($this->column_name[$g],$this->column_with_lang)){

$response[$i][$this->column_name[$g]]=explode('|',htmlspecialchars_decode($dates[$this->column_name[$g]]))[$lang];
	
} else {
	
$response[$i][$this->column_name[$g]]=htmlspecialchars_decode($dates[$this->column_name[$g]]);

}
}



$i++;
}

if (!empty($response)){
$this->response=$response;


return $response;

function __toString(){
return $this->response;	
}
}

} else {
echo mysqli_error($link);
}
	
}



}

if (isset($_POST['function'])){
$dates=new dates;
if (method_exists($dates,$_POST['function'])){
$func=$_POST['function'];
echo($dates->$func());
}
}

?>
<?
class uploads {
	
public $img='img';
public $direct='../images/';

public function __construct($direct){
$this->direct=$direct;
}

public function __toString(){

$i=0;
$e=0;


$exe=preg_replace('/^.*\./Uusi','',$_FILES[$this->img]['name']);

do {	

$date=date('Y-m-d-h-i-s');
$filename=$date.'-img-'.$e.'.'.$exe;

$e++;
} while (file_exists('../images'.$this->direct.$filename));	


if (move_uploaded_file($_FILES[$this->img]['tmp_name'],'../images'.$this->direct.$filename)){
	
	
		if ($_FILES['img']['type']=='image/jpeg'){
		$image=imagecreatefromjpeg('../images'.$this->direct.$filename);
		} else if ($_FILES['img']['type']=='image/png'){
		$image=imagecreatefrompng('../images'.$this->direct.$filename);
		}
	
$new_img=imagescale($image,1150);
$new_img=imagejpeg($new_img,'../images'.$this->direct.$filename);

} else {
}	

return $filename;

}
}


class add_dates {
public $table_name;
public $column_name;
public $direct_images;
public $redirect=TRUE;
public $answer=TRUE;

function upload_dates(){

include '../DB/connect.php';	
	
for ($i=0;$i<count($this->column_name);$i++){

$columns[$i]=$this->column_name[$i];
//Если тип строки равен текст, необходимо заменить все пути к изображениям
if ($this->column_name[$i]=='text'){
	
$new_text=str_replace('temp',$this->table_name,$_POST[$this->column_name[$i]]);	
	
$values[$i]='\''.trim(htmlspecialchars($new_text,ENT_QUOTES)).'\'';

}

//Если тип строки равен текст, необходимо заменить все пути к изображениям

 else {

$values[$i]='\''.trim(htmlspecialchars($_POST[$this->column_name[$i]],ENT_QUOTES)).'\'';

}

}	


if ($result=mysqli_query($link,"INSERT INTO ".$this->table_name." (".implode(',',$columns).") VALUES (".implode(',',$values).") ")){
	
	if ($this->answer===true){
	echo 'Данные успешно загруженны <br/>';
	}
$id=mysqli_insert_id($link);

	
} else {
	if ($this->answer===true){
echo 'Не удалось загрузить данные:<br/> '.mysqli_error($link);
	}
}

mysqli_close($link);
if ($this->redirect===true){
echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}
}

//------------------------------------------------------------------------------//





//------------------------------------------------------------------------------//


function update_dates(){

include '../DB/connect.php';		

$id=$_POST['id'];

for ($i=0;$i<count($this->column_name);$i++){



//Если тип строки равен текст, необходимо заменить все пути к изображениям
if ($this->column_name[$i]=='text'){
	
$new_text=str_replace('temp',$this->table_name,$_POST[$this->column_name[$i]]);	
	
$values[$i]='\''.trim(htmlspecialchars($new_text,ENT_QUOTES)).'\'';

}

//Если тип строки равен текст, необходимо заменить все пути к изображениям 
 
 else {

$columns_values[$i]=$this->column_name[$i].'=\''.trim(htmlspecialchars($_POST[$this->column_name[$i]],ENT_QUOTES)).'\'';

 }
}	

if ($result=mysqli_query($link,"UPDATE ".$this->table_name." SET ".implode(',',$columns_values)." WHERE id='$id' ")){
	
	if ($this->answer===true){
echo 'Данные успешно обновлены<br/> ';	
	}
		
} else {
	
	if ($this->answer===true){
echo 'Не удалось обновить данные:<br/> '.mysqli_error($link);
	}
}



mysqli_close($link);

if ($this->redirect===true){

echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';

}



	
}


function del_dates(){
	
include '../DB/connect.php';	

$id=$_POST['id'];

$result=mysqli_query($link,"DELETE FROM ".$this->table_name." WHERE id='$id'");

$images=explode('|',$_POST['image']);

for ($i=0;$i<count($images)-1;$i++){
$result=mysqli_query($link,"DELETE FROM images WHERE url=".$images[$i]."");
unlink('../images'.$images[$i]);	
}

mysqli_close($link);

if ($this->redirect===true){
echo '<meta http-equiv="Refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}

}

}

?>
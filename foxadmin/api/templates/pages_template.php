<?

error_reporting(0);

class pages{
	
public $columns=[[]];
public $name;
public $id;
public $response;
public $view_line=[[]];
public $table_options=[];
public $options=[[[]]];
public $add_note=true; //Опция добавления записей
public $delete_note=true; //Опция удаления записей
	
	
//Добавить пункт	
	
function add_pages(){
		
include 'DB/connect.php';
	
$this->response.='<div class="b0">';
	
			
$this->response.='
<h2>Добавить '.$this->name.'</h2>

<form id="form_0" action="api/add_dates.php" method="POST" enctype="multipart/form-data">';

$select_num=0;


for ($i=0;$i<count($this->columns);$i++){
	
	//Текстареа
	
	
	if ($this->columns[$i][0]=='textarea'){
		
	$this->response.='<textarea name="'.$this->columns[$i][1].'" placeholder="'.$this->columns[$i][2].'"></textarea>';		
	
	} 
//Текстареа

//Селекты выбор

	else if ($this->columns[$i][0]=='select'){
	$this->response.='<select name="'.$this->columns[$i][1].'">';	
	
    for ($e=0;$e<count($this->options[$select_num]);$e++){
    $this->response.='<option value="'.$this->options[$select_num][$e][0].'">'.$this->options[$select_num][$e][1].'</option>';
	}				
		
	$this->response.='</select>';	
	$select_num++;	
	} 
	

//Селекты выбор	

//Файл

	else if ($this->columns[$i][0]=='file') {
					
	$this->response.='
	<div class="b10">
	<span> <img src="images/icon5.png"> Прикрепить изображение</span>
	<input type="'.$this->columns[$i][0].'" class="elem_panel_0" name="'.$this->columns[$i][1].'">
	</div>
	<div class="b11 elem_panel_2">

	</div>
	
<input type="hidden" class="elem_panel_1" name="'.$this->columns[$i][1].'" value="">
	';			
	}  

//Файл	
	

//Текстовый редактор	
	else if ($this->columns[$i][0]=='texteditor') {
					
	$this->response.='
	<div class="b12" contenteditable="true">
	
	</div>
	<div class="b13">
	<button type="button" class="elem_panel_8">P</button>
	<button type="button" class="elem_panel_8">B</button>
	<button type="button" class="elem_panel_8">I</button>
	<button type="button" class="elem_panel_8">H2</button>
	
	<div class="b14">
	<input type="file" class="elem_panel_8">
	<span>Добавить изображение</span>
	</div>
	
	</div>
	
	<input class="texteditor" type="hidden" name="'.$this->columns[$i][1].'">
	
	
	';			
	} 		

//Текстовый редактор

//Все остальное

	else {
		
	$this->response.='<input type="'.$this->columns[$i][0].'" name="'.$this->columns[$i][1].'" placeholder="'.$this->columns[$i][2].'">';	
	
	}
	
//Все остальное
	
	
}


//Выбор селектов из базы данных если они есть

if (!empty($this->table_options)){
	
	$this->response.=$this->table_options[4].': <br/>';	
	$result=mysqli_query($link,"SELECT * FROM ".$this->table_options[0]."");
	
	$this->response.='<select name="'.$this->table_options[1].'">';	
	

	while($dates=mysqli_fetch_array($result)){
	
	
    $this->response.='<option value="'.$dates[$this->table_options[2]].'">'.$dates[$this->table_options[3]].'</option>';
		
	
	}
	
	$this->response.='</select>';	

}


//Выбор селектов из базы данных если они есть

$this->response.='
<input type="hidden" class="elem_panel_10" value="'.$this->id.'">
<input type="hidden" name="function" value="add_'.$this->id.'">
</form>

';

$this->response.='
<div class="b11">

</div>

<button class="elem_panel_9" type="button" form="form_0">Добавить</button>

</div>
';

return $this->response;

}	
	
	
//Добавить пункт

//Список всех пунктов	

function view_pages(){
	
include 'DB/connect.php';

$result=mysqli_query($link,"SELECT * FROM ".$this->id." ORDER BY id DESC");

$this->response.='<div class="b1">
<div class="b6">
<span class="s0">Все '.$this->name.'</span>

<div class="b7">
<img src="images/icon2.png">
<input type="text" placeholder="Поиск...">
</div>
</div>


<div class="b8">

<span>
Выделить все <img src="images/icon3.png">
</span>

<span class="elem_panel_7">
Удалить <img src="images/icon1.png">
</span>

<div class="b9">

<span>Сортировать <img src="images/icon4.png"></span>

<div class="b10">
</div>
</div>


</div>';

if ($this->add_note===true){
$this->response.='
<a href="panel.php?page='.$this->id.'&type=add">
<button>Добавить '.$this->name.'</button>
</a>';
}





for ($i=0;$i<mysqli_num_rows($result);$i++){

$dates=mysqli_fetch_array($result);	

$this->response.=
'
<div class="b5">

<input type="checkbox" class="elem_panel_6" value="'.$dates['id'].'">

<a href="panel.php?page='.$this->id.'&type=edit&id='.$dates['id'].'">
<div class="b2">
<div class="b3">
<span class="s1">'.$dates[$this->view_line[0][1]].'</span>
<div class="b4">
<span>'.$this->view_line[1][0].' '.$dates[$this->view_line[1][1]].'</span>
<span>'.$this->view_line[2][0].' '.$dates[$this->view_line[2][1]].'</span>
</div>
</div>
</div>
</a>

</div>
';


}

$this->response.='</div>';
return $this->response;
}	

//Список всех пунктов	
	
// Редактирование отдельной страницы
	
	
function edit_pages(){
	
include 'DB/connect.php';

$id=$_GET['id'];

$result=mysqli_query($link,"SELECT * FROM ".$this->id." WHERE id='$id'");
	
$this->response.='<div class="b0">';
	
if ($this->add_note===true){
	
$this->response.='<a href="panel.php?page='.$this->id.'&type=add"><button>Добавить '.$this->name.'</button></a>';

}
		
$this->response.='</div>
<h2>Редактировать '.$this->name.'</h2>';

$dates=mysqli_fetch_array($result);	
	
$select_num=0;
		
$this->response.='<form action="api/add_dates.php" method="POST" enctype="multipart/form-data">';



for ($e=0;$e<count($this->columns);$e++){
	
$this->response.='<span class="s0">'.$this->columns[$e][2].' :</span>';	
	
	
if ($this->columns[$e][0]=='textarea'){
		
	$this->response.='<textarea name="'.$this->columns[$e][1].'">'.$dates[$this->columns[$e][1]].'</textarea>';		
	
	} else if ($this->columns[$e][0]=='select'){
	$this->response.='<select name="'.$this->columns[$e][1].'">';	
	
	$this->response.='<option value="'.$dates[$this->columns[$e][1]].'">'.$dates[$this->columns[$e][1]].'</option>';
	
    for ($g=0;$g<count($this->options[$select_num]);$g++){
	if 	($dates[$this->columns[$e][1]]!=$this->options[$select_num][$g][0]){
    $this->response.='<option value="'.$this->options[$select_num][$g][0].'">'.$this->options[$select_num][$g][1].'</option>';
	}
	}				
		
	$this->response.='</select>';	
	$select_num++;	
	}
//Текстовый редактор	
	else if ($this->columns[$e][0]=='texteditor') {
					
	$this->response.='
	<div class="b12" contenteditable="true">'.htmlspecialchars_decode($dates[$this->columns[$e][1]]).'</div>
	<div class="b13">
	<button type="button" class="elem_panel_8">P</button>
	<button type="button" class="elem_panel_8">B</button>
	<button type="button" class="elem_panel_8">I</button>
	<button type="button" class="elem_panel_8">H2</button>
	
	<div class="b14">
	<input type="file" class="elem_panel_8">
	<span>Добавить изображение</span>
	</div>
	
	</div>
	
	<input class="texteditor" type="hidden" name="'.$this->columns[$i][1].'">
	
	
	';			
	} 		

//Текстовый редактор

//Файлы

 else if ($this->columns[$e][0]=='file'){
	$this->response.='	
	<div class="b10">
	<span> <img src="images/icon5.png"> Добавить изображение</span>
	<input type="file" class="elem_panel_0" name="img">
	</div>
<div class="b11 elem_panel_2">';

$images=explode('|',$dates[$this->columns[$e][1]]);


for ($r=0;$r<count($images)-1;$r++){
	$this->response.='
	
<span class="elem_panel_12">
<input class="elem_panel_3" type="file" name="img">
<img class="elem_panel_4" src="images'.$images[$r].'?'.rand(0, 100).'">
<input type="hidden" value="'.$images[$r].'" class="elem_panel_5">
<img class="elem_panel_11" src="images/icon6.png">
</span>';

}
	
	$this->response.='<input type="hidden" class="elem_panel_1" name="'.$this->columns[$e][1].'" value="'.$dates[$this->columns[$e][1]].'"></div>';
} 

//Файлы


else {
		
	$this->response.='<input type="'.$this->columns[$e][0].'" name="'.$this->columns[$e][1].'" placeholder="'.$this->columns[$e][2].'" value="'.$dates[$this->columns[$e][1]].'">';	
	
	}


}
	

//Выбор селектов из базы данных если они есть

if (!empty($this->table_options)){
	
	
	$result=mysqli_query($link,"SELECT * FROM ".$this->table_options[0]."");
	
	$this->response.='<select name="'.$this->table_options[1].'">';	
	

	while($dates2=mysqli_fetch_array($result)){
	

    $this->response.='<option value="'.$dates2[$this->table_options[2]].'">'.$dates2[$this->table_options[3]].'</option>';
		
	
	}
	
	$this->response.='</select>';	

}


//Выбор селектов из базы данных если они есть
	


$this->response.='
<input type="hidden" name="function" value="edit_'.$this->id.'">';

$this->response.='
<input type="hidden" class="elem_panel_13" name="id" value="'.$dates['id'].'">
<input type="hidden" class="elem_panel_10" value="'.$this->id.'">';


if ($this->delete_note===true){
$this->response.='<button onclick="return confirm(\'Вы действительно хотите удалить запись?\')" name="del">Удалить</button>';
}

$this->response.='<button name="update">Редактировать</button>';
$this->response.='</form>';




return $this->response;

}	
	
// Редактирование отдельной страницы

	
	
	
	
	
function __toString(){
return $this->response;	
}

}




function setting(){

echo '
<div class="b0"></div>	
<h2>Сменить пароль</h2>
<form action="api/add_dates.php" method="POST" enctype="multipart/form-data">
<span class="s0">Введите новый пароль :</span>
<input type="password" name="password" placeholder="Введите новый пароль">
<input type="hidden" name="function" value="change_password"><input type="hidden" name="id" value="1">
<button name="update">Сменить</button>
</form> ';

}






function get_page(){

 if (!empty($_GET['page'])){
 $type=$_GET['type'];
 $_GET['page']($type);
 } else {
gallery('view');
 }	
}
?>
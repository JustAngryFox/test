<?

include 'api/templates/pages_template.php';//Здесь находится основной код для создания страниц

//Перечисляем в массиве список страниц необходимых для редактирования

$pages=[['cities','Города'],['attraction','Достопримечательности']];

//------

function cities($type){
	
$func=$type."_pages";	
	
$pages=new pages;
$pages->name=' город';
$pages->id='cities';
$pages->view_line=[['Название: ','name']];
$pages->columns=[['text','name','Название'],['file','image','Фотография']];
echo $pages->$func();

}



function attraction($type){
	
$func=$type."_pages";	
	
$pages=new pages;
$pages->name=' достопримечательность';
$pages->id='attraction';
$pages->table_options=['cities','city','id','name','Город:'];
$pages->view_line=[['Название: ','name']];
$pages->columns=[['text','name','Название'],['text','distance','Расстояние до центра'],['file','image','Фотография']];
echo $pages->$func();

}


?>
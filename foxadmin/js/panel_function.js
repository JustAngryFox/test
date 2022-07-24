function delete_image(x){
imgs=document.getElementsByClassName('elem_panel_1')[0].value;
img_name=document.getElementsByClassName('elem_panel_5')[x].value+'|';
console.log(img_name);
imgs=imgs.replace(img_name,'');
console.log(imgs);

document.getElementsByClassName('elem_panel_1')[0].value=imgs;
	  document.getElementsByClassName('elem_panel_12')[x].style.display='none';



}



//Загрузка изображения через AJAX
function upload_img(x){
	  	// заполним FormData данными из формы
  let formData = new FormData();
  var file = document.getElementsByClassName('elem_panel_0')[x].files[0];
  var folder = document.getElementsByClassName('elem_panel_10')[0].value;
formData.append("img", file);
formData.append("function", "upload_img");
formData.append("folder", folder);
  // отправим данные
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "api/add_dates.php");
  xhr.send(formData);
  
  
  
tag=document.createElement('span');
tag.innerHTML='<img src="images/load.gif">';
 document.getElementsByClassName('elem_panel_2')[x].appendChild(tag); 
  
  xhr.onload = () => {
tag.innerHTML='<img src="images/'+xhr.responseText+'?'+Math.random()+'"><img src="images/icon6.png">';
document.getElementsByClassName('elem_panel_1')[x].value=document.getElementsByClassName('elem_panel_1')[x].value+xhr.responseText+'|'

  }
}

//Загрузка изображения через AJAX


//Добавление изображения в текстовый редактор

function add_image(){


if (window.getSelection().containsNode(cont, allowPartialContainment = true)){
  	// заполним FormData данными из формы
  let formData = new FormData();
  var file = document.getElementsByClassName('elem_panel_8')[4].files[0];
  console.log(file);
formData.append("img", file);
formData.append("function", "upload_temp_img");
  // отправим данные
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "api/add_dates.php");
  xhr.send(formData);
  xhr.onload = () => {
  
 	
start=window.getSelection().anchorNode;
start_offset=window.getSelection().anchorOffset;



let range = new Range(); //Создаем диапазон
range.setStart(start, start_offset); //Создаем начальную точку

let newNode = document.createElement('img'); //Создаем новый тег
newNode.src ='images/temp/'+xhr.responseText;
range.insertNode(newNode); //Вставляем тег 
document.getElementsByClassName('elem_panel_1')[0].value=document.getElementsByClassName('elem_panel_1')[0].value+xhr.responseText+'|'

  }

}
}

//Добавление изображения в текстовый редактор



//Кнопки жирный шрифт, курсив и т.д.

function font(tag){

if (window.getSelection().containsNode(cont, allowPartialContainment = true)){
	
let range = new Range(); //Создаем диапазон

start=window.getSelection().anchorNode;
start_offset=window.getSelection().anchorOffset;
end=window.getSelection().focusNode;
end_offset=window.getSelection().focusOffset;

console.log(window.getSelection().anchorNode);

range.setStart(start, start_offset); //Создаем начальную точку
range.setEnd(end, end_offset);//Создаем конечную точку

words=range.toString();//Создаем преобразуем диапазон в слово
range.deleteContents()//удаляем слово
	
let newNode = document.createElement(tag); //Создаем новый тег
newNode.innerHTML =words;
range.insertNode(newNode); //Вставляем тег
}
}


//Кнопки жирный шрифт, курсив и т.д.


//Удаление постов

function delete_posts(){
	let isDelete = confirm("Вы действительно хотите удалить посты?");
	if (isDelete){
	id_posts='';
	
	for (i=0;i<document.getElementsByClassName('elem_panel_6').length;i++){
		if(document.getElementsByClassName('elem_panel_6')[i].checked===true){
		id_posts+=document.getElementsByClassName('elem_panel_6')[i].value+'|';
		}
	}
	
	
var xhr = new XMLHttpRequest();
var body = 'function=delete_posts&id_posts='+id_posts;
xhr.open('POST', 'api/add_dates.php', false);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(body);
console.log(xhr.responseText);
	location.reload();	
	}
	
}

//Удаление постов


//Отправка формы
function send_form(){
	
if (document.getElementsByClassName('texteditor')[0]!=undefined){
	document.getElementsByClassName('texteditor')[0].value=document.getElementsByClassName('b12')[0].innerHTML;
}
	
	document.getElementById('form_0').submit();
}
//Отправка формы






function update_img(x,event){
	
  let formData = new FormData();
  var file = document.getElementsByClassName('elem_panel_3')[x].files[0];
formData.append("img", file);
formData.append("function", "update_img");
formData.append("img_name", document.getElementsByClassName('elem_panel_5')[x].value);

	  document.getElementsByClassName('elem_panel_4')[x].src='images/load.gif';
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "api/add_dates.php");
  xhr.send(formData);
  xhr.onload = () => {
	  document.getElementsByClassName('elem_panel_4')[x].src='images'+xhr.responseText+'?'+Math.random();
}
console.log(xhr.responseText);

}
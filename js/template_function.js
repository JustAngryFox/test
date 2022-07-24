function check_authorization(){
dates=getDates('foxadmin/api/get_dates.php','function=get_authorization');

if (dates!='none'){
	user_id=dates['id'];
user_login=dates['login'];
	document.getElementsByClassName('elem_template_2')[0].innerHTML='';
	document.getElementsByClassName('elem_template_2')[0].innerHTML='<span>'+dates['name']+'</span>\
	<form method="POST" action="foxadmin/api/add_dates.php"><input type="hidden" name="function" value="close_authorization"><button>Выйти</button></form>'
}		
}

function open_registration(){
	document.getElementsByClassName('template_block_1')[0].style.display='inline-flex';
}


function close_registration(){
	document.getElementsByClassName('template_block_1')[0].style.display='none';
}


function open_authorize(){
	document.getElementsByClassName('template_block_0')[0].style.display='inline-flex';
}


function close_authorize(){
	document.getElementsByClassName('template_block_0')[0].style.display='none';
}

function $_GET(key) {
    var p = window.location.search;
    p = p.match(new RegExp(key + '=([^&=]+)'));
    return p ? p[1] : false;
}



function createDiv(name,classname,content,container,containernum){
tag=document.createElement(name);
tag.className=classname;
tag.innerHTML=content;

document.getElementsByClassName(container)[containernum].appendChild(tag);

}


function getDates(linked,dates){
	
var xhr = new XMLHttpRequest();
var body = dates;
xhr.open('POST', linked, false);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(body);
console.log(xhr.responseText);
if (xhr.responseText!=''){
dates=JSON.parse(xhr.responseText);
}else {
dates='';	
}
return dates;
	
}


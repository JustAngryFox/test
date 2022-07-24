function get_travelers(){
	
dates=getDates('foxadmin/api/get_dates.php','function=get_visit_travelers&city_id='+city_id);

document.getElementsByClassName('elem_city_2')[0].innerHTML='';

for (i=0;i<dates.length;i++){
	tag=document.createElement('span');
	tag.innerHTML='<span>'+dates[i]+'</span>';
	document.getElementsByClassName('elem_city_2')[0].append(tag);
}

}

function visit_city(){
	if (confirm("Вы посетили этот город?")){
getDates('foxadmin/api/add_dates.php','function=visit_city&city_id='+city_id);
get_travelers();
check_city_visit();
	}
}

function get_city(){
dates=getDates('foxadmin/api/get_dates.php','function=get_cities&city_id='+city_id);
imgs=dates[0]['image'].split('|');
document.getElementsByClassName('elem_city_0')[0].innerHTML='<img src="foxadmin/images'+imgs[0]+'">\
<span>'+dates[0]['name']+'</span>';
	
}

function check_city_visit(){
dates=getDates('foxadmin/api/get_dates.php','function=check_city_visit&city_id='+city_id);
if (dates=='visit'){
	document.getElementsByClassName('elem_city_1')[0].style.background='#74FA68';
	document.getElementsByClassName('elem_city_1')[0].innerHTML='Вы посетили город'
	document.getElementsByClassName('elem_city_1')[0].removeEventListener('click',visit_city);
}
}
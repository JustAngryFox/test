function get_travelers(){
dates=getDates('foxadmin/api/get_dates.php','function=get_travelers');
	
		for (i=0;i<dates.length;i++){
tag=document.createElement('div');
tag.className='b1 elem_travelers_1';
tag.innerHTML='\
<span><b>Имя:</b> '+dates[i]['name']+'</span>\
<span><b>Логин:</b> '+dates[i]['login']+'</span>\
<span class="s0 elem_travelers_2">Посещенные города</span>\
<div class="b2 elem_travelers_4"></div>\
<span class="s0 elem_travelers_3">Посещенные достопримечательности</span>\
<div class="b2 elem_travelers_5"></div>';


	document.getElementsByClassName('elem_travelers_0')[0].append(tag);
document.getElementsByClassName('elem_travelers_2')[i].addEventListener('click',visit_cities.bind(null,dates[i]['id'],i));
document.getElementsByClassName('elem_travelers_3')[i].addEventListener('click',visit_showplace.bind(null,dates[i]['id'],i));
	
	
		}
}

function visit_cities(x,y){
dates=getDates('foxadmin/api/get_dates.php','function=get_visit_cities&traveler_id='+x);	

	document.getElementsByClassName('elem_travelers_4')[y].innerHTML='';
if (dates!=''){
for (i=0;i<dates.length;i++){
	
	tag=document.createElement('span');
	tag.innerHTML='<span>'+dates[i]+'</span>';
	document.getElementsByClassName('elem_travelers_4')[y].append(tag);
}
} else {
	tag=document.createElement('span');
	tag.innerHTML='<span>Нет посещенных городов</span>';
	document.getElementsByClassName('elem_travelers_4')[y].append(tag);
	
}

}

function visit_showplace(x,y){
	document.getElementsByClassName('elem_travelers_5')[y].innerHTML='';
dates=getDates('foxadmin/api/get_dates.php','function=get_visit_showplace&traveler_id='+x);	
if (dates!=''){
for (i=0;i<dates.length;i++){
	
	tag=document.createElement('span');
	tag.innerHTML='<span>'+dates[i]['name']+' Оценка: '+dates[i]['rating']+'</span>';
	document.getElementsByClassName('elem_travelers_5')[y].append(tag);
}
} else {
	
	tag=document.createElement('span');
	tag.innerHTML='<span>Нет посещенных достопримечательностей</span>';
	document.getElementsByClassName('elem_travelers_5')[y].append(tag);
}
}
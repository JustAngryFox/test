function get_visit_list(){
dates=getDates('foxadmin/api/get_dates.php','function=get_visit_list&id='+id);
for (i=0;i<dates.length;i++){
	
	tag=document.createElement('span');
	tag.innerHTML='<span>Имя: '+dates[i]['name']+'</span> <span>Оценка:'+dates[i]['rating']+'</span>';
	document.getElementsByClassName('elem_showplace_3')[0].append(tag);
	
}
}


function get_showplace(){
dates=getDates('foxadmin/api/get_dates.php','function=get_showplace&id='+id);
		document.getElementsByClassName('elem_showplace_0')[0].innerHTML='';
	

		imgs=dates['image'].split('|');	
		
document.getElementsByClassName('elem_showplace_0')[0].innerHTML='<img src="foxadmin/images'+imgs[0]+'">\
<span>'+dates['name']+'</span>\
<span>Оценка: '+dates['rating']+'/10</span>\
<span>Город: '+dates['city']+'</span>\
<span>Расстояние до центра: '+dates['distance']+' км</span>';
}




function put_rating(){
	if (user_id!=''){
dates=getDates('foxadmin/api/get_dates.php','function=check_rating&id='+id);;	
		
		
		
if (dates==''){		
		
	document.getElementsByClassName('elem_showplace_1')[0].innerHTML='<form action="foxadmin/api/add_dates.php" method="POST">\
<select name="rating">\
<option value="1">1</option>\
<option value="2">2</option>\
<option value="3">3</option>\
<option value="4">4</option>\
<option value="5">5</option>\
<option value="6">6</option>\
<option value="7">7</option>\
<option value="8">8</option>\
<option value="9">9</option>\
<option value="10">10</option>\
</select>\
<button class="elem_showplace_2">Поставить оценку</button>\
<input type="hidden" name="function" value="put_rating">\
<input type="hidden" name="showplace" value="'+id+'">\
</form>';
} else {
document.getElementsByClassName('elem_showplace_1')[0].innerHTML='<span>Ваша оценка: '+dates+'</span>'	

}


} else {
document.getElementsByClassName('elem_showplace_1')[0].innerHTML='<span>Вам необходимо авторизоваться для того чтобы поставить оценку</span>'	
}
}



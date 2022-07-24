

function get_cities(){
	
	
	
		dates=getDates('foxadmin/api/get_dates.php','function=get_cities');
		
		for (i=0;i<dates.length;i++){
		cities_id[i]=dates[i]['id'];
		cities_name[i]=dates[i]['name'];
		imgs=dates[i]['image'].split('|');
		cities_images[i]=[];
		for (e=0;e<imgs.length-1;e++){
		cities_images[i][e]=imgs[e];
		}
	}
	
	
	document.getElementsByClassName('elem_index_0')[0].innerHTML='';
	
	
	for (i=0;i<cities_name.length;i++){
	tag=document.createElement('a');
	tag.href='city.php?id='+cities_id[i];
	tag.className='';
	tag.innerHTML='<div class="b1 elem_index_1"><img src="foxadmin/images'+cities_images[i][0]+'">\
<span>'+cities_name[i]+'</span>\
<span>Подробнее</span></div>';
	document.getElementsByClassName('elem_index_0')[0].append(tag);
	}
	

	
}
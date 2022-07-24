function get_cities(){
dates=getDates('foxadmin/api/get_dates.php','function=get_cities');
		for (i=0;i<dates.length;i++){
		cities_id[i]=dates[i]['id'];
		cities_name[i]=dates[i]['name'];
		}
		
		document.getElementsByClassName('elem_index_2')[0].innerHTML='';
			
	for (i=0;i<cities_id.length;i++){
	tag=document.createElement('span');
	tag.innerHTML='<input class="elem_index_3" value="'+cities_id[i]+'" type="checkbox"> '+cities_name[i];
	document.getElementsByClassName('elem_index_2')[0].append(tag);
	document.getElementsByClassName('elem_index_3')[i].addEventListener('change',check_cities);
	
	}
		
		
}

function check_cities(){
	cities_chosen='';	
	for (i=0;i<document.getElementsByClassName('elem_index_3').length;i++){
		if (document.getElementsByClassName('elem_index_3')[i].checked){
			cities_chosen+=document.getElementsByClassName('elem_index_3')[i].value+',';
			
		}
	}
	new_url=location.pathname+'?city_id='+cities_chosen+'&distance='+distance_chosen+'&rating='+rating_chosen;
			history.pushState(null,null,new_url)
			get_attraction()
			
}

function check_rating(){
	rating_chosen='';
	for (i=0;i<document.getElementsByClassName('elem_index_5').length;i++){
		if (document.getElementsByClassName('elem_index_5')[i].checked){
		rating_chosen+=document.getElementsByClassName('elem_index_5')[i].value+',';
		}		
	}


	new_url=location.pathname+'?city_id='+cities_chosen+'&distance='+distance_chosen+'&rating='+rating_chosen;
			history.pushState(null,null,new_url)
			get_attraction()	
}

function check_distance(){
	distance_chosen='';
	for (i=0;i<document.getElementsByClassName('elem_index_4').length;i++){
		if (document.getElementsByClassName('elem_index_4')[i].checked){
		distance_chosen+=document.getElementsByClassName('elem_index_4')[i].value+',';
		}		
	}


	new_url=location.pathname+'?city_id='+cities_chosen+'&distance='+distance_chosen+'&rating='+rating_chosen;
			history.pushState(null,null,new_url)
			get_attraction()	
}

function get_attraction(){
	document.getElementsByClassName('elem_index_0')[0].innerHTML='';
	city_id=$_GET('city_id');
	distance=$_GET('distance');
	rating=$_GET('rating');
		dates=getDates('foxadmin/api/get_dates.php','function=get_attraction&city_id='+city_id+'&distance='+distance+'&rating='+rating);
		
		
		attraction_id=[];
attraction_name=[];
attraction_city=[];
attraction_rating=[];
attraction_images=[];
attraction_distance=[];
		
		if (dates!=null){
		for (i=0;i<dates.length;i++){
		attraction_id[i]=dates[i]['id'];
		attraction_name[i]=dates[i]['name'];
		attraction_rating[i]=dates[i]['rating'];
		attraction_city[i]=dates[i]['city'];
		attraction_distance[i]=dates[i]['distance'];
		imgs=dates[i]['image'].split('|');
		attraction_images[i]=[];
		for (e=0;e<imgs.length-1;e++){
		attraction_images[i][e]=imgs[e];
		}
	}
		}
	
	
	
	
	for (i=0;i<attraction_id.length;i++){
	tag=document.createElement('a');
	tag.href='showplace.php?id='+attraction_id[i];
	tag.className='';
	tag.innerHTML='\
<div class="b1">\
<img src="foxadmin/images'+attraction_images[i][0]+'">\
<span>'+attraction_name[i]+'</span>\
<span>Оценка: '+attraction_rating[i]+'/10</span>\
<span>Расстояние до центра: '+attraction_distance[i]+' км</span>\
</div>';
	document.getElementsByClassName('elem_index_0')[0].append(tag);
	}
	

	
}
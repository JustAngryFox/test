attraction_id=[];
attraction_name=[];
attraction_city=[];
attraction_rating=[];
attraction_images=[];
attraction_distance=[];
imgs=[];

cities_chosen='';
distance_chosen='';
rating_chosen='';

cities_id=[];
cities_name=[];

function ready2() {
	get_attraction();
	get_cities();
	
	for (i=0;i<document.getElementsByClassName('elem_index_4').length;i++){
		document.getElementsByClassName('elem_index_4')[i].addEventListener('click',check_distance);
	}
	for (i=0;i<document.getElementsByClassName('elem_index_5').length;i++){
		document.getElementsByClassName('elem_index_5')[i].addEventListener('click',check_rating);
	}
}

document.addEventListener("DOMContentLoaded", ready2);
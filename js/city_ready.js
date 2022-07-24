
city_id=$_GET('id')

function ready2() {
	get_city();	
	document.getElementsByClassName('elem_city_1')[0].addEventListener('click',visit_city);
	get_travelers();
	check_city_visit();
}

document.addEventListener("DOMContentLoaded", ready2);
id=$_GET('id');

function ready2() {
	get_showplace();	
	put_rating();
	get_visit_list();
}

document.addEventListener("DOMContentLoaded", ready2);
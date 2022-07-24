function ready(){
	
if (document.getElementsByClassName('elem_panel_0')[0]!=undefined){

for (i=0;i<document.getElementsByClassName('elem_panel_0').length;i++){	
document.getElementsByClassName('elem_panel_0')[i].addEventListener('change',upload_img.bind(null,i));
}
}

for (i=0;i<document.getElementsByClassName('elem_panel_3').length;i++){
document.getElementsByClassName('elem_panel_3')[i].addEventListener('change',update_img.bind(null,i));
}


if (document.getElementsByClassName('b12')[0]!=undefined){

document.getElementsByClassName('elem_panel_8')[0].addEventListener('click',font.bind(null,'p'));
document.getElementsByClassName('elem_panel_8')[1].addEventListener('click',font.bind(null,'b'));
document.getElementsByClassName('elem_panel_8')[2].addEventListener('click',font.bind(null,'i'));
document.getElementsByClassName('elem_panel_8')[3].addEventListener('click',font.bind(null,'h2'));
document.getElementsByClassName('elem_panel_8')[4].addEventListener('change',add_image);


document.execCommand("defaultParagraphSeparator", false, "br");

cont=document.getElementsByClassName('b12')[0];
}

if (document.getElementsByClassName('elem_panel_7')[0]!=undefined){
document.getElementsByClassName('elem_panel_7')[0].addEventListener('click',delete_posts);
}


if (document.getElementsByClassName('elem_panel_9')[0]!=undefined){
document.getElementsByClassName('elem_panel_9')[0].addEventListener('click',send_form);
}



if (document.getElementsByClassName('elem_panel_11')[0]!=undefined){
	for (i=0;i<document.getElementsByClassName('elem_panel_11').length;i++){
		document.getElementsByClassName('elem_panel_11')[i].addEventListener('click',delete_image.bind(null,i));
	}
}



}



document.addEventListener("DOMContentLoaded", ready);
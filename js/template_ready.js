user_id='';
user_login='';


function ready() {
document.getElementsByClassName('elem_template_0')[0].addEventListener('click',close_authorize);
document.getElementsByClassName('elem_template_0')[1].addEventListener('click',close_registration);
document.getElementsByClassName('elem_template_1')[0].addEventListener('click',open_authorize);
document.getElementsByClassName('elem_template_1')[1].addEventListener('click',open_registration);

check_authorization();
}





document.addEventListener("DOMContentLoaded", ready);
<?php
function top(){
	return '<header>
		<section>
		<nav>
		<a href="index.php">
		Города
		</a>
		<a href="attraction.php">
		Достопримечательности
		</a>
		<a href="travelers.php">
		Путешественники
		</a>
		</nav>
		
		<div class="b0 elem_template_2">
		<span class="elem_template_1">Авторизация</span>
		<span class="elem_template_1">Регистрация</span>
		</div>
		
		</section>
	</header>';
}

function template_block_0(){
	return '
	<div class="template_block_0">
	<div class="b0">
	<img class="elem_template_0" src="foxadmin/images/icon6.png">
	<form action="foxadmin/api/add_dates.php" method="POST">
	<input type="text" name="login" placeholder="Логин">
	<input type="password" name="password" placeholder="Пароль">
	<input type="hidden" name="function" value="authorization">
	<button>Войти</button>
	</form>	
	
	</div>
	</div>
	';
}


function template_block_1(){
	return '
	<div class="template_block_1">
	<div class="b0">
	<img class="elem_template_0" src="foxadmin/images/icon6.png">
	<form action="foxadmin/api/add_dates.php" method="POST">
	<input type="text" name="name" required placeholder="Имя">
	<input type="text" name="login" required placeholder="Логин">
	<input type="text" name="password" required placeholder="Пароль">
	<input type="hidden" name="function" value="registration">
	<button>Зарегистрироваться</button>
	</form>	
	
	</div>
	</div>
	';
}

function bot(){
	return '
	<footer>
	Тестовое задание для компании "Страна карт"
	</footer>
	';
}


?>
<?
include 'templates/header.php';
include 'templates/templates.php';

$head=new head;
$head->title='Достопримечательности';
$head->description='Достопримечательности. Тестовое задание для компании "Страна карт"';
$head->styles='city.css';
$head->js='city';
$head->header();
echo template_block_0();
echo template_block_1();
echo top();
?>

<div class="city_block_0">
<section>
<div class="b0">
<div class="b1 elem_city_0">

</div>

<button class="elem_city_1 bu0">Я посетил(а) город</button>

<div class="b2">
<span class="s0">Посетившие путешественники:</span>

<div class="b3 elem_city_2">

</div>


</div>



</div>
</section>
</div>



<?
echo bot();
?>
<?
include 'templates/header.php';
include 'templates/templates.php';

$head=new head;
$head->title='Достопримечательности';
$head->description='Достопримечательности. Тестовое задание для компании "Страна карт"';
$head->styles='attraction.css';
$head->js='attraction';
$head->header();
echo template_block_0();
echo template_block_1();
echo top();
?>

<div class="index_block_0">
<section>


<div class="b2">
<span class="s0">Фильтры</span>

<span class="s1">Город</span>

<div class="b3 elem_index_2">
</div>

<span class="s1">Расстояние до центра</span>

<div class="b3">
<span><input class="elem_index_4" value="0,2" type="checkbox"> Меньше 2 км</span>
<span><input class="elem_index_4" value=",2,5" type="checkbox"> 2-5 км</span>
<span><input class="elem_index_4" value=",5,10" type="checkbox"> 5-10 км</span>
<span><input class="elem_index_4" value=",10,1000" type="checkbox"> Больше 10 км</span>
</div>

<span class="s1">Оценка</span>

<div class="b3">
<span><input class="elem_index_5" value="1,3" type="checkbox">1-3</span>
<span><input class="elem_index_5" value=",4,6" type="checkbox">4-6</span>
<span><input class="elem_index_5" value=",7,9" type="checkbox"> 7-9</span>
<span><input class="elem_index_5" value=",10" type="checkbox"> 10</span>
</div>

</div>


<div class="b0 elem_index_0">
</div>



</section>
</div>



<?
echo bot();
?>
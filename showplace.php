<?
include 'templates/header.php';
include 'templates/templates.php';

$head=new head;
$head->title='Достопримечательности';
$head->description='Достопримечательности. Тестовое задание для компании "Страна карт"';
$head->styles='showplace.css';
$head->js='showplace';
$head->header();
echo template_block_0();
echo template_block_1();
echo top();
?>

<div class="showplace_block_0">
<section>


<div class="b0">

<div class="b1 elem_showplace_0">
</div>

<div class="b3 elem_showplace_1">
<form action="foxadmin/api/add_dates.php" method="POST">
<select name="rating">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
<button class="elem_showplace_2">Поставить оценку</button>
<input type="hidden" name="function" value="put_rating">
<input type="hidden" name="showplace" value="<?=$_GET['id']?>">
</form>
</div>

<div class="b2">
<span class="s0">Посетившие путешественники</span>

<div class="b4 elem_showplace_3">

</div>

</div>





</div>



</section>
</div>



<?
echo bot();
?>
<?
include 'templates/header.php';
include 'templates/templates.php';

$head=new head;
$head->title='Путешественники';
$head->description='Достопримечательности. Тестовое задание для компании "Страна карт"';
$head->styles='travelers.css';
$head->js='travelers';
$head->header();
echo template_block_0();
echo template_block_1();
echo top();
?>

<div class="travelers_block_0">
<section>

<div class="b0 elem_travelers_0">
</div>

</section>
</div>



<?
echo bot();
?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */


//echo "ТУТ";
?><script src="http://code.jquery.com/jquery-1.8.3.js"></script><?



function print_arr($array)
{
    echo "<pre>".print_r($array, true)."</pre>";
}


$this->setFrameMode(true); //компонент голосует за технологию комозитный сайт

?>
<div class="left-category-menu hidden-sm hidden-xs">
    <div class="left-product-cat">
        <div class="category-heading">
            <h2>производители</h2>
        </div>
        <div class="category-menu-list">
            <ul><?



$IBLOCK_ID = $arResult['SECTIONS'][0]['IBLOCK_ID'];
$PARENTS = array();

$arSelect = Array("ID", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arProps = $ob->GetProperties();
 $PARENTS[] = $arProps['CML2_TRAITS']['VALUE'][5];
}


$PARENTS = array_unique($PARENTS);

$PARENTS = array_diff($PARENTS, array(0,'', NULL, false));

sort($PARENTS);

//print_arr($PARENTS);

$PARENTS_counter = 0;
foreach ($PARENTS as &$value)
{

$PARENTS_counter++;

if ($PARENTS_counter<16)
{

$temp_value = mb_strtolower($value);
$temp_value = str_replace(' ', '_', $temp_value);
    ?><li id="<?=$value;?>"><a href="<? echo "/products/".$temp_value; ?>"><? echo $value;?></a></li>

<?
}
else
{
$temp_value = mb_strtolower($value);
$temp_value = str_replace(' ', '_', $temp_value);
    ?><li id="<?=$value;?>"  class=" rx-child"><a href="<? echo "/products/".$temp_value; ?>"><? echo $value;?></a></li>

<?

}



}
$PARENTS_counter = 0;

?>
    <!--<li class=" rx-child">
        <a href="shop.html">Books</a>
    </li>-->
    <li class=" rx-parent">
        <a class="rx-default">
            Все производители <span class="cat-thumb  fa fa-plus"></span> 
        </a>
        <a class="rx-show">
            закрыть меню <span class="cat-thumb  fa fa-minus"></span>
        </a>
    </li>



            </ul>
        </div>
    </div>
</div>
<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');

?>

<script>

$(document).ready(function() 
{
$('ul').on('click', 'li', function(){
    var li_id = $(this).attr('id');
    // alert(li_id);

// $.post( './123.php', {text:text},  function(ok){
//alert(ok);
//});



});

});


</script>


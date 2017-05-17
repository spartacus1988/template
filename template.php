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


$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
    'LIST' => array(
        'CONT' => 'bx_sitemap',
        'TITLE' => 'bx_sitemap_title',
        'LIST' => 'bx_sitemap_ul',
    ),
    'LINE' => array(
        'CONT' => 'bx_catalog_line',
        'TITLE' => 'bx_catalog_line_category_title',
        'LIST' => 'bx_catalog_line_ul',
        'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
    ),
    'TEXT' => array(
        'CONT' => 'bx_catalog_text',
        'TITLE' => 'bx_catalog_text_category_title',
        'LIST' => 'bx_catalog_text_ul'
    ),
    'TILE' => array(
        'CONT' => 'bx_catalog_tile',
        'TITLE' => 'bx_catalog_tile_category_title',
        'LIST' => 'bx_catalog_tile_ul',
        'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
    )
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];



?><!--<div id="bx_sitemap" class="<? echo $arCurView['CONT']; ?>"><ul class="<? echo $arCurView['LIST']; ?>">-->
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


foreach ($PARENTS as &$value)
{
$temp_value = mb_strtolower($value);
$temp_value = str_replace(' ', '_', $temp_value);
    ?><li id="<?=$value;?>"><a href="<? echo "/products/".$temp_value; ?>"><? echo $value;?></a></li><?
}








?>
            </ul>
        </div>
    </div>
</div>
<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');

?><!--</div>-->

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


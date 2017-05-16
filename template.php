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



?><div class="<? echo $arCurView['CONT']; ?>"><ul class="<? echo $arCurView['LIST']; ?>"><?



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
?><li id="<?=$value;?>"><h2 class="bx_sitemap_li_title"><a href="<? echo "http://185.83.0.29/products/".$temp_value; ?>"><? echo $value;?><?
}








?>
</ul>
<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');

?></div>
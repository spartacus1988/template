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
$this->setFrameMode(true); //компонент голосует за технологию комозитный сайт
global $IBLOCK_ID;


//phpinfo();
//echo "catalog-section";
$page = $APPLICATION->GetCurPage();
//echo $page;

$page_mas = explode("/", $page);
//echo "<br>" . $page_mas[2];
$curProducer = $page_mas[2];
$curProducer = mb_strtoupper($curProducer);
$curProducer = str_replace('_', ' ', $curProducer);
//echo "<br>" . $curProducer;




$curElemName = array();
$curElemPicture = array();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arProps = $ob->GetProperties();
 if ($arProps['CML2_TRAITS']['VALUE'][5] == $curProducer)
 {
	$ar_fields = $ob->GetFields();
	$curElemName[] = $ar_fields['NAME'];
	$curElemPicture[] = $ar_fields;
 }
}

sort($curElemName);
//print_arr($curElemName);



foreach ($curElemName as &$value)
{
	foreach ($curElemPicture as &$picture)
	{
		if($value == $picture['NAME'])
		{
			//$PIC = CFile::GetPath($arItem["PICTURE"]);
			?><img src="<?=CFile::GetPath($picture["PREVIEW_PICTURE"])?>"><?
		}
	}

$temp_value = mb_strtolower($value);
$temp_value = str_replace(' ', '_', $temp_value);
$temp_value = str_replace('+', 'plus', $temp_value);
	?><li id="<?=$value;?>"><a href="<? echo "/products/".$temp_value; ?>"><? echo $value;?></a></li><?
}


//print_arr($curElemName);


///echo "IBLOCK_ID " . $IBLOCK_ID;




?>



<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>





<script type="text/javascript">
BX.message({
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>




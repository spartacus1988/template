<!-- Кодить тут-->
<?
echo "Кодить тут";
$IBLOCK_ID_PROTO = 5;



$page = $APPLICATION->GetCurPage();

echo "<br>" . $page;

$page_mas = explode("/", $page);
//echo "<br>" . $page_mas[2];
$curPhone = $page_mas[2];
//$curPhone = mb_strtoupper($curPhone);
//$curPhone = str_replace('_', ' ', $curPhone);
echo "<br>" . $curPhone;
echo "<br>" . $IBLOCK_ID_PROTO;



$arFilter=array("IBLOCK_ID"=>$IBLOCK_ID_PROTO,"CODE"=>$curPhone);
$res=CIBlockElement::GetList(array(),$arFilter,false,array("nPageSize"=>1),array('ID'));
$element=$res->Fetch();
if($res->SelectedRowsCount()!=1) echo '<p style="font-weight:bold;color:#ff0000">Элемент не найден</p>';
else
{ 
echo $element['ID'];

	//$arProps = $element->GetProperties();
	//echo "<pre>";
	//print_r($element);
	//echo "</pre>";

//$db_props = CIBlockElement::GetProperty($IBLOCK_ID_PROTO, $element['ID'], "sort", "asc", array());
//$PROPS = array();
//while($ar_props = $db_props->Fetch())
//$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];

$res = CIBlockElement::GetByID($element['ID']);
if($obRes = $res->GetNextElement())
{
  $ar_res = $obRes->GetProperty("CML2_TRAITS");
//echo "<pre>";
//print_r($ar_res);
// echo "</pre>";
print_r($ar_res['VALUE'][3]);
}


	//echo "<pre>";
	//print_r($PROPS);
	//echo "</pre>";




}


/*$arSelect = Array("ID", "IBLOCK_ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID_PROTO);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arProps = $ob->GetProperties();
 echo "<br>" . $arProps;
}
*/






?>

<!-- Кодить там-->
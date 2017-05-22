<!-- Кодить тут-->
<?
echo "Кодить тут";
$IBLOCK_ID_PROTO = 5;



$page = $APPLICATION->GetCurPage();

echo "<br>" . $page;

$page_mas = explode("/", $page);
//echo "<br>" . $page_mas[2];
$curPhone = $page_mas[2];
$curPhone = mb_strtoupper($curPhone);
$curPhone = str_replace('_', ' ', $curPhone);
echo "<br>" . $curPhone;
echo "<br>" . $IBLOCK_ID_PROTO;


$arFilter = array(
	//"CREATED_BY" => $USER->GetID(),
    "IBLOCK_ID" => $IBLOCK_ID_PROTO,
    "NAME" => $curPhone
);

$rsItems = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, Array());

while($ob = $rsItems->GetNextElement())
{
	//$arProps = $ob->GetProperties();
	//echo "<br>" . $ob;

 if ($arProps['CML2_TRAITS']['VALUE'][5] == $curProducer)
 {
	$ar_fields = $ob->GetFields();
	$curElemName[] = $ar_fields['NAME'];
	$curElemPicture[] = $ar_fields;
 }
}







?>

<!-- Кодить там-->

<!-- Кодить тут-->
<?
//echo "Кодить тут";
$IBLOCK_ID_PROTO = 5;



$page = $APPLICATION->GetCurPage();

//echo "<br>" . $page;

$page_mas = explode("/", $page);
$curPhone = $page_mas[2];
//echo "<br>" . $curPhone;
//echo "<br>" . $IBLOCK_ID_PROTO;



$arFilter=array("IBLOCK_ID"=>$IBLOCK_ID_PROTO,"CODE"=>$curPhone);
$res=CIBlockElement::GetList(array(),$arFilter,false,array("nPageSize"=>1),array('ID'));
$element=$res->Fetch();
if($res->SelectedRowsCount()!=1) echo '<p style="font-weight:bold;color:#ff0000">Элемент не найден</p>';
else
{ 
//echo $element['ID'];
$res = CIBlockElement::GetByID($element['ID']);

 if($obRes = $res->GetNextElement())
 {
   $ar_res = $obRes->GetProperty("CML2_TRAITS");
   //echo "<pre>";
   //print_r($ar_res);
   // echo "</pre>";
   //print_r($ar_res['VALUE'][3]);
 }
}

$article_accum_mas = array();
$article_accum_mas = explode(";", $ar_res['VALUE'][3]);


foreach ($article_accum_mas as &$value)
{
    echo "<br>" . $value;
}




?>

<!-- Кодить там-->
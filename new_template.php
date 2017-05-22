<!-- Кодить тут-->
<?
//echo "Кодить тут";
$IBLOCK_ID_PROTO = 5;
$IBLOCK_ID_ACCUM = 4;



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
   $arProps = $obRes->GetProperties();
	 //echo "<pre>";
	 //print_r($ar_res);
	 //print_r($arProps);
	 //echo "</pre>";
   //print_r($ar_res['VALUE'][3]);
 }
}

$article_accum_mas = array();
$article_accum_mas = explode(";", $ar_res['VALUE'][3]);


foreach ($article_accum_mas as &$value)
{
    echo "<br>" . $value;

    $arSelect = Array("ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID_ACCUM);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement())
    {
      $arProps = $ob->GetProperties();
      if ($arProps['CML2_ARTICLE']['VALUE'] == $value)
      {
        $ar_fields = $ob->GetFields();
        echo "<pre>";
		print_r($ar_fields);
		  //print_r($arProps);
        echo "</pre>";
      }
    }




	//$arFilter=array("IBLOCK_ID"=>$IBLOCK_ID_ACCUM,"CODE"=>$curPhone);
	//$res=CIBlockElement::GetList(array(),$arFilter,false,array("nPageSize"=>1),array('ID'));
	//$element=$res->Fetch();
	//if($res->SelectedRowsCount()!=1) echo '<p style="font-weight:bold;color:#ff0000">Элемент не найден</p>';
	//else
	//{ 
       //echo $element['ID'];
	//}


}




?>

<!-- Кодить там-->
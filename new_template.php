<!-- Кодить тут-->
<?
//echo "Кодить тут";
$IBLOCK_ID_PROTO = 5;
$IBLOCK_ID_ACCUM = 4;



$page = $APPLICATION->GetCurPage();

//echo "<br>" . $page;

$page_mas = explode("/", $page);
$curPhone = $page_mas[2];
$curPhoneName = mb_strtoupper($curPhone);
$curPhoneName = str_replace('_', ' ', $curPhoneName);
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
  //echo "<br>" . $value;

    $arSelect = Array("ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID_ACCUM);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    $flag_in_stock = false;
    while($ob = $res->GetNextElement())
    {
      $arProps = $ob->GetProperties();
      if ($arProps['CML2_ARTICLE']['VALUE'] == $value)
      {
        $flag_in_stock = true;
        $ar_fields = $ob->GetFields();
      //echo "<pre>";
      //print_r($ar_fields);
      //print_r($arProps);
      //echo "</pre>";

$obElement = CIBlockElement::GetByID($ar_fields['ID']);
if($arEl = $obElement->GetNext())
{
//echo "<br>" . "название " . $arEl['NAME'];
}
//echo "<br>" . "название " . $arEl['NAME'];
//echo "<br>" . $value;
//echo "<br>" . "ID " . $ar_fields['ID'];
//echo "<br>";
$PRICE_TYPE_ID = 13; 

$rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $ar_fields['ID'], 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));
if ($arPrice = $rsPrices->Fetch())
{
  //echo CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);
   $B2C_PRICE = CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);
}
//echo "<br>" . "цена = " . $B2C_PRICE;




    ?><!-- Список совмеснимых аккумуляторов -->
<div class="row">
  <div class="listview">
    <div class="single-product">
      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="product-img">
          <a href="#">
            <img class="primary-img" src="https://craftmann.ru/upload/acupic/<?=$value?>/<?=$value?>_1.jpg" alt="Product">
            <img class="secondary-img" src="https://craftmann.ru/upload/acupic/<?=$value?>/<?=$value?>_2.jpg" alt="Product">
          </a>
        </div>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-12"> 
        <div class="product-description">
          <h5><a href="#">Аккумулятор <?=$value?> для <?=$curPhoneName?></a></h5>
          <div class="price-box">
            <span class="price"><?=$B2C_PRICE?></span>
          </div>
          <p class="description">
            НАЗВАНИЕ БАТАРЕЙКИ <?=$arEl['NAME']?>                              <br>
            Артикул            <?=$value?>                                     <br>
            Напряжение, V      <?=$arProps['NAPRYAZHENIE_V']['VALUE']?>        <br>
            Емкость, mAh       <?=$arProps['EMKOST_MAH']['VALUE']?>            <br>
            Мощность, Wh       <?=$arProps['MOSHCHNOST_WH']['VALUE']?>         <br>
            Тип упаковки       <?=$arProps['TIP_UPAKOVKI']['VALUE']?>          <br>
            Статус товара      <?=$arProps['STATUS_TOVARA']['VALUE']?>         <br>
            Оригинальный код   <?=$arProps['ORIGINALNYY_KOD_1']['VALUE']?>     <br>
            Комплектация       <?=$arProps['KOMPLEKTATSIYA']['VALUE']?>        <br>
                        Тип Элемента       <?=$arProps['TIP_ELEMENTA']['VALUE']?>          <br>
            Штрихкод           <?=$arProps['CML2_BAR_CODE']['VALUE']?>         
          </p>
          <div class="product-action">
            <div class="button-group">
              <div class="product-button">
                <button><i class="fa fa-shopping-cart"></i> Купить</button>
              </div>
              <div class="product-button-2">
                <a href="#" class="modal-view" data-toggle="modal" data-target="#productModal" title="Quickview"><i class="fa fa-search-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //Список совмеснимых аккумуляторов -->
<?
      }
    }
}

?>

<!-- Кодить там-->
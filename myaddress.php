<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$APPLICATION->SetTitle("Мои адреса");
$APPLICATION->SetPageProperty("title","Мои адреса");
 
?>
<?
    $APPLICATION->IncludeComponent(
        'test:user.address',
        '',
        [
            'SHOW_ACTIVE_ONLY' => 'N',  //Показывать только активные адреса
        ],
        $component,
    );
?>  

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
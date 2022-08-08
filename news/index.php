<?php
/**
 * @global CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");

$APPLICATION->IncludeComponent(
    "example:news",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_USE_CODE" => "furniture_news_s1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "ELEMENTS_LIMIT" => "0"
    ),
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
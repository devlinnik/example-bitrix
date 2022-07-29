<?php

/**
 * @global Cmain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Пример реализации");

$APPLICATION->IncludeComponent(
  "example:news",
  ".default",
    array(),
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

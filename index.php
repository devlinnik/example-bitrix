<?php

/**
 * @global Cmain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Пример реализации");

$APPLICATION->IncludeComponent(
  "example:news",
  ".default"
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

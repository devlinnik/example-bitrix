<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    "NAME" => Loc::getMessage("EXAMPLE_NEWS_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("EXAMPLE_NEWS_COMPONENT_DESCRIPTION"),
    "SORT" => 50,
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "example-news",
        "NAME" => Loc::getMessage("EXAMPLE_NEWS_COMPONENT_NAME")
    )
);
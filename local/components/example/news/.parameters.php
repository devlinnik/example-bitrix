<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$elementsLimit = array("5", "10", "15", "20", "25", "30");

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_USE_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("EXAMPLE_NEWS_USE_CODE_IBLOCK"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y"
        ),
        "CACHE_TIME" => array(),
        "ELEMENTS_LIMIT" => array(
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => Loc::getMessage("EXAMPLE_NEWS_LIMIT"),
            "TYPE" => "LIST",
            "VALUES" => $elementsLimit,
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "N"
        ),
    )
);

<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = array(
    "GROUPS" => array(
        "SETTINGS_1" => array(
            "NAME" => Loc::getMessage("EXAMPLE_NEWS_SETTINGS_1")
        ),
        "SETTINGS_2" => array(
            "NAME" => Loc::getMessage("EXAMPLE_NEWS_SETTINGS_2")
        ),
    ),
    "PARAMETERS" => array(
        "IBLOCK_USE_CODE" => array(
            "PARENT" => "SETTINGS_1",
            "NAME" => Loc::getMessage("EXAMPLE_NEWS_USE_CODE_IBLOCK"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y"
        )
    )
);

<?php

/**
 * Template header section
 * @global CMain $APPLICATION
 */

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="<?=LANG_CHARSET;?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <?php   $APPLICATION->ShowHead();
            Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap.min.css');
            Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap-utilities.min.css');

            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.bundle.min.js');
    ?>
</head>
<body>
<div id="panel">
    <?php $APPLICATION->ShowPanel();?>
</div>
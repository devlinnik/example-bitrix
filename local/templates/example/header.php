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
            Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');

            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.bundle.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');
    ?>
</head>
<body>
<div id="panel">
    <?php $APPLICATION->ShowPanel();?>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><?=Loc::getMessage('EXAMPLE_HEADER_BRAND');?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Пункт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Пункт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Пункт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Пункт</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid container-global mt-5">
<?php
/**
 * @global CMain $APPLICATION
 * @var array $arResult
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<div class="container-fluid pb-3">
    <div class="row">
        <?php foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#">
                            <h2 class="card-title">
                                <?=$arItem['NAME'];?>
                            </h2>
                        </a>
                        <p class="card-text"><?=$arItem['PREVIEW_TEXT'];?></p>
                        <a href="#" class="btn btn-dark">
                            Перейти
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php

$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
        "NAV_OBJECT" => $arResult['NAV'],
        "SEF_MODE" => "Y",
    ),
    false
);

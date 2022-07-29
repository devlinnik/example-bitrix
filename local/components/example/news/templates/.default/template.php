<?php
/**
 * @var array $arResult
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($arResult['ITEMS'] as $ITEM): ?>
            <div class="col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#">
                            <h2 class="card-title">
                                Заголовок
                            </h2>
                        </a>
                        <p class="card-text">Text</p>
                        <a href="#" class="btn btn-dark">
                            Перейти
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
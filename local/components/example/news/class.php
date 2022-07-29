<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Создание класса ExampleComponent унаследуемого от класса CBitrixComponent
 */
class ExampleNews extends CBitrixComponent
{
    /**
     * @param $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

    /**
     * @return void|null
     */
    public function executeComponent()
    {
        $this->arResult = "TEST ONE TWO";
        $this->includeComponentTemplate();
    }
}
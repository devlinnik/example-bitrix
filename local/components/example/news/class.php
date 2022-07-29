<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

Bitrix\Main\Loader::includeModule('iblock');


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
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function listNews($iblockCode, $elementsLimit): array
    {
        $arIblock = IblockTable::getList(array(
            'filter' => array('CODE' => $iblockCode)
        ))->fetch();

        return ElementTable::getList(array(
            'order' => array('SORT' => 'ASC'),
            'select' =>  array('ID', 'SORT', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
            'filter' => array('IBLOCK_ID' => $arIblock['ID']),
            'limit' => $elementsLimit,
            'cache' => array(
                'ttl' => 3600,
                'cache_joins' => true
            ),
        ))->fetchAll();
    }

    /**
     * @return void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function executeComponent(): void
    {
        $this->arResult['ITEMS'] = $this->listNews($this->arParams['IBLOCK_USE_CODE'],
            $this->arParams['ELEMENTS_LIMIT']);
        $this->includeComponentTemplate();
    }
}
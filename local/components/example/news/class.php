<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;


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
     * @throws LoaderException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function listNews(): array
    {

        Bitrix\Main\Loader::includeModule('iblock');

        $arFilter = ['IBLOCK_ID' => 1];

        $arParams = array(
            'order' => array('SORT' => 'ASC'),
            'select' =>  array('ID', 'SORT', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
            'filter' => $arFilter,
            'count_total' => true,
            'offset' => $this->arResult['NAV']->getOffset(),
            'limit' => $this->arResult['NAV']->getLimit()
        );
        $cacheTtl = 86400;

        $obCache = new CPHPCache();

        $result = array();

        if ($obCache->InitCache($cacheTtl, serialize($arParams), '/example/news/'))
        {
            $result = $obCache->GetVars();
        }
        elseif ($obCache->StartDataCache()) {
            $this->arResult['NAV']->allowAllRecords(true)->setPageSize(1)->initFromUri();

            $arItems =  ElementTable::getList(array(
                'order' => array('SORT' => 'ASC'),
                'select' =>  array('ID', 'SORT', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
                'filter' => [
                    "=IBLOCK_ID" => 1
                ],
                'count_total' => true,
                'offset' => $this->arResult['NAV']->getOffset(),
                'limit' => $this->arResult['NAV']->getLimit()
            ));

            $this->arResult['NAV']->setRecordCount($arItems->getCount());

            while($row = $arItems->fetch())
            {
                $result[$row['ID']]['ID'] = $row["ID"];
                $result[$row['ID']]['NAME'] = $row["NAME"];
                $result[$row['ID']]['PREVIEW_TEXT'] = $row["PREVIEW_TEXT"];
            }

            if (defined('BX_COMP_MANAGED_CACHE')) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache('/example/news/');
                $CACHE_MANAGER->RegisterTag('iblock_id_' . $arFilter['IBLOCK_ID']);
                $CACHE_MANAGER->EndTagCache();
            }
            $obCache->EndDataCache($result);
        }

        return $result;

    }

    /**
     * @return void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws LoaderException
     */
    public function executeComponent(): void
    {
        $this->arResult['NAV'] = new Bitrix\Main\UI\PageNavigation("navigation");
        $this->arResult['ITEMS'] = $this->listNews();
        $this->includeComponentTemplate();
    }
}
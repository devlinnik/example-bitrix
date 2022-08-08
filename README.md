Ядро D7, примеры, документация
==============================

Главный модуль
--------------

Подключить модуль:
```php
\Bitrix\Main\Loader::includeModule('iblock');
```
Подключить языковые файлы:
```php
\Bitrix\Main\Localization\Loc::getMessage('UPDATE_DATE_TEXT');
```
Подключить js, css в шаблоне:
```php
\Bitrix\Main\Page\Asset::getInstance()->addCss("/path/to/style.css");  
\Bitrix\Main\Page\Asset::getInstance()->addJs("/path/to/script.js");  
```
Получить настройку модуля:
```php
$option = \Bitrix\Main\Config\Option::get('main', 'rating_normalization_type');
```
Запись в лог и время выполнения:
```php
use Bitrix\Main\Diag\Debug;
Debug::dumpToFile($arResult);
Debug::startTimeLabel("catalogFilter"); 
#code 
Debug::endTimeLabel("catalogFilter"); 
Debug::dumpToFile(Debug::getTimeLabels()); 
```
Вытащить поля пользователя:
```php
$dbUser = \Bitrix\Main\UserTable::getList(array(
	'select' => array('ID', 'NAME', 'PERSONAL_PHOTO', 'PERSONAL_WWW'),
	'filter' => array('ID' => $USER->GetID())
));
if ($arUser = $dbUser->fetch()){
	var_dump($arUser);
}
```
Пользовательские поля:
```php
$dbUserFields = \Bitrix\Main\UserFieldTable::getList(array(
	'filter' => array('ENTITY_ID' => 'IBLOCK_'.$iblockId.'_SECTION')
));
while ($arUserField = $dbUserFields->fetch()) {
	if ($arUserField["USER_TYPE_ID"] == 'enumeration') {
		$dbEnums = CUserFieldEnum::GetList(
			array(),
			array('USER_FIELD_ID' => $arUserField['ID'])
		);
		while ($arEnum = $dbEnums->GetNext()) {
			$arUserField['ENUMS'][$arEnum['XML_ID']] = $arEnum;
		}
	}
	$arResult['USER_FIELDS'][$arUserField["FIELD_NAME"]] = $arUserField;
}
```
Удобное управление группами пользователя:
```php 
// Получение групп пользователя 
$dbGroup = \Bitrix\Main\UserGroupTable::getList(array(
	'filter' => array("USER_ID" => 90)
));
$arGroup = $dbGroup->FetchAll();	

// Добавить пользователя в группу
\Bitrix\Main\UserGroupTable::add(array(
	"USER_ID" => $order['USER_ID'],
	"GROUP_ID" => 10,
));
 
// Удалить пользователя из группы  
\Bitrix\Main\UserGroupTable::delete(array(		 
	"USER_ID" => $order['USER_ID'], 
	"GROUP_ID" => 10, 
) );
```
Кеширование PHP:
```php 
$cache = Bitrix\Main\Data\Cache::createInstance(); 
if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) { 
	$arResult = $cache->getVars(); 
} elseif ($cache->startDataCache()) { 
	$arResult = array(); 
	if ($isInvalid) { 
		$cache->abortDataCache(); 
	} 
	$cache->endDataCache($arResult); 
} 
```
Интернет магазин
================
Заказ:
```php 
// Получаем объект заказа для работы с ним
$order = \Bitrix\Sale\Order::load($orderId); // или по номеру заказа $order = \Bitrix\Sale\Order::loadByAccountNumber($orderNumber);

// Параметры заказа
$order->getFields(); Получает все параметры заказа

// Поля со звездочкой лучше получать и изменять внутри нужных объектов (доставка, оплата),
// т.к. может быть несколько платежных документов и несколько отгрузок.

$order->getField("ID"); // ID заказа
$order->getField("LID"); // ID сайта
$order->getField("ACCOUNT_NUMBER"); // Номер заказа (по шаблону)
$order->getField("TRACKING_NUMBER"); // 
$order->getField("PAY_SYSTEM_ID"); // * ID платежной системы
$order->getField("DELIVERY_ID"); // * ID службы доставки
$order->getField("DATE_INSERT"); // object(DateTime) Время добавления
$order->getField("DATE_UPDATE"); // object(DateTime) Время обновления
$order->getField("PERSON_TYPE_ID"); // ID типа плательщика (физ/юр лицо)
$order->getField("USER_ID"); // ID пользователя
$order->getField("PAYED"); // * Статус оплаты (Y/N)
$order->getField("DATE_PAYED"); // * object(DateTime) Дата оплаты
$order->getField("EMP_PAYED_ID"); // 
$order->getField("DEDUCTED"); // * Отгрузка заказа
$order->getField("DATE_DEDUCTED"); // * object(DateTime) Дата отгрузки
$order->getField("EMP_DEDUCTED_ID"); // *
$order->getField("REASON_UNDO_DEDUCTED"); // * Причина отмены отгрузки
$order->getField("STATUS_ID"); // Статус заказа (F/N/H  т.п., посмотреть можно тут /bitrix/admin/sale_status.php?lang=ru)
$order->getField("DATE_STATUS"); // object(DateTime) Дата изменения статуса
$order->getField("EMP_STATUS_ID"); // 
$order->getField("MARKED"); // 
$order->getField("DATE_MARKED"); // object(DateTime)
$order->getField("EMP_MARKED_ID"); // 
$order->getField("REASON_MARKED"); // 
$order->getField("PRICE_DELIVERY"); // * Стоимость доставки
$order->getField("ALLOW_DELIVERY"); // * Доставка разрешена
$order->getField("DATE_ALLOW_DELIVERY"); // * object(DateTime) Дата разрешения доставки
$order->getField("EMP_ALLOW_DELIVERY_ID"); // *
$order->getField("RESERVED"); // 
$order->getField("PRICE"); // Сумма заказа
$order->getField("CURRENCY"); // Код валюты
$order->getField("DISCOUNT_VALUE"); // Скидка
$order->getField("TAX_VALUE"); // Налог
$order->getField("SUM_PAID"); //  Оплаченная сумма
$order->getField("USER_DESCRIPTION"); // Комментарий покупателя к заказу
$order->getField("PAY_VOUCHER_NUM"); // Номер документа прихода
$order->getField("PAY_VOUCHER_DATE"); // object(DateTime) Дата прихода
$order->getField("ADDITIONAL_INFO"); // Дополнительная информация
$order->getField("COMMENTS"); // Комментарий администратора
$order->getField("COMPANY_ID"); // Офис
$order->getField("CREATED_BY"); // 
$order->getField("RESPONSIBLE_ID"); // Ответственный
$order->getField("STAT_GID"); // 
$order->getField("DATE_PAY_BEFORE"); // 
$order->getField("DATE_BILL"); // 
$order->getField("IS_RECURRING"); // 
$order->getField("RECURRING_ID"); // 
$order->getField("LOCKED_BY"); // ID пользователя, заблокировавший заказ
$order->getField("DATE_LOCK"); // object(DateTime) Дата блокировки
$order->getField("RECOUNT_FLAG"); // 
$order->getField("AFFILIATE_ID"); // 
$order->getField("DELIVERY_DOC_NUM"); // 
$order->getField("DELIVERY_DOC_DATE"); // 
$order->getField("UPDATED_1C"); // 
$order->getField("ORDER_TOPIC"); // 
$order->getField("XML_ID"); // 
$order->getField("ID_1C"); // 
$order->getField("VERSION_1C"); // 
$order->getField("VERSION"); // 
$order->getField("EXTERNAL_ORDER"); // 
$order->getField("STORE_ID"); // 
$order->getField("CANCELED"); // Омена заказа (N/Y)
$order->getField("EMP_CANCELED_ID"); // 
$order->getField("DATE_CANCELED"); // object(DateTime) Дата отмены
$order->getField("REASON_CANCELED"); // Причина отмены
$order->getField("BX_USER_ID"); // 
$order->getField("RUNNING"); // 

$order->setField('PAYED', 'N'); // изменить любой параметр
$order->save(); // и сохраняем
```
Пример создание заказа:
```php 
// Массив товаров
$arItems = array(
	array(
		'PRODUCT_ID' => 18,
		'NAME' => 'Товар 1', 
		'PRICE' => 500,
		'CURRENCY' => 'RUB',
		'QUANTITY' => 3.25
	)
);

// Создаем и наполняем корзину
$basket = \Bitrix\Sale\Basket::create(SITE_ID);
foreach ($arItems as $i => $arItem) {
	$basketItem = $basket->createItem("catalog", $arItem['PRODUCT_ID']);
	$basketItem->setFields($arItem);
}

// Создаем заказ и привязываем корзину, перерасчет происходит автоматически
$order = \Bitrix\Sale\Order::create(SITE_ID, $userId);
$order->setPersonTypeId($personTypeId);
$order->setBasket($basket);

// Создание отгрузки
$shipmentCollection = $order->getShipmentCollection();
$shipment = $shipmentCollection->createItem(
	\Bitrix\Sale\Delivery\Services\Manager::getObjectById(1)
);
$shipmentItemCollection = $shipment->getShipmentItemCollection();

foreach ($basket as $basketItem) {
	$item = $shipmentItemCollection->createItem($basketItem);
	$item->setQuantity($basketItem->getQuantity());
}

// Создание оплаты
$paymentCollection = $order->getPaymentCollection();
$payment = $paymentCollection->createItem(
	\Bitrix\Sale\PaySystem\Manager::getObjectById(1)
);
$payment->setField("SUM", $order->getPrice());
$payment->setField("CURRENCY", $order->getCurrency());

// Coхраняем заказ
$result = $order->save();
if (!$result->isSuccess()) {
	//$result->getError();
}
```
Пример обновление заказа:
```php 
$order = \Bitrix\Sale\Order::load($orderId);
$order->setField('USER_DESCRIPTION', 'Доставить к подъезду');

// Разрешаем отгрузку
$shipmentCollection = $order->getShipmentCollection();

foreach ($shipmentCollection as $shipment) {
	if (!$shipment->isSystem()) { // существует системная отгрузка, т.к. товары не могут быть без отгрузки
		$shipment->allowDelivery();
	}
}

// Coхраняем заказ
$result = $order->save();
if (!$result->isSuccess()) {
	//$result->getError();
}
```
Инфоблоки
=========
Подключаем модуль. Не буду использовать сокращения для простоты кода.
```php
\Bitrix\Main\Loader::includeModule('iblock');
```
Делаем запрос в таблицу элементов инфоблока.
```php
$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
	'order' => array('SORT' => 'ASC'), // сортировка
	'select' => array('ID', 'NAME', 'IBLOCK_ID', 'SORT', 'TAGS'), // выбираемые поля, без свойств. Свойства можно получать на старом ядре \CIBlockElement::getProperty
	'filter' => array('IBLOCK_ID' => 4), // фильтр только по полям элемента, свойства (PROPERTY) использовать нельзя
	'group' => array('TAGS'), // группировка по полю, order должен быть пустой
	'limit' => 1000, // целое число, ограничение выбираемого кол-ва
	'offset' => 0, // целое число, указывающее номер первого столбца в результате
	'count_total' => 1, // дает возможность получить кол-во элементов через метод getCount()
	'runtime' => array(), // массив полей сущности, создающихся динамически
	'data_doubling' => false, // разрешает получение нескольких одинаковых записей
	'cache' => array( // Кеш запроса. Сброс можно сделать методом \Bitrix\Iblock\ElementTable::getEntity()->cleanCache();
		'ttl' => 3600, // Время жизни кеша
		'cache_joins' => true // Кешировать ли выборки с JOIN
	),
));
```
Что можно сделать с $dbItems?
```php 
$dbItems->fetch(); // или $dbItems->fetchRaw() получение одной записи, можно перебрать в цикле while ($arItem = $dbItems->fetch())
$dbItems->fetchAll(); // получение всех записей
$dbItems->getCount(); // кол-во найденных записей без учета limit, доступно если при запросе было указано count_total = 1
$dbItems->getSelectedRowsCount(); // кол-во полученных записей с учетом limit
```
В какие таблицы инфоблоков можно делать запросы
```php 
\Bitrix\Iblock\TypeTable::getList(); // типы инфоблоков
\Bitrix\Iblock\IblockTable::getList(); // инфоблоки
\Bitrix\Iblock\PropertyTable::getList(); // свойства инфоблоков
\Bitrix\Iblock\PropertyEnumerationTable::getList(); // значения свойств, например списков
\Bitrix\Iblock\SectionTable::getList(); // Разделы инфоблоков
\Bitrix\Iblock\ElementTable::getList(); // Элементы инфоблоков 
\Bitrix\Iblock\InheritedPropertyTable::getList(); // Наследуемые свойства (seo шаблоны)
// и другие не особо используемые, таблицы свойств элементов нету
```
Помимо getList можно использовать другие методы
```php 
checkFields(Result $result, $primary, array $data) // метод проверяет поля данных перед записью в БД.
getById($id) // получение элемента по ID
getByPrimary($primary, array $parameters = array()) // метод возвращает выборку по первичному ключу сущности и по опциональным параметрам \Bitrix\Main\Entity\DataManager::getList.
getConnectionName() // метод возвращает имя соединения для сущности. 12.0.9
getCount($filter = array(), array $cache = array()) // метод выполняет COUNT запрос к сущности и возвращает результат. 12.0.10
getEntity() // метод возвращает объект сущности.
getList(array $parameters = array()) // получение элементов, подробнее было выше
getMap() // метод возвращает описание карты сущностей. 12.0.7
getRow(array $parameters) // метод возвращает один столбец (или null) по параметрам для \Bitrix\Main\Entity\DataManager::getList.
getRowById($id) // метод возвращает один столбец (или null) по первичному ключу сущности. 14.0.0
getTableName() // метод возвращает имя таблицы БД для сущности. 12.0.7
query() // метод создаёт и возвращает объект запроса для сущности.
enableCrypto($field, $table = null, $mode = true) // метод устанавливает флаг поддержки шифрования для поля. 17.5.14
cryptoEnabled($field, $table = null) // метод возвращает true если шифрование разрешено для поля. 17.5.14
addMulti($rows, $ignoreEvents = false)
updateMulti($primaries, $data, $ignoreEvents = false)
// Следующий методы заблокированы у инфоблоков
add(array $data) // добавление элемента
delete($primary) // удаление элемента по ID
update($primary, array $data) // обновление элемента по ID
```
Для добавления, удаления и модификации элементов и разделов инфоблоков необходимо использовать api старого ядра.
----------------------------------------------------------------------------------------------------------------
> Всё это применимо и к другим модулям, только названия таблиц другие. Многое можно почерпнуть из файла:
>
> /bitrix/modules/main/lib/orm/data/datamanager.php

Примеры
-------
Инфоблок и его свойства:
```php 
$arIblock = \Bitrix\Iblock\IblockTable::getList(array(
	'filter' => array('CODE' => 'news'),
))->fetch();

$arProps = \Bitrix\Iblock\PropertyTable::getList(array(
	'select' => array('*'),
	'filter' => array('IBLOCK_ID' => $arIblock['ID'])
))->fetchAll();
```
Значения определенного свойства типа список:
```php 
$dbEnums = \Bitrix\Iblock\PropertyEnumerationTable::getList(array(
	'order' => array('SORT' => 'asc'),
	'select' => array('*'),
	'filter' => array('PROPERTY_ID' => $arIblockProp['ID'])
));
while($arEnum = $dbEnums->fetch()) {
	$arIblockProp['ENUM_LIST'][$arEnum['ID']] = $arEnum;
}
```
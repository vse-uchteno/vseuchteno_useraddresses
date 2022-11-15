<?
$eventManager = \Bitrix\Main\EventManager::getInstance();

/*Создаем события чистку кэша Higloadblock с Адресами пользоваелей при изменении данных*/
$eventManager->addEventHandler('', 'UserAddressOnAfterAdd', ['TestCleanCache', 'clearUserAddressHL']);
$eventManager->addEventHandler('', 'UserAddressOnAfterUpdate', ['TestCleanCache', 'clearUserAddressHL']);
$eventManager->addEventHandler('', 'UserAddressOnAfterDelete', ['TestCleanCache', 'clearUserAddressHL']);
 
class TestCleanCache 
{
    public function clearUserAddressHL($event)
    {
        $event->getEntity()->cleanCache();
    }
}

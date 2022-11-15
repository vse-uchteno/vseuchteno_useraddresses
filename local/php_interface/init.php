<?
use Bitrix\Main\Data\Cache;

$eventManager = \Bitrix\Main\EventManager::getInstance();

/*Создаем события чистку кэша компонента с Адресами пользоваелей при изменении данных*/
$eventManager->addEventHandler('', 'UserAddressOnAfterAdd', ['TestCleanCache', 'clearUserAddressHL']);
$eventManager->addEventHandler('', 'UserAddressOnAfterUpdate', ['TestCleanCache', 'clearUserAddressHL']);
$eventManager->addEventHandler('', 'UserAddressOnAfterDelete', ['TestCleanCache', 'clearUserAddressHL']);
 
class TestCleanCache 
{
    public function clearUserAddressHL($event)
    {
        $parameters = $event->getParameters();
        $userId = $parameters['fields']['UF_USER_ID']['VALUE'];
        $cachePath = 'component_test_user_adress';
        $cacheId = 'adress_user_'.$userId;
        
        $cache = Cache::createInstance();
        $cache->clean($cacheId, $cachePath);
    }
}

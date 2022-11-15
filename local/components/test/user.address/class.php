<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Data\Cache;


/**
 * Компонент для работы с адресами пользователя
 */
class TestUserAddress  extends \CBitrixComponent
{


    public function executeComponent()
    {
        global $USER;
        
        if (!$USER->IsAuthorized()) {
            $this->arResult['ERROR'] = Loc::getMessage('VU_TEST_CLASS_NOT_AUTORIZED');
            $this->includeComponentTemplate();
            return [];
        }

        
        $cacheTime = 36000000;
        $cachePath = 'component_test_user_adress';
        $cacheId = 'adress_user_'.$USER->GetId();
        
        $cache = Cache::createInstance();
        if ($cache->startDataCache($cacheTime, $cacheId, $cachePath))
        {
            Loader::includeModule('highloadblock');

            $entity = HighloadBlockTable::compileEntity('UserAddress');
            $entityDataClass = $entity->getDataClass();

            $filter = [
                'UF_USER_ID' => $USER->GetId(),
            ];
            if (!empty($this->arParams['SHOW_ACTIVE_ONLY']) && ($this->arParams['SHOW_ACTIVE_ONLY'] == 'Y')) { 
                $filter['UF_IS_ACTIVE'] = 1;
            }

            $iterator = $entityDataClass::getList([
                'select' => ['ID', 'UF_ADDRESS'],
                'filter' => $filter,
                'order' => [
                    'UF_ADDRESS' => 'ASC',
                ],
            ])->fetchAll();
            
            $cache->endDataCache([
                'adresses' => $iterator,
            ]);
            
        } else {
            $iterator = $cache->GetVars()['adresses'];
        }
        
        
        foreach ($iterator as $item) {
            $columns = [
                'ADDRESS' => $item['UF_ADDRESS'],
            ];

            $this->arResult['ROWS'][] = [
                'id' => $item['ID'],
                'has_child' => '',
                'parent_id' => 0,
                'parent_group_id' => $item['ID'],
                'columns' => $columns,
            ];
        }
        $this->prepareHeaders();
        $this->includeComponentTemplate();
            
        return $this->arResult;
    }
    
    private function prepareHeaders()
    {
        $this->arResult['HEADERS']['ADDRESS'] = [
            'id' => 'ADDRESS',
            'name' => Loc::getMessage('VU_TEST_CLASS_HEADER_ADDRESS'),
            'sort' => 'ID',
            'first_order' => 'desc',
            'editable' => '',
            'prevent_default' => '',
            'shift' => 1,
            'default' => 1,
        ];
    }

}
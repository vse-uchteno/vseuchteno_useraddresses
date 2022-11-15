<?php

\Bitrix\Main\UI\Extension::load("ui.alerts");

if (empty($arResult['ERROR'])) {
    $APPLICATION->IncludeComponent(
        'bitrix:main.ui.grid',
        '',
        [
            'GRID_ID'   => 'ADDRESS_GRID',
            'HEADERS'   => ($arResult['HEADERS'] ?? []),
            'ROWS'      => $arResult['ROWS'],
            "ALLOW_COLUMNS_SORT"      => false,
            "ALLOW_COLUMNS_RESIZE"    => true,
            "ALLOW_HORIZONTAL_SCROLL" => true,
            "ALLOW_SORT"              => false,
            "ALLOW_PIN_HEADER"        => true,
            'ALLOW_CONTEXT_MENU'      => false,
            "SHOW_ROW_CHECKBOXES"       => false,
            "SHOW_ROW_ACTIONS_MENU"     => false,
            "SHOW_GRID_SETTINGS_MENU"   => true,
            "SHOW_NAVIGATION_PANEL"     => true,
            "SHOW_PAGINATION"           => false,
            "SHOW_SELECTED_COUNTER"     => false,
            "SHOW_TOTAL_COUNTER"        => false,
        ],
        $component,
        array('HIDE_ICONS' => 'Y')
    );
} else {
?>
    <div class="ui-alert ui-alert-danger">
    <span class="ui-alert-message"><strong><?=$arResult['ERROR']?></strong></span>
    </div>
<?
}
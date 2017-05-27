<?php

/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */


use common\Core;
use common\widgets\SideMenu;


$menu=[
    'title'=>Yii::$app->getModule('sms')->t('SMS'),
    'icon'=> 'comments',
    'items'=>[
        ['icon' => 'comments-o', 'label' => Yii::$app->getModule('sms')->t('Messages'), 'url' => ['/sms/default/index'], 'active' => Core::checkMCA('sms', 'default', '*')],
    ],
];
$menu['active']=SideMenu::isActive($menu['items']);
return [$menu];
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
        ['icon' => 'amazon', 'label' => Yii::$app->getModule('sms')->t('AWS Messages'), 'url' => ['/sms/aws/index'], 'active' => Core::checkMCA('sms', 'aws', '*')],
    ],
];
$menu['active']=SideMenu::isActive($menu['items']);
return [$menu];
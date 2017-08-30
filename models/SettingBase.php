<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */


namespace modernkernel\sms\models;


use Yii;


if (Yii::$app->params['sms']['db'] === 'mongodb') {
    /**
     * Class SettingActiveRecord
     * @package common\models
     */
    class SettingActiveRecord extends \yii\mongodb\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function collectionName()
        {
            return 'sms_settings';
        }

        /**
         * @return array
         */
        public function attributes()
        {
            return [
                '_id',
                'key',
                'title',
                'value',
            ];
        }

        /**
         * get id
         * @return \MongoDB\BSON\ObjectID|string
         */
        public function getId()
        {
            return $this->_id;
        }


    }
} else {
    /**
     * Class SettingActiveRecord
     * @package common\models
     */
    class SettingActiveRecord extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return '{{%sms_settings}}';
        }


    }
}

/**
 * Class SettingBase
 * @package common\models
 */
class SettingBase extends SettingActiveRecord
{
}
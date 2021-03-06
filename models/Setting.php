<?php

namespace powerkernel\sms\models;

use Yii;

/**
 * This is the model class for Setting.
 *
 * @property string $key
 * @property string $title
 * @property string $value
 */
class Setting extends \yii\mongodb\ActiveRecord
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'title', 'value'], 'required'],
            [['key', 'title', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('sms', 'Key'),
            'title' => Yii::t('sms', 'Title'),
            'value' => Yii::t('sms', 'Value'),
        ];
    }

    /**
     * load as array
     * @return array
     */
    public static function loadAsArray()
    {
        $settings = self::find()->all();
        $a = [];
        foreach ($settings as $setting) {
            $a[$setting->key] = $setting->value;
        }
        return $a;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function findTitle($key)
    {
        $model = self::find()->where(['key' => $key])->one();
        if ($model) {
            return $model->title;
        }
        return null;
    }

    /**
     * get setting value
     * @param $key
     * @return mixed|null
     */
    public static function getValue($key)
    {
        $model = self::find()->where(['key' => $key])->one();
        if ($model) {
            return $model->value;
        }
        return null;
    }
}

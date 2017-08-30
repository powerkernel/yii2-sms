<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */

namespace modernkernel\sms\models;

use Yii;

/**
 * This is the model class for SMS.
 *
 * @property null|\MongoDB\BSON\ObjectID|string $id
 * @property string $sms_id
 * @property string $to
 * @property string $text
 * @property integer|\MongoDB\BSON\UTCDateTime $created_at
 * @property integer|\MongoDB\BSON\UTCDateTime $updated_at
 */
class SMS extends SMSBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_id', 'to', 'text'], 'required'],
            //[['created_at', 'updated_at'], 'integer'],
            [['sms_id'], 'string', 'max' => 100],
            [['to'], 'string', 'max' => 15],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sms_id' => Yii::$app->getModule('sms')->t('ID'),
            'to' => Yii::$app->getModule('sms')->t('To'),
            'text' => Yii::$app->getModule('sms')->t('Text'),
            'created_at' => Yii::$app->getModule('sms')->t('Created At'),
            'updated_at' => Yii::$app->getModule('sms')->t('Updated At'),
        ];
    }

}

<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */

namespace powerkernel\sms\models;

use Yii;

/**
 * This is the model class for SMS.
 *
 * @property \MongoDB\BSON\ObjectID|string $id
 * @property string $sms_id
 * @property string $to
 * @property string $text
 * @property \MongoDB\BSON\UTCDateTime $created_at
 * @property \MongoDB\BSON\UTCDateTime $updated_at
 */
class SMS extends \yii\mongodb\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'sms_logs';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            '_id',
            'sms_id',
            'to',
            'text',
            'created_at',
            'updated_at',
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
    public function behaviors()
    {
        return [
            UTCDateTimeBehavior::class,
        ];
    }

    /**
     * @return int timestamp
     */
    public function getUpdatedAt()
    {
        return $this->updated_at->toDateTime()->format('U');
    }

    /**
     * @return int timestamp
     */
    public function getCreatedAt()
    {
        return $this->created_at->toDateTime()->format('U');
    }

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

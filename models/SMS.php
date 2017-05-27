<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */

namespace modernkernel\sms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%sms_logs}}".
 *
 * @property string $id
 * @property string $to
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */
class SMS extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms_logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'to'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['id'], 'string', 'max' => 100],
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
            'id' => Yii::$app->getModule('sms')->t('ID'),
            'to' => Yii::$app->getModule('sms')->t('To'),
            'text' => Yii::$app->getModule('sms')->t('Text'),
            'created_at' => Yii::$app->getModule('sms')->t('Created At'),
            'updated_at' => Yii::$app->getModule('sms')->t('Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}

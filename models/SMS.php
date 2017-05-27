<?php
/**
* @author Harry Tang <harry@modernkernel.com>
* @link https://modernkernel.com
* @copyright Copyright (c) 2017 Modern Kernel
*/

namespace modernkernel\plivo\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%plivo_sms}}".
 *
 * @property string $message_uuid
 * @property string $parent_message_uuid
 * @property string $to
 * @property string $from
 * @property string $part_info
 * @property string $total_rate
 * @property string $total_amount
 * @property string $units
 * @property string $mcc
 * @property string $mnc
 * @property string $error_code
 * @property string $text
 * @property string $result
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class SMS extends ActiveRecord
{


    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 20;


    /**
     * get status list
     * @param null $e
     * @return array
     */
    public static function getStatusOption($e = null)
    {
        $option = [
         self::STATUS_ACTIVE => Yii::$app->getModule('plivo')->t('Active'),
         self::STATUS_INACTIVE => Yii::$app->getModule('plivo')->t('Inactive'),
        ];
        if (is_array($e))
            foreach ($e as $i)
                unset($option[$i]);
        return $option;
    }

    /**
     * get status text
     * @return string
     */
    public function getStatusText()
    {
        $status=$this->status;
        $list=self::getStatusOption();
        if(!empty($status) && in_array($status, array_keys($list))){
            return $list[$status];
        }
        return Yii::$app->getModule('plivo')->t('Unknown');
    }

    /**
     * get status color text
     * @return string
     */
    public function getStatusColorText(){
        $status = $this->status;
        $list = self::getStatusOption();

        $color='default';
        if($status==self::STATUS_ACTIVE){
            $color='primary';
        }
        if($status==self::STATUS_INACTIVE){
            $color='danger';
        }

        if (!empty($status) && in_array($status, array_keys($list))) {
            return '<span class="label label-'.$color.'">'.$list[$status].'</span>';
        }
        return '<span class="label label-'.$color.'">'.Yii::$app->getModule('plivo')->t('Unknown').'</span>';
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plivo_sms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_uuid', 'parent_message_uuid', 'to', 'from', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['message_uuid', 'parent_message_uuid'], 'string', 'max' => 64],
            [['to', 'from'], 'string', 'max' => 13],
            [['part_info', 'total_rate', 'total_amount', 'units', 'mcc', 'mnc', 'error_code', 'text', 'result'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_uuid' => Yii::$app->getModule('plivo')->t('Message UUID'),
            'parent_message_uuid' => Yii::$app->getModule('plivo')->t('Parent Message UUID'),
            'to' => Yii::$app->getModule('plivo')->t('To'),
            'from' => Yii::$app->getModule('plivo')->t('From'),
            'part_info' => Yii::$app->getModule('plivo')->t('Part Info'),
            'total_rate' => Yii::$app->getModule('plivo')->t('Total Rate'),
            'total_amount' => Yii::$app->getModule('plivo')->t('Total Amount'),
            'units' => Yii::$app->getModule('plivo')->t('Units'),
            'mcc' => Yii::$app->getModule('plivo')->t('MCC'),
            'mnc' => Yii::$app->getModule('plivo')->t('MNC'),
            'error_code' => Yii::$app->getModule('plivo')->t('Error Code'),
            'text' => Yii::$app->getModule('plivo')->t('Text'),
            'result' => Yii::$app->getModule('plivo')->t('Result'),
            'status' => Yii::$app->getModule('plivo')->t('Status'),
            'created_at' => Yii::$app->getModule('plivo')->t('Created At'),
            'updated_at' => Yii::$app->getModule('plivo')->t('Updated At'),
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

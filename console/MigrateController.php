<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */

namespace modernkernel\sms\console;
use modernkernel\sms\models\Setting;
use MongoDB\BSON\UTCDateTime;
use yii\db\Query;

/**
 * Class MigrateController
 * @package modernkernel\contact\console
 */
class MigrateController extends \yii\console\Controller
{
    public function actionIndex(){
        echo "Migrating SMS...\n";
        /* logs */
        $rows = (new Query())->select('*')->from('{{%sms_logs}}')->all();
        $collection = \Yii::$app->mongodb->getCollection('sms_logs');
        $collection->remove();
        foreach ($rows as $row) {
            $collection->insert([
                'sms_id' => $row['sms_id'],
                'to' => $row['to'],
                'text' => $row['text'],
                'created_at' => new UTCDateTime($row['created_at']*1000),
                'updated_at' => new UTCDateTime($row['updated_at']*1000),
            ]);
        }
        /* settings */
        $snsAWSRegion=\common\models\Setting::getValue('snsAWSRegion');
        $snsAWSAccessKeyId=\common\models\Setting::getValue('snsAWSAccessKeyId');
        $snsAWSSecretKey=\common\models\Setting::getValue('snsAWSSecretKey');

        $setting1=Setting::find()->where(['key'=>'aws_access_key'])->one();
        $setting1->value=$snsAWSSecretKey;
        $setting1->save();

        $setting2=Setting::find()->where(['key'=>'aws_region'])->one();
        $setting2->value=$snsAWSRegion;
        $setting2->save();

        $setting3=Setting::find()->where(['key'=>'aws_secret_key'])->one();
        $setting3->value=$snsAWSAccessKeyId;
        $setting3->save();

        echo "SMS migration completed.\n";
    }
}
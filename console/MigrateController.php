<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */

namespace modernkernel\sms\console;
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

        echo "SMS migration completed.\n";
    }
}
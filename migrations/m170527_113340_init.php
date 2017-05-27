<?php

use yii\db\Migration;

/**
 * Class m170527_113340_init
 */
class m170527_113340_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /* invoice */
        $this->createTable('{{%sms_logs}}', [
            'id' => $this->string(100)->notNull(),
            'to' => $this->string(15)->notNull(),
            'text'=>$this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('pk', '{{%sms_logs}}', ['id']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%sms_logs}}');
    }


}

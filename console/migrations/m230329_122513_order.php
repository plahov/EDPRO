<?php

use yii\db\Migration;

/**
 * Class m230329_122513_order
 */
class m230329_122513_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'client' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'product' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'status' => $this->string()->notNull()->defaultValue('new'),
            'comment' => $this->text()->null(),
            'price' => $this->decimal(10,2)->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('orders');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m250131_111818_create_subscriptions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('subscriptions', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk-subscriptions-user_id', 'subscriptions', 'user_id', 'users', 'id', 'CASCADE');
        $this->addForeignKey('fk-subscriptions-author_id', 'subscriptions', 'author_id', 'authors', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-subscriptions-user_id', 'subscriptions');
        $this->dropForeignKey('fk-subscriptions-author_id', 'subscriptions');
        $this->dropTable('subscriptions');
    }
}

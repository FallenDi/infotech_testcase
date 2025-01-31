<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m250131_111156_create_authors_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('authors');
    }
}

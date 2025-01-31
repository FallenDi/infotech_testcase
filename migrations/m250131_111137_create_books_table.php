<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m250131_111137_create_books_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(13)->notNull(),
            'image' => $this->string(255),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('books');
    }
}
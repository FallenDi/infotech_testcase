<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_and_autor}}`.
 */
class m250131_111220_create_book_and_autor_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('book_author', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'PRIMARY KEY(book_id, author_id)',
        ]);
        $this->addForeignKey('fk-book_author-book_id', 'book_author', 'book_id', 'books', 'id', 'CASCADE');
        $this->addForeignKey('fk-book_author-author_id', 'book_author', 'author_id', 'authors', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-book_author-book_id', 'book_author');
        $this->dropForeignKey('fk-book_author-author_id', 'book_author');
        $this->dropTable('book_author');
    }
}

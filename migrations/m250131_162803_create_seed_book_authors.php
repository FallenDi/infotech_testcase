<?php

use yii\db\Migration;

/**
 * Class m250131_162803_create_seed_book_authors
 */
class m250131_162803_create_seed_book_authors extends Migration
{
    public function safeUp()
    {
        // Получаем ID книг и авторов
        $bookIds = (new \yii\db\Query())->select('id')->from('books')->column();
        $authorIds = (new \yii\db\Query())->select('id')->from('authors')->column();

        foreach ($bookIds as $index => $bookId) {
            if (isset($authorIds[$index])) {
                $this->insert('book_author', ['book_id' => $bookId, 'author_id' => $authorIds[$index]]);
            }
        }
    }

    public function safeDown()
    {
        $this->delete('book_author');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m250131_162746_create_seed_authors
 */
class m250131_162746_create_seed_authors extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('authors', ['name'], [
            ['Фёдор Достоевский'],
            ['Максим Горький'],
            ['Александр Пушкин'],
            ['Харуки Мураками'],
            ['Аркадий и Борис Стругацкие'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('authors');
    }
}

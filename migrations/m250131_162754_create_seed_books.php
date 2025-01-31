<?php

use yii\db\Migration;

/**
 * Class m250131_162754_create_seed_books
 */
class m250131_162754_create_seed_books extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('books', ['title', 'year', 'description', 'isbn', 'image'], [
            ['title' => 'Преступление и наказание', 'year' => 2021, 'description' => 'Классика русской литературы.', 'isbn' => '978-5-4250-4787-8', 'image' => 'book1.jpg'],
            ['title' => 'На дне', 'year' => 2021, 'description' => 'Изображение социальных низов.', 'isbn' => '978-5-04-116977-0', 'image' => 'book2.jpg'],
            ['title' => 'Евгений Онегин', 'year' => 2025, 'description' => 'Роман в стихах.', 'isbn' => '978-5-04-071143-7', 'image' => 'book3.jpg'],
            ['title' => 'Кафка на пляже', 'year' => 2025, 'description' => 'Современная проза.', 'isbn' => '978-5-04-111753-5', 'image' => 'book4.jpg'],
            ['title' => 'Пикник на обочине', 'year' => 2022, 'description' => 'Фантастика о сталкерах.', 'isbn' => '978-5-4250-4020-6', 'image' => 'book5.jpg'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('books');
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 *
 * @property BookAuthor[] $bookAuthors
 * @property Books[] $books
 * @property Subscriptions[] $subscriptions
 */
class Authors extends \yii\db\ActiveRecord
{
    public $book_count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО автора',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['id' => 'book_id'])->viaTable('book_author', ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Subscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscriptions::class, ['author_id' => 'id']);
    }

    public static function topTen($year)
    {
        return self::find()
            ->select(['authors.id AS author_id', 'authors.name', 'COUNT(book_author.book_id) AS book_count'])
            ->innerJoin('book_author', 'authors.id = book_author.author_id')
            ->innerJoin('books', 'book_author.book_id = books.id')
            ->where(['books.year' => $year])
            ->groupBy(['authors.id', 'authors.name'])
            ->orderBy(['book_count' => SORT_DESC])
            ->limit(10)
            ->asArray(false)
            ->all();
    }

}

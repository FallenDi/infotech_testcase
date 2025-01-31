<?php

namespace app\models;

use Yii;
use app\models\Authors;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $image
 *
 * @property Authors[] $authors
 * @property BookAuthor[] $bookAuthors
 */
class Books extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $authorIds;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'isbn'], 'required'],
            [['year'], 'integer'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['authorIds'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'year' => 'Год выпуска',
            'description' => 'Описание',
            'isbn' => 'Isbn',
            'image' => 'Обложка',
            'authorIds' => 'Авторы',
            'imageFile' => 'Изображение обложки'
        ];
    }

    
    public function getAuthors()
    {
        return $this->hasMany(Authors::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->authorIds = $this->getAuthors()->select('id')->column();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->updateBookAuthors();
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile) {
                $path = Yii::getAlias('@webroot') . '/img/covers/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true); 
                }

                $fileName = uniqid() . '.' . $this->imageFile->extension; 
                $this->imageFile->saveAs($path . $fileName);
                $this->image = $fileName; 

                return true;
            }
        }
        return false;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->image) {
                $filePath = Yii::getAlias('@webroot') . "/img/covers/" . $this->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            return true;
        }
        return false;
    }

    protected function updateBookAuthors()
    {
        if (!empty($this->authorIds)) {
            $this->unlinkAll('authors', true);
            foreach ($this->authorIds as $authorId) {
                $author = Authors::findOne($authorId);
                if ($author) {
                    $this->link('authors', $author);
                }
            }
        }
    }
}

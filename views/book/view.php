<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Books $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->user->can('manageBooks')): ?>
        <p>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'year',
            'description:ntext',
            'isbn',
            [
                'attribute' => 'Авторы',
                'format' => 'html',
                'value' => function ($model) {
                    return implode(', ', ArrayHelper::getColumn($model->authors, 'name'));
                },
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->image ? Html::img(Yii::getAlias('@web') . "/img/covers/" . $model->image, ['style' => 'width:100px;']) : 'Нет изображения';
                },
            ],
        ],
    ]) ?>

</div>

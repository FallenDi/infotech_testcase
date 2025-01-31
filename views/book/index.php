<?php


use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('manageBooks')): ?>
        <p><?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'year',
            'description:ntext',
            'isbn',
            [
                'attribute' => 'authors',
                'label' => 'Авторы',
                'format' => 'raw',
                'value' => function ($model) {
                    return implode(', ', ArrayHelper::getColumn($model->authors, 'name'));
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->can('manageBooks') ? '{view} {update} {delete}' : '{view}',
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Subscriptions;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Authors $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$userId = Yii::$app->user->id;
$isSubscribed = Subscriptions::find()->where(['user_id' => $userId, 'author_id' => $model->id])->exists();

$this->registerJs("
    $(document).on('click', '.subscribe-btn', function(e) {
        e.preventDefault();
        var btn = $(this);
        $.post(btn.attr('href'), function(response) {
            if (response.success) {
                btn.toggleClass('btn-success btn-danger');
                if (btn.hasClass('btn-danger')) {
                    btn.text('Отписаться');
                } else {
                    btn.text('Подписаться');
                }
            }
        });
    });
", View::POS_READY);
?>
<div class="authors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('manageAuthors')): ?>
        <p>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этого автора?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <p>
    <p>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::a(
                $isSubscribed ? 'Отписаться' : 'Подписаться',
                ['subscribe', 'id' => $model->id],
                [
                    'class' => $isSubscribed ? 'btn btn-danger subscribe-btn' : 'btn btn-success subscribe-btn',
                    'data-method' => 'post',
                ]
            ) ?>
        <?php endif; ?>
    </p>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>

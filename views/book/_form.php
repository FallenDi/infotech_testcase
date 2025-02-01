<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Books $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorIds')->widget(Select2::class, [
        'data' => $authors,
        'options' => ['placeholder' => 'Выберите автора...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true, 
        ],
    ]); ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::class, [
        
        'pluginOptions' => [
            'theme' => 'fas',
            'showUpload' => false,
            'initialPreview' => $model->image ? [Yii::getAlias('@web') . "/img/covers/" . $model->image] : [],
            'initialPreviewAsData' => true,
            'initialCaption' => $model->image ? $model->image : 'Нет изображения',
            'overwriteInitial' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Топ-10 авторов за год';

$this->registerJs("
    $('#year-select').on('change', function() {
        var year = $(this).val();
        $.ajax({
            url: '" . Url::to(['report/top-authors-ajax']) . "',
            type: 'GET',
            data: {year: year},
            success: function(response) {
                var tableBody = $('#top-authors tbody');
                tableBody.empty();

                if (response.authors.length > 0) {
                    response.authors.forEach(function(author) {
                        tableBody.append('<tr><td>' + author.name + '</td><td>' + author.book_count + '</td></tr>');
                    });
                } else {
                    tableBody.append('<tr><td colspan=\"2\" class=\"text-center\">Нет данных</td></tr>');
                }
            }
        });
    });
", View::POS_READY);
?>

<div class="report-index">
    <h1 class="text-center">ТОП-10 авторов за год</h1>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <?= Select2::widget([
                'name' => 'year',
                'id' => 'year-select',
                'data' => array_combine($years, $years),
                'value' => $currentYear,
                'options' => ['placeholder' => 'Выберите год...'],
                'pluginOptions' => ['allowClear' => false]
            ]); ?>
        </div>
    </div>

    <br>

    <table class="table table-bordered" id="top-authors">
        <thead>
            <tr>
                <th>Автор</th>
                <th>Количество книг</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?= Html::encode($author->name) ?></td>
                    <td><?= Html::encode($author->book_count) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

use app\models\NoteTag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NoteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="note-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php
    echo $form->field($model, 'tagId')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\Tag::getList(),
        'options' => ['placeholder' => 'Выберите теги...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить фильтр', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

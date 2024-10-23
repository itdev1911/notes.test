<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Note $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php
    echo $form->field($modelNoteTags, 'tag_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => $tagsList,
        'options' => ['placeholder' => 'Выберите теги...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

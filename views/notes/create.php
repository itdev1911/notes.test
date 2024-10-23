<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Note $model */

$this->title = 'Добавить заметку';
$this->params['breadcrumbs'][] = ['label' => 'Заметки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelNoteTags' => $modelNoteTags,
        'tagsList' => $tagsList,
    ]) ?>

</div>

<?php

use app\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\NoteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заметки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
//            'user_id',
//            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Note $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Challenges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Challenge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'sub_category_id',
                'value' => function($model) {
                    return $model->getSubcategoryName();
                }
            ],

            'date_start',
            'date_stop',
            'title',
            // 'expected_result',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

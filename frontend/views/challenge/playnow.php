<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Play Now';
?>

<div class="challenge-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}",
        'columns' => [
            [
                'attribute' => 'sub_category_id',
                'value' => function($model) {
                    return $model->getSubcategoryName();
                }
            ],
            [
                'header' => 'Time Left',
                'value' => function(){
                    return '<span class="glyphicon glyphicon-download"></span>';
                },
                'format' => 'html'
            ],

            'title',
            // 'expected_result',
        ],
    ]); ?>
</div>

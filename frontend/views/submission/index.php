<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Submission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'challenge_id',
                'value'=>function($model) {
                    return substr($model->getChallengeName(), 0, 20);
                }
            ],

            [
                'attribute'=>'challenge_id',
                'value'=>function($model) {
                    return $model->getUserName();
                }
            ],
            'code',
            'score',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Challenge */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Challenges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sub_category_id',
            'date_start',
            'date_stop',
            'description',
            'expected_result',
            'title',
        ],
    ]) ?>

</div>

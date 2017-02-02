<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Submission */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submission-view">

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

    <?php $model->code = sprintf('<pre>%s</pre>', $model->code);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'attribute'=>'challenge_id',
              'value'=>$model->getChallengeName()
            ],
            [
                'attribute'=>'code',
                'format'=>'html',
                'value'=>$model->code
            ],
            'score',
        ],
    ]) ?>

</div>

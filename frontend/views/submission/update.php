<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Submission */

$this->title = 'Update Submission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="submission-update box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'challenges' => $challenges,
    ]) ?>

</div>

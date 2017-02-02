<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Challenge */

$this->title = 'Update Challenge: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Challenges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="challenge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'subcategories' => $subcategories
    ]) ?>

</div>

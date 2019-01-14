<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Submission */

$this->title = 'Create Submission';
$this->params['breadcrumbs'][] = ['label' => 'Submissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submission-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'challenges' => $challenges,
    ]) ?>

</div>

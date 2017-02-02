<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Submission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="submission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'challenge_id')->widget(Select2::classname(), [
      'data' => $challenges,
      'language' => 'en',
      'options' => ['placeholder' => 'Select a challenge'],
      'pluginOptions' => [
        'allowClear' => true
      ],
    ]);
    ?>

    <?= $form->field($model, 'code')->textarea(['rows' => 15]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

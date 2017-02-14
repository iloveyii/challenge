<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Challenge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="challenge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'sub_category_id')->widget(Select2::classname(), [
          'data' => $subcategories,
          'language' => 'en',
          'options' => ['placeholder' => 'Select a Subcategory'],
          'pluginOptions' => [
            'allowClear' => true
          ],
        ]);
    ?>

    <?php
        echo $form->field($model, 'date_start')->widget(DateTimePicker::className([
              'options' => ['placeholder' => 'Select operating time ...'],
              'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
              'layout' => '{picker}{input}{remove}',
              'pluginOptions' => [
                'format' => 'dd-MM-yyyy h:i:s',
                'autoclose' => true,
              ]
            ])
        );
    ?>

    <?php
        echo $form->field($model, 'date_stop')->widget(DateTimePicker::className([
                  'options' => ['placeholder' => 'Select operating time ...'],
                  'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                  'layout' => '{picker}{input}{remove}',
                  'pluginOptions' => [
                    'format' => 'dd-MM-yyyy h:i:s',
                    'autoclose' => true,
              ]
            ])
        );
    ?>

    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows'=>10]) ?>

    <?= $form->field($model, 'expected_result')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

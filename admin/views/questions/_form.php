<?php

use admin\widgets\dynamicForm\DynamicFormHelper;
use admin\widgets\dynamicForm\DynamicFormWidget;
use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Questions
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */

/** @var common\models\Answers $answers */
?>

<div class="questions-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i>Answers</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items',
                'widgetItem' => '.item',
                'limit' => 4,
                'min' => 1,
                'insertButton' => '.add-item',
                'deleteButton' => '.remove-item',
                'model' => $answers[0],
                'formId' => $form->id,
                'formFields' => [
                    'text',
                    'is_correct',
                ],
            ]); ?>

            <div class="container-items">
                <?php foreach ($answers as $i => $answer): ?>
                    <div class="item panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Answers</h3>
                            <div class="pull-right">
                                <?= DynamicFormHelper::plusButton('add-item') ?>
                                <?= DynamicFormHelper::minusButton('remove-item') ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            if (!$answer->isNewRecord) {
                                echo Html::activeHiddenInput($answer, "[{$i}]id");
                            }
                            ?>
                            <?= $form->field($answer, "[{$i}]text")->textInput(['maxlength' => true]) ?>
                            <?= $form->field($answer, "[{$i}]is_correct")->checkbox() ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?php if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=index']
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php AppActiveForm::end() ?>

</div>

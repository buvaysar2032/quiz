<?php

use common\components\helpers\UserUrl;
use common\models\QuestionsSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Questions
 */

/** @var common\models\Answers[] $answers */

$this->title = Yii::t('app', 'Update Questions: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Questions'),
    'url' => UserUrl::setFilters(QuestionsSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="questions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'answers' => $answers,
        'isCreate' => false
    ]) ?>

</div>

<?php

use common\components\helpers\UserUrl;
use common\models\AnswersSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Answers
 */

$this->title = Yii::t('app', 'Create Answers');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Answers'),
    'url' => UserUrl::setFilters(AnswersSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>

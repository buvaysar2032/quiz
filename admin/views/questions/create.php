<?php

use common\components\helpers\UserUrl;
use common\models\QuestionsSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Questions
 */

/** @var common\models\Answers[] $answers */

$this->title = Yii::t('app', 'Create Questions');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Questions'),
    'url' => UserUrl::setFilters(QuestionsSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'answers' => $answers,
        'isCreate' => true
    ]) ?>

</div>

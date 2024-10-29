<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\QuestionsSearch;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Questions
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Questions'),
    'url' => UserUrl::setFilters(QuestionsSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'text']),
            [
                'label' => Yii::t('app', 'Answers'),
                'format' => 'raw',
                'value' => function ($model) {
                    $answersList = '';
                    foreach ($model->answers as $answer) {
                        $answersList .= Html::tag('li', Html::encode($answer->text));
                    }
                    return Html::tag('ul', $answersList);
                },
            ],
        ]
    ]) ?>

</div>

<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\QuestionsSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Questions
 */

$this->title = Yii::t('app', 'Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Questions'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'sortUrl' => Url::toRoute(['sort']),
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

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

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>

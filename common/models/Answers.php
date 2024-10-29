<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property int            $id
 * @property int            $question_id
 * @property string         $text
 * @property int|null       $is_correct
 *
 * @property-read Questions $question
 */
class Answers extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%answers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['text'], 'required'],
            [['question_id', 'is_correct'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['question_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'text' => Yii::t('app', 'Text'),
            'is_correct' => Yii::t('app', 'Is Correct'),
        ];
    }

    final public function getQuestion(): ActiveQuery
    {
        return $this->hasOne(Questions::class, ['id' => 'question_id']);
    }
}

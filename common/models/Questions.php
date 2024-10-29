<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int            $id
 * @property string         $text
 * @property int|null       $position
 *
 * @property-read Answers[] $answers
 */
class Questions extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['text'], 'required'],
            [['position'], 'integer'],
            [['text'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    final public function getAnswers(): ActiveQuery
    {
        return $this->hasMany(Answers::class, ['question_id' => 'id']);
    }
}

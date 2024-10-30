<?php

namespace common\models;

use admin\enums\QuizStatus;
use common\models\AppActiveRecord;
use common\modules\user\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%quiz_progress}}".
 *
 * @property int              $id
 * @property int|null         $user_id
 * @property int|null         $current_question_id
 * @property int|null         $current_question_index
 * @property int|null         $correct_answers
 * @property int|null         $start_time
 * @property int|null         $end_time
 * @property string|null      $status
 *
 * @property-read User        $user
 */
class QuizProgress extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%quiz_progress}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'current_question_id', 'current_question_index', 'correct_answers', 'start_time', 'end_time'], 'integer'],
            QuizStatus::validator(['status']),
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'current_question_id' => Yii::t('app', 'Current Question ID'),
            'current_question_index' => Yii::t('app', 'Current Question Index'),
            'correct_answers' => Yii::t('app', 'Correct Answers'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    final public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

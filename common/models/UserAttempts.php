<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_attempts}}".
 *
 * @property int           $id
 * @property int           $user_id
 * @property int|null      $remaining_attempts
 * @property string        $last_reset
 *
 * @property-read User     $user
 */
class UserAttempts extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%user_attempts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'last_reset'], 'required'],
            [['user_id', 'remaining_attempts'], 'integer'],
            [['last_reset'], 'safe'],
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
            'remaining_attempts' => Yii::t('app', 'Remaining Attempts'),
            'last_reset' => Yii::t('app', 'Last Reset'),
        ];
    }

    final public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

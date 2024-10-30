<?php

namespace api\modules\v1\controllers;

use admin\enums\QuizStatus;
use common\components\exceptions\ModelSaveException;
use common\models\Answers;
use common\models\Questions;
use common\models\QuizProgress;
use common\modules\user\models\User;
use Yii;
use yii\db\Exception;

class QuizController extends AppController
{
    /**
     * @throws ModelSaveException
     * @throws Exception
     */
    public function actionStart()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;

        if ($user->quiz_attempts <= 0) {
            return $this->returnError('Попыток не осталось');
        }

        $user->quiz_attempts--;
        $user->save();

        $question = Questions::find()->orderBy('position')->one();

        Yii::$app->db->createCommand()
            ->update(QuizProgress::tableName(), ['status' => QuizStatus::Canceled->value], ['user_id' => $user->id, 'status' => QuizStatus::New->value])
            ->execute();

        $quizProgress = new QuizProgress();
        $quizProgress->user_id = $user->id;
        $quizProgress->current_question_id = $question->id;
        $quizProgress->current_question_index = 1;
        $quizProgress->correct_answers = 0;
        $quizProgress->start_time = time();
        $quizProgress->status = QuizStatus::New->value; // New->value = 10 int

        if (!$quizProgress->save()) {
            throw new ModelSaveException($quizProgress);
        }

        return $this->returnSuccess([
            'profile' => $user->profile,
            'question' => $question,
            'question_count' => Questions::find()->count(),
            'current_question' => $quizProgress->current_question_index,
        ]);
    }

    public function actionAnswer($id)
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;

        $quizProgress = QuizProgress::findOne(['user_id' => $user->id, 'status' => QuizStatus::New->value]);

        if (!$quizProgress) {
            return $this->returnError('Викторина не начата или уже завершена');
        }

        /** @var Answers $answer */
        $answer = Answers::find()->where(['id' => $id])->one();

        if (!$answer) {
            return $this->returnError('Неверный идентификатор ответа');
        }

        if ($answer->question_id !== $quizProgress->current_question_id) {
            return $this->returnError('Ответ не соответствует текущему вопросу');
        }

        $isCorrect = $answer->is_correct;
        if ($isCorrect) {
            $quizProgress->correct_answers++;
        }

        // Переходим к следующему вопросу
        $quizProgress->current_question_index++;
        $quizProgress->save();

        $nextQuestion = Questions::find()
            ->orderBy('position')
            ->where(['>', 'position', $answer->question->position])
            ->limit(1)
            ->one();

        if (!$nextQuestion) {
            $quizProgress->end_time = time();
            $quizProgress->status = QuizStatus::Completed->value;
            $quizProgress->save();

            $timeSpent = $quizProgress->end_time - $quizProgress->start_time;

            return $this->returnSuccess([
                'message' => 'Викторина завершена',
                'total_questions' => Questions::find()->count(),
                'correct_answers' => $quizProgress->correct_answers,
                'time_spent' => $timeSpent
            ]);
        }

        if ($nextQuestion) {
            $quizProgress->current_question_id = $nextQuestion->id;
            $quizProgress->save();

            return $this->returnSuccess([
                'is_correct' => $isCorrect,
                'next_question' => $nextQuestion,
                'total_questions' => Questions::find()->count(),
                'current_question' => $quizProgress->current_question_index,
                'correct_answers' => $quizProgress->correct_answers
            ]);
        }
    }
}

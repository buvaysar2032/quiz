<?php

namespace api\modules\v1\controllers;

use common\models\Answers;
use common\models\Questions;
use common\modules\user\models\User;
use Yii;

class QuizController extends AppController
{
    public function actionStart()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;
        $profile = $user->profile;

        if ($user->quiz_attempts <= 0) {
            return $this->returnError('Попыток не осталось');
        }

        $user->quiz_attempts--;
        $user->save();

        $question = Questions::find()->orderBy('position')->one();

        return $this->returnSuccess([
            'question' => $question,
            'question_count' => Questions::find()->count(),
            'current_question' => 1,
            'correct_answers' => 0
        ]);
    }

    public function actionAnswer($id)
    {
        $currentQuestionIndex = 0;
        $correctAnswers = 0;
        /** @var Answers $answer */
        $answer = Answers::find()->where(['id' => $id])->one();

        if ($answer) {
            $isCorrect = $answer->is_correct;

            $nextQuestion = Questions::find()
                ->orderBy('position')
                ->where(['>', 'position', $answer->question->position])
                ->limit(1)
                ->one();

            if (!$nextQuestion) {
                return $this->returnSuccess([
                    'message' => 'Викторина завершена',
                    'total_questions' => Questions::find()->cache(10)->count(),
                    'correct_answers' => $correctAnswers
                ]);
            }

            if ($isCorrect) {
                $correctAnswers++;
            }

            return $this->returnSuccess([
                'is_correct' => $isCorrect,
                'next_question' => $nextQuestion,
                'total_questions' => Questions::find()->cache(10)->count(),
                'current_question' => $currentQuestionIndex + 1,
                'correct_answers' => $correctAnswers
            ]);
        }

        return $this->returnError('Неверный идентификатор ответа');
    }


}

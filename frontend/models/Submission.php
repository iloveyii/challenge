<?php

namespace frontend\models;

use frontend\controllers\ChallengeController;
use Yii;

/**
 * This is the model class for table "submission".
 *
 * @property integer $id
 * @property integer $challenge_id
 * @property integer $user_id
 * @property string $code
 * @property integer $score
 */
class Submission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'submission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['challenge_id', 'user_id', 'score'], 'integer'],
            [['code'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'challenge_id' => 'Challenge ID',
            'user_id' => 'User ID',
            'code' => 'Code',
            'score' => 'Score',
        ];
    }

    public function getChallengeName()
    {
        $challenge = Challenge::findOne($this->challenge_id);

        return isset($challenge) ? $challenge->description : 'NA';
    }

    public function getUserName()
    {
        $user = User::findOne($this->user_id);

        return isset($user) ? $user->username : 'NA';
    }
}

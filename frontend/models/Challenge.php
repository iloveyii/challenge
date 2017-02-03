<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "challenge".
 *
 * @property integer $id
 * @property string $sub_category_id
 * @property string $date_start
 * @property string $date_stop
 * @property string $description
 * @property string $expected_result
 */
class Challenge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'challenge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_category_id'], 'required'],
            [['date_start', 'date_stop', 'description'], 'safe'],
            [['sub_category_id'], 'string', 'max' => 45],
            [['expected_result'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 2000],
            [['title'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_category_id' => 'Challenge',
            'date_start' => 'Date Start',
            'date_stop' => 'Date Stop',
            'description' => 'Description',
            'title' => 'Title',
            'expected_result' => 'Expected Result',
        ];
    }

    public function getSubcategoryName()
    {
        $subCategory = SubCategory::findOne($this->sub_category_id);

        return isset($subCategory) ? $subCategory->name : 'NA';
    }

    public function getChallengeName()
    {
        $challenge = Challenge::findOne($this->challenge_id);

        return isset($challenge) ? 'TBD' : 'NA';
    }

    public function getSubcategory()
    {
        return $this->hasOne(SubCategory::className(), 'sub_category_id', 'id');
    }
}

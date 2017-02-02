<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movie".
 *
 * @property integer $id
 * @property string $title
 * @property string $poster
 */
class Movie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 95],
            [['youtube_id'], 'string', 'max' => 85],
            [['poster'], 'string', 'max' => 345],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'poster' => 'Poster',
            'youtube_id' => 'Youtube Id',
            'magnet_link' => 'Magnet Link',
        ];
    }
}

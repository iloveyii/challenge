<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $evaluation_class
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['evaluation_class'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'evaluation_class' => 'Evaluation Class',
        ];
    }

    public function getCategoryName()
    {
        $category = Category::findOne($this->category_id);
        return isset($category) ? $category->name : 'NA';
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), 'id', 'category_id');
    }
}

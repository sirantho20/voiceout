<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mup_category".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $date_added
 * @property string $date_updated
 *
 * @property MupCompany[] $mupCompanies
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_added', 'date_updated'], 'required'],
            [['date_added', 'date_updated'], 'safe'],
            [['category_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanies()
    {
        return $this->hasMany(MupCompany::className(), ['category_id' => 'id']);
    }
}

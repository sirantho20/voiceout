<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mup_country".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property string $country_code2
 *
 * @property MupCompanyDetails[] $mupCompanyDetails
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'country_name'], 'required'],
            [['country_code', 'country_code2'], 'string', 'max' => 5],
            [['country_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'country_code2' => 'Country Code2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanyDetails()
    {
        return $this->hasMany(MupCompanyDetails::className(), ['country_id' => 'id']);
    }
}

<?php

//namespace app\modules\blog\models;
namespace blog\models;

use Yii;
use app\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Articles extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_FEATURES = 11;
    /**
     * @inheritdoc
     */
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
            [
                'class' => BlameableBehavior::className(),
            ],
        ];
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->name = HtmlPurifier::process($this->name);
        $this->text = HtmlPurifier::process($this->text);
        return true;
    }
    
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'status'], 'integer'],
            [['status'], 'default', 'value' => 10],
            [['name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'text' => 'Содержание',
            'created_by' => 'Написан',
            'updated_by' => 'Изменен',
            'created_at' => 'Создан в',
            'updated_at' => 'Изменен в',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

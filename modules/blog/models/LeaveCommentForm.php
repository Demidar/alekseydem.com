<?php

namespace blog\models;

use Yii;
use blog\models\ArticlesComments;

class LeaveCommentForm extends \yii\base\Model {
    
    public $text;
    public $articleid;
    
    public function rules() {
        return [
            [['text'], 'required'],
            [['text'], 'string', 'max' => 500, 'message' => 'Поле может содержать не более 500 символов'],
            ['articleid', 'required'],
        ];
    }
    
    public function leaveComment() {
        if (!$this->validate()) {
            return null;
        }
        
        $com = new ArticlesComments();
        
        $com->text = $this->text;
        $com->id_article = $this->articleid;
        $com->status = ArticlesComments::STATUS_ACTIVE;
        
        $com->save();
        
        return true;
    }
    
    public function attributeLabels() {
        return [
            'text' => 'Оставить комментарий:',
        ];
    }
}
<?php

namespace blog\components;

use yii\base\Widget;

class CommentWidget extends Widget {
    
    public $comment;
    public $canBeEdited;
    public $canBeDeleted;
    
    public function init() {
        if ($this->canBeEdited === null) {
            $this->canBeEdited = true;
        }
        if ($this->canBeDeleted === null) {
            $this->canBeDeleted = true;
        }
    }
    
    public function run() {
        return $this->render('comment-layout', [
            'comment' => $this->comment,
            'canBeEdited' => $this->canBeEdited,
            'canBeDeleted' => $this->canBeDeleted,
        ]);
    }
    
}
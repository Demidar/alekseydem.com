<?php
/* @var $article blog\models\Articles */
namespace blog\components;

use yii\base\Widget;
/**
 * ArticleWidget is a widget that generate a page
 */
class ArticleWidget extends Widget {
    
    public $article;
    public $stringLength;
    public $hasLink;
    public $description;
    public $canBeEdited;
    public $canBeDeleted;
    
    public function init() {
        if ($this->stringLength) {
            $this->article->text = preg_replace('/<.+?>/u', '', $this->article->text);
            $this->article->text = 
                nl2br(mb_strlen($this->article->text) > $this->stringLength 
                ? mb_substr($this->article->text, 0, $this->stringLength-20) . ' ...<br><b>Читать далее...</b>'
                : $this->article->text);
        }
        
        if ($this->hasLink === null) {
            $this->hasLink = true;
        }
        
        if ($this->description === null) {
            $this->description = true;
        }
        
        if ($this->canBeEdited === null) {
            $this->canBeEdited = true;
        }
        
        if ($this->canBeDeleted === null) {
            $this->canBeDeleted = true;
        }
    }
    
    public function run() {
        
        return $this->render('article-layout', [
            'article' => $this->article,
            'description' => $this->description,
            'canBeEdited' => $this->canBeEdited,
            'canBeDeleted' => $this->canBeDeleted,
            'hasLink' => $this->hasLink,
        ]);
    }
    
}
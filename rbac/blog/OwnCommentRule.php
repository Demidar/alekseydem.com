<?php

namespace app\rbac\blog;

use yii\rbac\Rule;

/**
 * Проверяем UserID на соответствие с пользователем, переданным через параметры
 */
class OwnCommentRule extends Rule {
    
    public $name = 'blog@isWriterComment';
    
    /**
     * 
     * @param type $user
     * @param type $item
     * @param type $params param 'comment'
     * @return type
     */
    public function execute($user, $item, $params) {
        return isset($params['comment']) ? $params['comment']->created_by == $user : false;
    }
    
}
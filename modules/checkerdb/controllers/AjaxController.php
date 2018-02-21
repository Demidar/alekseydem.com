<?php

namespace checkerdb\controllers;

use Yii;
use yii\mongodb\Query;
use yii\helpers\VarDumper;
use yii\helpers\Json;
use Exception;

class AjaxController extends \yii\web\Controller {
    // никаких шаблонов
    public $layout = false;
    
    // выслать вопрос и варианты отетов в JSON формате
    public function actionShowTask($section_id, $task, $question = 0) {
        
        //Проверка присланных данных
        if (!(strlen($section_id) === 24 && preg_match('/[0-9a-fA-F]+/', $section_id))) {
            throw new Exception('received ID is not correct');
        }
        if (!(is_numeric($task) && $task >= 0)) {
            throw new Exception('received task is incorrect');
        }
        if (!(is_numeric($question) && $question >= 0)) {
            throw new Exception('received question is incorrect');
        }
        
        // запрос документа с полученным ID
        $collection = (new Query())->from('tests')->where(['_id' => $section_id])->all();
        // извлечение тестовой задачи из документа
        $fullTask = $collection[0]['tasks'][$task];
        $trueAnswers = 0;
        
        // если текущая задача является тестом
        if ($fullTask['type'] === 'тест') {
            // извлечение текущего этапа теста
            $partTask = $fullTask['questionAnswer'][$question];
            // подсчет количества правильных ответов у текущего этапа теста,
            // затем убрать варианты ответов до отправки клиенту
            foreach ($partTask['answers'] as $keyAnswers => $answer) {
                if ($answer[1] === true) {
                    ++$trueAnswers;
                }
                array_pop($partTask['answers'][$keyAnswers]);
            }
        }
        
        // если нет правильных ответов
        if ($trueAnswers === 0) {
            throw new Exception('нет верных ответов');
        }
        
        // добавить опцию к ответу для клиента, сколько верных вариантов ответа - один или несколько
        $partTask['options'] = ['oneAnswer' => $trueAnswers === 1 ? true : false];
        $response = Json::encode($partTask);
        return $response;
    }
    
    public function actionCheckVariety($section_id, $task, $question, $variety) {
        
    }
    
}
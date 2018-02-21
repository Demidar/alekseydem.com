<?php
$this->title = 'Модуль portfolio';
$this->params['breadcrumbs'][] = ['label' => 'Фундамент сайта', 'url' => ['chronicle/create-foundation']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Для создания модуля воспользуюсь средством генерации кода Yii2 gii. Модуль 
    будет называться portfolio и размещен в папке <code>/modules/portfolio</code>.</p>
<p>В стандартном созданном контроллере <code>DefaultController.php</code> будут 
    размещены стартовые страницы данного модуля.</p>
<p>Для модуля будут использоваться несколько составных шаблонов - 
    <code>portfolio-common.php</code> с общими размещаемыми элементами,
    <code>portfolio-chronicle.php</code> с разметкой для страниц дневника 
    портфолио (в том числе и эта страница), и 
    <code>portfolio-capability</code>, где в будущем будут размещены 
    решения комплексных задач. Это разделение будет сделано для удобства ведения
    навигационного сайдбара.</p>
<?php
/**
 * Developed by Hung Ho (Steve): ceo@mozagroup.com | hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.mozagroup.com | www.mozasolution.com | www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "TravelPlans".
 */
use yii\helpers\Html;
use common\components\FHtml;
use common\components\Helper;

$currentRole = FHtml::getCurrentRole();
$controlName = '';
$folder = ''; //manual edit files in 'live' folder only
$canCreate = true;

$moduleName = 'TravelPlans';
$moduleTitle = 'Travel Plans';
$moduleKey = 'travel-plans';
$modulePath = 'travel-plans';

$this->title = FHtml::t($moduleTitle);

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
$this->params['breadcrumbs'][] = FHtml::t('common', 'Create');

$form_layout = FHtml::config(FHtml::SETTINGS_FORM_LAYOUT, '_3cols');

if (FHtml::isInRole('', 'create', $currentRole)) {
    $controlName = $folder . '_form' . $form_layout;
} else {
    $controlName = $folder . '_view' . $form_layout;
}


/* @var $this yii\web\View */
/* @var $model backend\modules\travel\models\TravelPlans */

?>
<div class="travel-plans-create">
    <?php if ($canCreate === true) {
        echo $this->render($controlName, [
            'model' => $model, 'modelMeta' => $modelMeta, 'moduleKey' => $moduleKey, 'modulePath' => $modulePath
        ]);
    } else { ?>
        <?= Html::a(FHtml::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']);
    } ?>
</div>

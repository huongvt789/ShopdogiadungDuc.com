<?php
/**
* Developed by Hung Ho (Steve): ceo@mozagroup.com | hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.mozagroup.com | www.mozasolution.com | www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
* This is the customized model class for table "EcommerceOrder".
*/
use yii\helpers\Html;
use common\components\FHtml;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $model backend\modules\ecommerce\models\EcommerceOrder */

$controlName = '';
$currentRole = FHtml::getCurrentRole();

$moduleName = 'EcommerceOrder';
$moduleTitle = 'Ecommerce Order';
$moduleKey = 'ecommerce-order';
$modulePath = 'ecommerce-order';

$this->title = FHtml::t($moduleTitle);

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
$this->params['breadcrumbs'][] = FHtml::t('common', 'Detail');

$controlName = '_form';
$folder = Fhtml::getRequestParam(['form_type', 'type', 'status']);

?>
<div class="ecommerce-order-view">
    <?= FHtml::render($controlName, $folder, [
    'model' => $model, 'modelMeta' => $modelMeta, 'moduleKey' => $moduleKey, 'modulePath' => $modulePath, 'edit_type' => FHtml::EDIT_TYPE_INLINE, 'display_type' => FHtml::DISPLAY_TYPE_TABLE
    ]) ?>
</div>

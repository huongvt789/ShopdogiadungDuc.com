<?php
use common\widgets\BulkButtonWidget;
use yii\helpers\Html;
use common\components\FHtml;
use common\components\Helper;
use kartik\nav\NavX;
use kartik\dropdown\DropdownX;
use yii\helpers\BaseInflector;

$moduleName = 'TravelAttractions';
$moduleTitle = 'Travel Attractions';
$moduleKey = 'travel_attractions';

$currentRole = FHtml::getCurrentRole();
$createButton = '';
if (FHtml::isInRole('', 'create', $currentRole))
{
    $createButton = FHtml::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;' . FHtml::t('common', 'Create'), ['create'],
        [
            'role' => $this->params['editType'],
            'data-pjax' =>  $this->params['isAjax'] == true ? 1 : 0,
            'title' => FHtml::t('common', 'title.create'),
            'class' => 'btn btn-success',
            'style' => 'float:left;'
        ]);
}

$deleteButton = '';
if (FHtml::isInRole('', 'delete', $currentRole))
{
    $deleteButton = BulkButtonWidget::widget([
        'buttons' => FHtml::a('<i class="glyphicon glyphicon-trash"></i>',
        ["bulk-delete"],
        [
        "class" => "btn btn-danger",
        'role' => 'modal-remote-bulk',
        'data-confirm' => false, 'data-method' => false,// for overide yii data api
        'data-request-method' => 'post',
        'data-confirm-title' => FHtml::t('common', ''),
        'data-confirm-message' => FHtml::t('common', 'Are you sure to delete ?'),
        'style' => 'float:left; margin-left:2px;'
        ]),
        ]);
}

$bulkActionButton = '';
if (FHtml::isInRole('', 'action', $currentRole))
{
    $bulkActionButton = '<div class="dropdown pull-left">&nbsp;<button class="btn btn-default" data-toggle="dropdown">'. FHtml::t('common', 'Actions'). '</button>' . DropdownX::widget([
    'items' =>
    \yii\helpers\ArrayHelper::merge(
    [FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Category Id') . ']:', 'travel_attractions', 'travel_attractions', 'category_id')],
[FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Type') . ']:', 'travel_attractions', 'travel_attractions', 'type')],
[FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Status') . ']:', 'travel_attractions', 'travel_attractions', 'status')],
[FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Is Active') . ']:', 'travel_attractions', 'travel_attractions', 'is_active')],
[FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Is New') . ']:', 'travel_attractions', 'travel_attractions', 'is_new')],
[FHtml::buildBulkActionsMenu(FHtml::t('common', 'Set'). ' ['. FHtml::t('TravelAttractions', 'Is Hot') . ']:', 'travel_attractions', 'travel_attractions', 'is_hot')],
    [FHtml::buildBulkDividerMenu()],
    [FHtml::buildBulkDeleteMenu()]
    )
    ]). '</div>';
}

?>

<div class='row'>
    <div class='col-md-12'>
        <div>
            <?= $createButton ?> <?=  $bulkActionButton ?>
        </div>
        <div class='pull-right'>
            <?=  '{export}' . '{toggleData}' ?>
        </div>
    </div>
</div>
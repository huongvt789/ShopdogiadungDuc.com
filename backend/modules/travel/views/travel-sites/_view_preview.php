<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\Typeahead;
use common\components\FHtml;
use kartik\checkbox\CheckboxX;
use common\widgets\FCKEditor;
use yii\widgets\MaskedInput;
use kartik\money\MaskMoney;
use kartik\slider\Slider;

$form_Type = $this->params['activeForm_type'];

$moduleName = 'TravelSites';
$moduleTitle = 'Travel Sites';
$moduleKey = 'travel-sites';

$currentRole = FHtml::getCurrentRole();
$canEdit = FHtml::isInRole('', FHtml::currentAction(), $currentRole);
$canDelete = FHtml::isInRole('', 'delete', $currentRole);
$field_layout = FHtml::config(FHtml::SETTINGS_FIELD_LAYOUT, FHtml::LAYOUT_TABLE);
$form_label_CSS = 'text-default';

/* @var $this yii\web\View */
/* @var $model backend\modules\travel\models\TravelSites */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if (!Yii::$app->request->isAjax) {
    $this->title = FHtml::t($moduleTitle);
    $this->params['mainIcon'] = 'fa fa-list';
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
} ?>


<?php $form = \common\widgets\FActiveForm::begin([
    'id' => 'travel-sites-form',
    'type' => $form_Type, //ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
    'staticOnly' => false, // check the Role here
    'readonly' => !$canEdit, // check the Role here
    'options' => [
//'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ]
]);

?>


<div class="form">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="portlet light">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span
                            class="caption-subject font-blue-madison bold uppercase"><?= FHtml::t('common', $moduleTitle) ?></span>
                    </div>
                    <div class="tools pull-right">
                        <a href="#" class="fullscreen"></a>
                        <a href="#" class="collapse"></a>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1<?= $model->id ?>" data-toggle="tab"><?= FHtml::t('common', 'Info') ?></a>
                        </li>
                        <li>
                            <a href="#tab_1_4<?= $model->id ?>" data-toggle="tab"><?= FHtml::t('common', 'Is') ?></a>
                        </li>
                        <li>
                            <a href="#tab_1_5<?= $model->id ?>"
                               data-toggle="tab"><?= FHtml::t('common', 'Application') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="form">
                        <div class="form-body">
                            <div class="tab-content">
                                <div class="tab-pane active row" id="tab_1_1<?= $model->id ?>">
                                    <div class="col-md-12">
                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                                               <?= FHtml::showModelField($model, 'city', FHtml::SHOW_LABEL, $field_layout, $form_label_CSS, 'travel', 'city', 'varchar(100)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'keywords', FHtml::SHOW_LABEL, $field_layout, $form_label_CSS, 'travel', 'keywords', 'varchar(100)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'name', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_sites', 'name', 'varchar(255)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'url', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_sites', 'url', 'varchar(2000)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'weight', FHtml::SHOW_NUMBER, $field_layout, $form_label_CSS, 'travel_sites', 'weight', 'int(23)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'search_element', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_sites', 'search_element', 'varchar(255)', '', '') ?>

                                        <?= FHtml::showModelField($model, 'search_result', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_sites', 'search_result', 'varchar(5000)', '', '') ?>

                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                                    </div>
                                </div>
                                <!--<div class="tab-pane row" id="tab_1_2<?= $model->id ?>">
                                    <div class="col-md-12">
                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                                                                                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                                    </div>
                                </div>
                                -->
                                <!--<div class="tab-pane row" id="tab_1_3<?= $model->id ?>">
                                    <div class="col-md-12">
                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                                                                                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                                    </div>
                                </div>
                                -->
                                <div class="tab-pane row" id="tab_1_4<?= $model->id ?>">
                                    <div class="col-md-12">
                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                                                       <?= FHtml::showModelField($model, 'is_active', FHtml::SHOW_ACTIVE, $field_layout, $form_label_CSS, 'travel_sites', 'is_active', 'tinyint(1)', '', '') ?>

                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                                            </div>
                                </div>
                                <div class="tab-pane row" id="tab_1_5<?= $model->id ?>">
                                    <div class="col-md-12">
                                        <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                                                                                                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                                            </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php \common\widgets\FActiveForm::end(); ?>





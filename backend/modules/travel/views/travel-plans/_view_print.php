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

$moduleName = 'TravelPlans';
$moduleTitle = 'Travel Plans';
$moduleKey = 'travel-plans';

$currentRole = FHtml::getCurrentRole();
$canEdit = FHtml::isInRole('', FHtml::currentAction(), $currentRole);
$canDelete = FHtml::isInRole('', 'delete', $currentRole);
$field_layout = FHtml::config(FHtml::SETTINGS_FIELD_LAYOUT, FHtml::LAYOUT_TABLE);
$form_label_CSS = 'text-default';

/* @var $this yii\web\View */
/* @var $model backend\modules\travel\models\TravelPlans */
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
    'id' => 'travel-plans-form',
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
                <?= $this->render(\Globals::VIEWS_PRINT_HEADER, ['form_type' => $moduleName, 'title' => $model->name]) ?>
                <h3><?= FHtml::t('common', 'Common') ?></h3>
                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                       <?= FHtml::showModelField($model, 'id', FHtml::SHOW_LABEL, $field_layout, $form_label_CSS, 'travel_plans', 'id', 'bigint(20)', '', '') ?>

                <?= FHtml::showModelField($model, 'name', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_plans', 'name', 'varchar(255)', '', '') ?>

                <?= FHtml::showModelField($model, 'day', FHtml::SHOW_NUMBER, $field_layout, $form_label_CSS, 'travel_plans', 'day', 'int(11)', '', '') ?>

                <?= FHtml::showModelField($model, 'note', FHtml::SHOW_HTML, $field_layout, $form_label_CSS, 'travel_plans', 'note', 'text', '', '') ?>

                <?= FHtml::showModelField($model, 'is_locked', FHtml::SHOW_ACTIVE, $field_layout, $form_label_CSS, 'travel_plans', 'is_locked', 'tinyint(1)', '', '') ?>

                <?= FHtml::showModelField($model, 'next_plan_id', FHtml::SHOW_LOOKUP, $field_layout, $form_label_CSS, '@travel_plans', 'next_plan_id', 'varchar(100)', '', '') ?>

                <?= FHtml::showModelField($model, 'next_attraction_id', FHtml::SHOW_LOOKUP, $field_layout, $form_label_CSS, '@travel_attractions', 'next_attraction_id', 'varchar(100)', '', '') ?>

                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>
                <h3><?= FHtml::t('common', 'Attraction') ?></h3>
                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                       <?= FHtml::showModelField($model, 'attraction_id', FHtml::SHOW_LOOKUP, $field_layout, $form_label_CSS, '@travel_attractions', 'attraction_id', 'varchar(100)', '', '') ?>

                <?= FHtml::showModelField($model, 'attraction_arrived', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_plans', 'attraction_arrived', 'varchar(255)', '', '') ?>

                <?= FHtml::showModelField($model, 'attraction_duration', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_plans', 'attraction_duration', 'varchar(255)', '', '') ?>

                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>
                <h3><?= FHtml::t('common', 'Travel') ?></h3>
                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                       <?= FHtml::showModelField($model, 'travel_by', FHtml::SHOW_LABEL, $field_layout, $form_label_CSS, 'travel_plans', 'travel_by', 'varchar(100)', '', '') ?>

                <?= FHtml::showModelField($model, 'travel_duration', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_plans', 'travel_duration', 'varchar(255)', '', '') ?>

                <?= FHtml::showModelField($model, 'travel_distance', FHtml::SHOW_TEXT, $field_layout, $form_label_CSS, 'travel_plans', 'travel_distance', 'varchar(255)', '', '') ?>

                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>
                <h3><?= FHtml::t('common', 'User') ?></h3>
                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '<table class="table table-bordered">' : '' ?>                       <?= FHtml::showModelField($model, 'user_id', FHtml::SHOW_LOOKUP, $field_layout, $form_label_CSS, '@user', 'user_id', 'varchar(100)', '', '') ?>

                <?= FHtml::showModelField($model, 'user_itinerary_id', FHtml::SHOW_LOOKUP, $field_layout, $form_label_CSS, '@travel_itinerary', 'user_itinerary_id', 'varchar(100)', '', '') ?>

                <?= ($field_layout == FHtml::LAYOUT_TABLE) ? '</table>' : '' ?>                            </div>

            <?php if (Yii::$app->request->isAjax) { ?>

                <input type="hidden" id="saveType" name="saveType">

            <?php } else { ?>
                <p class="hidden-print">
                    <a class="btn blue hidden-print " onclick="javascript:window.print();"> Print
                        <i class="fa fa-print"></i>
                    </a>
                    <?php if (FHtml::isInRole('', 'update', $currentRole)) {
                        FHtml::a('<i class="fa fa-pencil"></i> ' . FHtml::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    } ?>
                    <?php if (FHtml::isInRole('', 'delete', $currentRole)) {
                        FHtml::a('<i class="fa fa-trash"></i> ' . FHtml::t('common', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger pull-right',
                            'data' => [
                                'confirm' => FHtml::t('common', 'Are you sure to delete ?'),
                                'method' => 'post',
                            ],
                        ]);
                    } ?>
                    <?= FHtml::a('<i class="fa fa-undo"></i> ' . FHtml::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>

                </p>
            <?php } ?>        </div>
    </div>
</div>
<?php \common\widgets\FActiveForm::end(); ?>





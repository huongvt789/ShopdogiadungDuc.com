<?php
/**
 * Developed by Hung Ho (Steve): ceo@mozagroup.com | hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.mozagroup.com | www.mozasolution.com | www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "MusicPlaylist".
 */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use common\widgets\FActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\Typeahead;
use common\components\FHtml;
use kartik\checkbox\CheckboxX;
use common\widgets\FCKEditor;
use yii\widgets\MaskedInput;
use kartik\money\MaskMoney;
use kartik\slider\Slider;
use common\widgets\formfield\FormObjectFile;
use common\widgets\formfield\FormObjectAttributes;
use common\widgets\formfield\FormRelations;
use common\widgets\FFormTable;
use yii\widgets\Pjax;

$form_Type = $this->params['activeForm_type'];

$moduleName = 'MusicPlaylist';
$moduleTitle = 'Music Playlist';
$moduleKey = 'music-playlist';

$currentRole = FHtml::getCurrentRole();
$currentAction = FHtml::currentAction();

$canEdit = FHtml::isInRole('', 'edit', $currentRole, FHtml::getFieldValue($model, ['user_id', 'created_user']));
$canDelete = FHtml::isInRole('', 'delete', $currentRole);
$edit_type = isset($edit_type) ? $edit_type : (FHtml::isViewAction($currentAction) ? FHtml::EDIT_TYPE_VIEW : FHtml::EDIT_TYPE_DEFAULT);
$display_type = isset($display_type) ? $display_type : (FHtml::isViewAction($currentAction) ? FHtml::DISPLAY_TYPE_TABLE : FHtml::DISPLAY_TYPE_DEFAULT);

$ajax = isset($ajax) ? $ajax : (FHtml::isListAction($currentAction) ? false : true);

/* @var $this yii\web\View */
/* @var $model backend\modules\music\models\MusicPlaylist */
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

<?php if ($ajax) Pjax::begin(['id' => 'crud-datatable']) ?>

<?php $form = FActiveForm::begin([
    'id' => 'music-playlist-form',
    'type' => $form_Type, //ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
    'staticOnly' => false, // check the Role here
    'readonly' => !$canEdit, // check the Role here
    'edit_type' => $edit_type,
    'display_type' => $display_type,
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'options' => [
        //'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ]
]);
?>


<div class="form">
    <div class="row">

        <div class="col-md-9">
            <div class="portlet light">
                <div class="visible-print">
                    <?= (FHtml::isViewAction($currentAction)) ? FHtml::showPrintHeader($moduleName) : '' ?>
                </div>
                <div class="portlet-title tabbable-line hidden-print">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">
                            <?= FHtml::t('common', $moduleTitle) ?>
                            : <?= FHtml::showObjectConfigLink($model, FHtml::FIELDS_NAME) ?>                        </span>
                    </div>
                    <div class="tools pull-right">
                        <a href="#" class="fullscreen"></a>
                        <a href="#" class="collapse"></a>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab"><?= FHtml::t('common', 'Info') ?></a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab"><?= FHtml::t('common', 'Uploads') ?></a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab"><?= FHtml::t('common', 'Attributes') ?></a>
                        </li>
                        <li>
                            <a href="#tab_1_4" data-toggle="tab"><?= FHtml::t('common', 'MusicSong') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body form">
                    <div class="form">
                        <div class="form-body">
                            <div class="tab-content">
                                <div class="tab-pane active row" id="tab_1_1">
                                    <div class="col-md-12">
                                        <?php echo FFormTable::widget(['model' => $model, 'form' => $form, 'columns' => 1, 'attributes' => [
                                            'name' => ['value' => $form->fieldNoLabel($model, 'name')->textInput(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'description' => ['value' => $form->fieldNoLabel($model, 'description')->textarea(['rows' => 3]), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'release_date' => ['value' => $form->fieldNoLabel($model, 'release_date')->date(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'songs_count' => ['value' => $form->fieldNoLabel($model, 'songs_count')->numeric(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'songs_duration' => ['value' => $form->fieldNoLabel($model, 'songs_duration')->time(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'rates' => ['value' => $form->fieldNoLabel($model, 'rates')->rate(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],


                                        ]]); ?>


                                        <?php echo FFormTable::widget(['model' => $model, 'title' => FHtml::t('common', 'Group'), 'form' => $form, 'columns' => 2, 'attributes' => [

                                            'lang' => ['value' => $form->fieldNoLabel($model, 'lang')->select(FHtml::getComboArray('music_playlist', 'music_playlist', 'lang', true, 'id', 'name')), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'type' => ['value' => $form->fieldNoLabel($model, 'type')->select(FHtml::getComboArray('music_playlist', 'music_playlist', 'type', true, 'id', 'name')), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'category_id' => ['value' => $form->fieldNoLabel($model, 'category_id_array')->selectMany(FHtml::getComboArray('music', 'music', 'category_id', true, 'id', 'name')), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],


                                        ]]); ?>



                                        <?php echo FFormTable::widget(['model' => $model, 'title' => FHtml::t('common', 'is'), 'form' => $form, 'columns' => 2, 'attributes' => [

                                            'is_active' => ['value' => $form->fieldNoLabel($model, 'is_active')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'is_top' => ['value' => $form->fieldNoLabel($model, 'is_top')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'is_new' => ['value' => $form->fieldNoLabel($model, 'is_new')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'is_hot' => ['value' => $form->fieldNoLabel($model, 'is_hot')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'is_album' => ['value' => $form->fieldNoLabel($model, 'is_album')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'is_video' => ['value' => $form->fieldNoLabel($model, 'is_video')->checkbox(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],


                                        ]]); ?>

                                        <?php echo FFormTable::widget(['model' => $model, 'title' => FHtml::t('common', 'count'), 'form' => $form, 'columns' => 2, 'attributes' => [

                                            'count_views' => ['value' => $form->fieldNoLabel($model, 'count_views')->numeric(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'count_likes' => ['value' => $form->fieldNoLabel($model, 'count_likes')->numeric(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'count_purchase' => ['value' => $form->fieldNoLabel($model, 'count_purchase')->numeric(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'count_rates' => ['value' => $form->fieldNoLabel($model, 'count_rates')->numeric(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],

                                        ]]); ?>
                                    </div>
                                </div>

                                <div class="tab-pane row" id="tab_1_2">
                                    <div class="col-md-12">
                                        <?php echo FFormTable::widget(['model' => $model, 'title' => '', 'form' => $form, 'columns' => 1, 'attributes' => [

                                            'thumbnail' => ['value' => $form->fieldNoLabel($model, 'thumbnail')->image(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],
                                            'image' => ['value' => $form->fieldNoLabel($model, 'image')->image(), 'columnOptions' => ['colspan' => 1], 'type' => FHtml::INPUT_RAW],

                                        ]]); ?>


                                    </div>
                                </div>
                                <div class="tab-pane row" id="tab_1_3">
                                    <div class="col-md-12">
                                        <?= FormObjectAttributes::widget( [
                                            'model' => $model, 'form' => $form,
                                            'canEdit' => $canEdit, 'moduleKey' => $moduleKey, 'modulePath' => $modulePath
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="tab-pane row" id="tab_1_4">
                                    <div class="col-md-12">
                                        <?= FormRelations::widget([
                                            'model' => $model, 'form' => $form,
                                            'field_name' => 'MusicSong', 'object_type' => 'music_song', 'relation_type' => '',
                                            'canEdit' => $canEdit, 'moduleKey' => $moduleKey, 'modulePath' => $modulePath
                                        ]) ?>

                                    </div>
                                </div>

                                <!--<div class="tab-pane row" id="tab_1_p">
                                    <div class="col-md-12">
                                                                            </div>
                                </div>
                                -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <?php $type = FHtml::getFieldValue($model, 'type');
            if (isset($modelMeta) && !empty($type))
                echo FHtml::render('..\\' . $moduleKey . '-' . $type . '\\_form.php', '', ['model' => $modelMeta, 'display_actions' => false, 'canEdit' => $canEdit, 'canDelete' => $canDelete]);
            ?>
            <?= (FHtml::isViewAction($currentAction)) ? FHtml::showViewButtons($model, $canEdit, $canDelete) : FHtml::showActionsButton($model, $canEdit, $canDelete) ?>

        </div>
        <div class="profile-sidebar col-md-3 col-xs-12 hidden-print">
            <div class="portlet light">
                <?= FHtml::showModelPreview($model) ?>
            </div>
        </div>
    </div>
</div>
<?php FActiveForm::end(); ?>
<?php if ($ajax) Pjax::end() ?>

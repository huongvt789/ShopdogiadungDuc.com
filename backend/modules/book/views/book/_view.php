<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use \common\components\FHtml;
use common\components\Helper;
use common\widgets\FDetailView;
use yii\widgets\Pjax;

$moduleName = 'Book';

$currentRole = FHtml::getCurrentRole();
$currentAction = FHtml::currentAction();

$canEdit = FHtml::isInRole('', 'edit', $currentRole, FHtml::getFieldValue($model, ['user_id', 'created_user']));
$canDelete = FHtml::isInRole('', 'delete', $currentRole);

$print = isset($print) ? $print : true;
$ajax = isset($ajax) ? $ajax : (FHtml::isListAction($currentAction) ? false : true);

/* @var $this yii\web\View */
/* @var $model backend\modules\book\models\Book */
?>
<?php if (!Yii::$app->request->isAjax) {
$this->title = 'Books';
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
$this->params['mainIcon'] = 'fa fa-list';
} ?>
<?php if ($ajax) Pjax::begin(['id' => 'crud-datatable'])  ?>

<?php if (Yii::$app->request->isAjax) { ?>
<div class="book-view">

       <?= FDetailView::widget([
    'model' => $model,
    'attributes' => [
                    'id',
                'image',
                'title',
                'author',
                'publisher',
                'description',
                'attachment',
                'type',
                'category_id',
                'view_count',
                'like_count',
                'is_feature',
                'is_active',
                'created_date',
                'modified_date',
    ],
    ]) ?>
</div>
<?php } else { ?>

        <div class="row" style="padding: 20px">
            <div class="col-md-12" style="background-color: white; padding: 20px">
                <?= FDetailView::widget([
                'model' => $model,
                'attributes' => [
                                'id',
                'image',
                'title',
                'author',
                'publisher',
                'description',
                'attachment',
                'type',
                'category_id',
                'view_count',
                'like_count',
                'is_feature',
                'is_active',
                'created_date',
                'modified_date',
                ],
                ]) ?>

            </div>

        </div>

<?php } ?><?php if ($ajax) Pjax::end()  ?>


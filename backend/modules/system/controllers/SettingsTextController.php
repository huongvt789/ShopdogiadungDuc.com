<?php
/**
* Developed by Hung Ho (Steve): ceo@mozagroup.com | hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.mozagroup.com | www.mozasolution.com | www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
* This is the customized model class for table "SettingsText".
*/
namespace backend\modules\system\controllers;

use Yii;
use backend\modules\system\models\SettingsText;
use backend\modules\system\models\SettingsTextSearch;
//use yii\web\Controller;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;

use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\components\AccessRule;
use common\models\User;
use yii\filters\AccessControl;
use common\components\FHtml;

use yii\helpers\ArrayHelper;

/**
 * SettingsTextController implements the CRUD actions for SettingsText model.
 */
class SettingsTextController extends AdminController
{
    protected $moduleName = 'SettingsText';
    protected $moduleTitle = 'Settings Text';
    protected $moduleKey = 'settings_text';

/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete', 'view', 'index'],
                'rules' => [
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all SettingsText models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SettingsTextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

           // validate if there is a editable input saved via AJAX
           if (Yii::$app->request->post('hasEditable')) {
               // instantiate your book model for saving
               $Id = Yii::$app->request->post('editableKey');

               $model = SettingsText::findOne($Id);

               // store a default json response as desired by editable
               $out = Json::encode(['output' => '', 'message' => '']);

               // fetch the first entry in posted data (there should
               // only be one entry anyway in this array for an
               // editable submission)
               // - $posted is the posted data for Book without any indexes
               // - $post is the converted array for single model validation
               $post = [];
               $posted = current($_POST['SettingsText']);
               $post['SettingsText'] = $posted;

               // load model like any single model validation
               if ($model->load($post)) {
                   // can save model or do something before saving model
                   $model->save();

                   // custom output to return to be displayed as the editable grid cell
                   // data. Normally this is empty - whereby whatever value is edited by
                   // in the input by user is updated automatically.
                   $output = '';
                   // similarly you can check if the name attribute was posted as well
                   // if (isset($posted['name'])) {
                   //   $output =  ''; // process as you need
                   // }
                   $out = Json::encode(['output' => $output, 'message' => '']);
               }
               // return ajax json encoded response and exit
               echo $out;
               return;
           }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single SettingsText model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;

        $model = $this->findModel($id);
        $type = FHtml::getFieldValue($model, 'type');
        $modelMeta = FHtml::createMetaModel($this->moduleKey, $type, $model->id);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> FHtml::t($this->moduleName)." #".$id,
                    'content'=>$this->renderPartial('_view_preview', [
                        'model' => $model, 'modelMeta' => $modelMeta
                    ]),
                    'footer'=>Html::a(FHtml::t('Update'),['update','id'=>$id],['class'=>'btn btn-primary pull-left','role'=>$this->view->params['displayType']]).
                              Html::button(FHtml::t('Close'),['class'=>'btn btn-default','data-dismiss'=>"modal"])
                ];
        }else{
            return $this->render('view', [
                'model' => $model, 'modelMeta' => $modelMeta
            ]);
        }
    }

    /**
     * Creates a new SettingsText model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type = false)
    {
        $request = Yii::$app->request;
        $model = $this->createModel($this->moduleKey, '', ['type' => $type]);

        $returnParams = FHtml::RequestParams(['id']);
        if (!empty($type))
            $returnParams = ['type' => $type];

        $modelMeta = FHtml::createMetaModel($this->moduleKey, $type);

        $uploadFields = SettingsText::COLUMNS_UPLOAD;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> FHtml::t($this->moduleName),
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(FHtml::t('Create'),['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> FHtml::t($this->moduleName),
                'content'=>'<span class="text-success">Create SettingsText success</span>',
                'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::a(FHtml::t('Create more'),['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
            return [
            'title'=> FHtml::t($this->moduleName),
            'content'=>$this->renderAjax('create', [
            'model' => $model,
            ]),
            'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
            Html::button(FHtml::t('Create'),['class'=>'btn btn-primary','type'=>"submit"])

            ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            $oldModel = clone $model;
            if ($model->load($request->post())) {
                FHtml::prepareDefaultValues($model, ['category_id_array', 'created_date', 'created_user', 'is_active', 'application_id']);

                if ($model->save()) {
                    FHtml::saveModel($modelMeta, $request->post(), ['settings_text_id' => $model->id]);

                    $files =FHtml::getUploadedFiles($model, $uploadFields, 'settings-text' . FHtml::getAttribute($model, 'id'), $oldModel);

                    FHtml::saveFiles($files, $this->uploadFolder .  '/settings-text/', $model);
                    FHtml::saveObjectItems($model, $this->moduleKey, $model->id, $model::getRelatedObjects());

                    if ($this->saveType() == 'clone')
                    {
                        return $this->redirect(ArrayHelper::merge(['create', 'id' => $model->id], $returnParams ));
                    }
                    return $this->redirect(ArrayHelper::merge(['index'], $returnParams ));
                }
                return $this->render('create', [
                    'model' => $model,
                    'modelMeta' => $modelMeta,
                ]);
            } else {
                FHtml::prepareDefaultValues($model, ['created_date', 'created_user', 'is_active', 'application_id'], FHtml::ACTION_LOAD);

                return $this->render('create', [
                    'model' => $model,
                    'modelMeta' => $modelMeta
                ]);
            }
        }
       
    }

    /**
     * Updates an existing SettingsText model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $type = FHtml::getRequestParam('type');
        $returnParams = FHtml::RequestParams(['id']);
        if (!empty($type))
            $returnParams = ['type' => $type];

        $type = FHtml::getFieldValue($model, 'type');
        $modelMeta = FHtml::createMetaModel($this->moduleKey, $type, $id);

        $uploadFields = SettingsText::COLUMNS_UPLOAD;


        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> FHtml::t($this->moduleName)." #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $model, 'modelMeta' => $modelMeta,
                    ]),
                    'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(FHtml::t('Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> FHtml::t($this->moduleName)." #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model, 'modelMeta' => $modelMeta,
                        ]),
                        'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a(FHtml::t('update'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
            }else{
                    return [
                        'title'=> FHtml::t($this->moduleName)." #".$id,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model, 'modelMeta' => $modelMeta
                        ]),
                        'footer'=> Html::button(FHtml::t('Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button(FHtml::t('Save'),['class'=>'btn btn-primary','type'=>"submit"])
                    ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            $oldModel = clone $model;
            if ($model->load($request->post())) {
                FHtml::prepareDefaultValues($model, ['category_id_array', 'modified_date', 'modified_user']);

                $files =FHtml::getUploadedFiles($model, $uploadFields, 'settings-text' . FHtml::getAttribute($model, 'id'), $oldModel);

                if ($model->save()) {
                    FHtml::saveFiles($files, $this->uploadFolder .  '/settings-text/');
                    FHtml::saveModel($modelMeta, $request->post(), ['settings_text_id' => $model->id]);
                    FHtml::saveObjectItems($model, $this->moduleKey, $model->id, $model::getRelatedObjects());
                    if ($this->saveType() == 'clone')
                    {
                        return $this->redirect(['create', 'id' => $model->id, 'type' => $type]);
                    }
                    return $this->redirect(ArrayHelper::merge(['index'], $returnParams ));
                }
                return $this->render('update', [
                    'model' => $model, 'modelMeta' => $modelMeta ]);
            } else {
                FHtml::prepareDefaultValues($model, ['modified_date', 'modified_user', 'category_id_array'], FHtml::ACTION_LOAD);

                return $this->render('update', [
                    'model' => $model, 'modelMeta' => $modelMeta
                ]);
            }
        }
    }

    /**
     * Delete an existing SettingsText model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

     /**
     * Delete multiple existing SettingsText model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            if (isset($model)) {
                $model->delete();
            }
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    public function actionBulkAction($action = '', $field = '', $value = '')
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
        $model = $this->findModel($pk);
        if (isset($model)) {
            if ($action == 'change') {
                $model[$field] = $value;
                $model->save();
                }
            }
        }

        if($request->isAjax){
        /*
        *   Process for ajax request
        */
        Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        }else{
        /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }



    /**
     * Finds the SettingsText model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SettingsText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingsText::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

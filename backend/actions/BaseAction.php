<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\actions;

use backend\modules\app\models\AppUserTokenAPI;
use common\components\Response;
use Yii;
use common\components\FHtml;

/**
 * Action is the base class for action classes that implement RESTful API.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BaseAction extends \yii\base\Action
{
    public $checkAccess;
    public $listname;
    public $objectname;
    public $objectid;
    public $fields;
    public $params;
    public $paramsArray;
    public $orderby;
    public $limit;
    public $page;
    public $lang;
    public $application_id;
    public $category_id;
    public $user_id;
    public $token;
    public $keyword;
    public $is_secured = true;

    protected function prepareParams($fieldsSearchKeyword = '') {

        $this->listname = isset($this->listname) ? $this->listname : FHtml::getRequestParam(['object', 'n', 'name', 'list', 'listname', 'table']);
        $this->objectname = isset($this->objectname) ? $this->objectname : FHtml::getRequestParam(['object', 'n', 'name', 'detail', 'objectname', 'table']);
        $this->objectid = isset($this->objectid) ? $this->objectid : FHtml::getRequestParam(['id', 'objectid']);

        $this->fields = isset($this->fields) ? $this->fields : FHtml::getRequestParam(['fields', 'columns']);
        $this->keyword = isset($this->keyword) ? $this->keyword : FHtml::getRequestParam(['keyword', 'k']);

        $this->params = isset($this->params) ? $this->params : FHtml::getRequestParam(['params', 'search', 'filter', 's']);

        $this->orderby = isset($this->orderby) ? $this->orderby : FHtml::getRequestParam(['sort', 'order', 'sort_by', 'order_by', 'orderby']);
        $this->limit = isset($this->limit) ? $this->limit : FHtml::getRequestParam(['limit', 'page_size', 'pagesize'], -1);
        $this->page = isset($this->page) ? $this->page : FHtml::getRequestParam(['page', 'p', 'page_index'], 1);
        $this->lang = isset($this->lang) ? $this->lang : FHtml::getRequestParam('lang', 'l');
        $this->application_id = isset($this->application_id) ? $this->application_id : FHtml::getRequestParam(['application_id', 'client_id']);
        $this->user_id = isset($this->user_id) ? $this->user_id : FHtml::getRequestParam(['user_id', 'user']);
        $this->token = isset($this->token) ? $this->token : FHtml::getRequestParam('token');

        $this->paramsArray = $_REQUEST;
        //Default Search Params: lang, application_id
        $this->paramsArray = FHtml::mergeRequestParams($this->paramsArray,
            [
                'lang' => $this->lang,
                'application_id' => $this->application_id,
            ]);

        if (!empty($this->params))
            $this->paramsArray = FHtml::mergeRequestParams($this->paramsArray, FHtml::decode($this->params));

    }

    protected function html_decode_x2($xml_string_html)
    {
        if (count($xml_string_html) > 0)
            return strip_tags(html_entity_decode(html_entity_decode(str_replace("&nbsp;", "", $xml_string_html))));
        else return $xml_string_html;
    }

    public function beforeRun()
    {
        $this->prepareParams();
        return parent::beforeRun(); // TODO: Change the autogenerated stub
    }

    public function isAuthorized(){
        if(!$this->is_secured){
            return true;
        }
        $token = FHtml::getRequestParam('token', '');
        //$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';

        if(strlen($token) != 0)
        {
            $login_token = AppUserTokenAPI::find()->where(['token' => $token])->one();
            if (isset($login_token)){
                if(isset ($login_token->user)){
                    $this->user_id = $login_token->user->id;
                    return true;
                }else{
                    $login_token->delete();
                    return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(221), ['code' => 221]);
                }
            }
            else{
                return Response::getOutputForAPI('', \Globals::ERROR, \Globals::TOKEN_MISMATCH, ['code' => 205]);
            }
        }
        else
        {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Token missing', ['code' => 204]);
        }
    }
}

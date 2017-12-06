<?php
/**
 * Created by PhpStorm.
 * User: Quan
 * Date: 13/07/2017
 * Time: 9:46 SA
 */

namespace common\widgets\fsocialshare;

use common\widgets\BaseWidget;

class FFb extends  BaseWidget
{
    public $width;
    public $numposts;
    public $url;

    public $name_page;
    public $tabs ;
    public $small_header;
    public $container_width;
    public $hide_cover;
    public $show_facepile;
    public $title;
    public $height;

    public $appID;
    public $lang;

    public $layout;
    public $action;
    public $size;
    public $faces;
    public $share;

    protected function prepareData()
    {
        $this->page_code = !empty($this->page_code) ? $this->page_code : 'common';
        $this->show_headline = false;
        $this->display_type = !empty($this->display_type) ? $this->display_type : 'comment_fb.php';
        parent::prepareData();  // TODO: Change the autogenerated stub
    }

    public function run()
    {
        self::prepareData();
        return $this->render($this->display_type ,
            [
                'width' => $this->width,
                'numposts' => $this->numposts,
                'url' => $this->url,

                'name_page' => $this->name_page,
                'tabs' => $this->tabs,
                'small_header' => $this->small_header,
                'container_width' => $this->container_width,
                'hide_cover' => $this->hide_cover,
                'show_facepile' => $this->show_facepile,
                'title' => $this->title,
                'height' => $this->height,

                'appID' => $this->appID,
                'lang' => $this->lang,

                'layout' => $this->layout,
                'action' => $this->action,
                'size' => $this->size,
                'faces' => $this->faces,
                'share' => $this->share
            ]);
    }
}
?>
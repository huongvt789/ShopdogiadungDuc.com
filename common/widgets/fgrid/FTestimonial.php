<?php
namespace common\widgets\fgrid;

use backend\modules\cms\models\CmsTestimonial;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

class FTestimonial extends FGrid
{
    public function run()
    {
        $this::prepareData();

        return parent::run();
    }

    protected function prepareData()
    {
        if (empty($this->object_type))
            $this->object_type = 'cms_testimonial';

        $this->image_folder = !empty($this->image_folder) ? $this->image_folder : 'cms-testimonial';

        $this->display_type = !empty($this->display_type) ? $this->display_type : FHtml::generateRandomInArray(['ftestimonial', 'fcarousel1', 'ftestimonial1']);

        $this->title = !empty($this->title) ? $this->title : '';
        $this->overview = !empty($this->overview) ? $this->overview : '';

        $this->title_display_type = !empty($this->title_display_type) ? $this->title_display_type : FHtml::HEADLINE_TYPE_CENTER_V2;

        $this->item_layout = !empty($this->item_layout) ? $this->item_layout : FHtml::LAYOUT_NO_LABEL;

        $this->link_url = !empty($this->link_url) ? $this->link_url : 'testimonial/view';

        $this->field_overview = !empty($this->field_overview) ? $this->field_overview : 'content';

        $this->field_type = !empty($this->field_type) ? $this->field_type : 'description';

        $this->image_height = !empty($this->image_height) ? $this->image_height : 150;

        $this->items_count = !empty($this->items_count) ? $this->items_count : 12;

        $this->columns_count = !empty($this->columns_count) ? $this->columns_count : 4;

        $this->background_css = !empty($this->background_css) ? $this->background_css : '';

        if ($this->background_css == 'random')
            $this->background_css = FHtml::generateRandomInArray(FHtml::WIDGET_BACKGROUND_ARRAYS);

        $this->width_css = !empty($this->width_css) ? $this->width_css : FHtml::WIDGET_WIDTH_CONTAINER;

        if (empty($this->items))
            $this->items = CmsTestimonial::find(ArrayHelper::merge($this->items_filter, ['is_active' => 1]))->limit($this->items_count)->orderBy('created_date Desc')->all();

        parent::prepareData(); // TODO: Change the autogenerated stub
    }
}

?>
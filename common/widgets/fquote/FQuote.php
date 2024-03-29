<?php
namespace common\widgets\FQuote;

use backend\modules\cms\models\CmsTestimonial;
use common\components\FHtml;
use common\widgets\BaseWidget;
use yii\helpers\ArrayHelper;

class FQuote extends BaseWidget
{
    public function run()
    {
        self::prepareData();
        $this->show_headline = false;
        return $this->render($this->display_type,
            [
                'title' => $this->title, 'overview' => $this->overview,
                'color' => $this->color,
                'background_css' => $this->background_css,
                'field_title' => $this->field_title,
                'field_overview' => $this->field_overview,
                'width_css' => $this->width_css
            ]);
    }

    protected function prepareData()
    {
        if (empty($this->items_count))
            $this->items_count = 4;

        if (empty($this->display_type))
            $this->display_type = 'quote3';

        if (empty($this->width_css)) {
            $this->width_css = FHtml::WIDGET_WIDTH_FULL;
        }

        if (empty($this->field_title))
            $this->field_title = ['name', 'title'];

        if (empty($this->field_overview))
            $this->field_overview = ['overview', 'description', 'content'];

        if (empty($this->items))
            $this->items = CmsTestimonial::find()->where(ArrayHelper::merge($this->items_filter, ['is_active' => 1, 'is_top' => 1]))->limit($this->items_count)->orderBy('created_date Desc')->all();

        if (count($this->items) > 0)
            $item = $this->items[rand(0, count($this->items) - 1)];
        else
            $item = null;

        if (empty($this->overview) && isset($item))
            $this->overview = FHtml::getFieldValue($item, $this->field_title) . ', ' . FHtml::getFieldValue($item, $this->field_overview);

        if (empty($this->title) && isset($item))
            $this->title = $item->content;

        parent::prepareData(); // TODO: Change the autogenerated stub
    }
}

?>
<?php


namespace cabinet\widgets;


use yii\base\Widget;

class LimiterPage extends Widget
{

    public function run()
    {


        return $this->render("limiterView");
    }
}
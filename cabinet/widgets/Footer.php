<?php


namespace cabinet\widgets;


use yii\base\Widget;

class Footer extends Widget
{

    public function run()
    {


        return $this->render("footerViews");
    }
}
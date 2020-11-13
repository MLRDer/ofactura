<?php


namespace cabinet\widgets;


use yii\base\Widget;

class Sidebar extends Widget
{

    public function run()
    {


        return $this->render("sideBarView");
    }
}
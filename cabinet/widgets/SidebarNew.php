<?php


namespace cabinet\widgets;


use Yii;
use yii\base\Widget;

class HeadersNew extends Widget
{

    public function run()
    {

        return $this->render("sidebarNewView",[
            'currentLang' => $currentLang,
            'languages' => $languages
        ]);
    }
}
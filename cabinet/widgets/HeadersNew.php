<?php


namespace cabinet\widgets;


use Yii;
use yii\base\Widget;

class HeadersNew extends Widget
{

    public function run()
    {
        $currentLang = Yii::$app->language;
        $languages = Yii::$app->params['languages'];
        return $this->render("headersNewView",[
            'currentLang' => $currentLang,
            'languages' => $languages
        ]);
    }
}
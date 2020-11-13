<?php


namespace cabinet\widgets;


use Yii;
use yii\base\Widget;

class Headers extends Widget
{

    public function run()
    {
        $currentLang = Yii::$app->language;
        $languages = Yii::$app->params['languages'];
        return $this->render("headersView",[
            'currentLang' => $currentLang,
            'languages' => $languages
        ]);
    }
}
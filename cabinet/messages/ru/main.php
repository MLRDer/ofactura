<?php
return  \yii\helpers\ArrayHelper::map(\common\models\SourceMessage::find()->all(),'key_name','name_ru');
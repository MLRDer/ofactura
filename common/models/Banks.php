<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $bankId
 * @property string $Name
 * @property int|null $enabled
 */
class Banks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bankId', 'Name'], 'required'],
            [['enabled'], 'integer'],
            [['bankId'], 'string', 'max' => 10],
            [['Name'], 'string', 'max' => 255],
            [['bankId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function getBanks(){
        $host = Yii::$app->params['factura_host'];
        $login = Yii::$app->params['factura_login'];
        $password = Yii::$app->params['factura_passwd'];
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode( $login.":".$password)
            )
        );
        $context = stream_context_create($opts);

        $url = $host."/provider/api/uz/catalogs/bank";
        return Json::decode(file_get_contents($url, false, $context));
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bankId' => 'Bank ID',
            'Name' => 'Name',
            'enabled' => 'Enabled',
        ];
    }
}

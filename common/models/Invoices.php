<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property int $company_id
 * @property int $type_invoices
 * @property string $created_date
 * @property string $reason;
 * @property string $tin;
 * @property int $value
 * @property int $saldo_value
 * @property int $type_action
 * @property int|null $tarif_id
 * @property int|null $type_pay
 * @property int|null $status
 * @property int|null $enabled
 * @property int|null $bank_data_id
 * @property int|null $manual_log_id
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    const PAY_PAYME = 1;
    const PAY_ALOQABANK = 2;
    const PAY_MANUAL = 3;

    const FOR_MONTH = 2;
    const FOR_DOCS = 1;
    const FOR_TRANSFER = 3;
    const FOR_IN= 4;


    const PAY =1;
    const INVOICES = 0;
    public $company_name;
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'type_invoices', 'created_date', 'value'], 'required'],
            [['company_id', 'type_invoices', 'value', 'tarif_id', 'type_pay', 'status', 'enabled','saldo_value','type_action','bank_data_id','manual_log_id'], 'integer'],
            [['created_date'], 'safe'],
            [['reason','tin'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Korxona ID',
            'type_invoices' => 'Tranzaksiya turi',
            'created_date' => 'Sana',
            'value' => 'Qiymati',
            'tarif_id' => 'Tarif',
            'type_pay' => 'To`lov turi',
            'status' => 'Xolati',
            'enabled' => 'Faol',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->type_invoices ==1) {
                $data = Company::findOne(['id' => $this->company_id]);
                if (!empty($data)) {
                    $data->invoices_sum = $data->invoices_sum + $this->value;
                    $data->save();
                }
            }

            if($this->type_pay ==3) {
                $logModel = new ManualPayLog();
                $logModel->user_id = Yii::$app->user->id;
                $logModel->client_ip = Yii::$app->getRequest()->getUserIP();
                $logModel->created_date = date('Y-m-d H:i:s');
                $logModel->pay_sum = $this->value;
                $logModel->company_id = $this->company_id;
                $logModel->descriptions = $this->reason;
                $logModel->type=1;
                $logModel->enabled=1;
                if(!$logModel->save()){
                    return false;
                }else{
                    $this->manual_log_id = $logModel->id;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}

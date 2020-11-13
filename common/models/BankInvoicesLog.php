<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_invoices_log".
 *
 * @property int $id
 * @property string|null $docId
 * @property string|null $docNumb
 * @property string|null $currDay
 * @property string|null $codeFilial
 * @property string|null $clMfo
 * @property string|null $clAcc
 * @property string|null $clInn
 * @property string|null $clName
 * @property string|null $coMfo
 * @property string|null $coAcc
 * @property string|null $coInn
 * @property string|null $coName
 * @property string|null $payPurpose
 * @property string|null $sumPay
 * @property string|null $state
 * @property string|null $operationId
 * @property int $type
 * @property int $enabled
 */
class BankInvoicesLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank_invoices_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docId', 'docNumb', 'currDay', 'codeFilial', 'clMfo', 'clAcc', 'clInn', 'clName', 'coMfo', 'coAcc', 'coInn', 'coName', 'payPurpose', 'sumPay', 'state', 'operationId'], 'string', 'max' => 255],
            [['type','enabled'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docId' => 'Doc ID',
            'docNumb' => 'Doc Numb',
            'currDay' => 'Curr Day',
            'codeFilial' => 'Code Filial',
            'clMfo' => 'Cl Mfo',
            'clAcc' => 'Cl Acc',
            'clInn' => 'Cl Inn',
            'clName' => 'Cl Name',
            'coMfo' => 'Co Mfo',
            'coAcc' => 'Co Acc',
            'coInn' => 'Co Inn',
            'coName' => 'Co Name',
            'payPurpose' => 'Pay Purpose',
            'sumPay' => 'Sum Pay',
            'state' => 'State',
            'operationId' => 'Operation ID',
        ];
    }
}

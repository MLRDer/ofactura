<?php


namespace cabinet\controllers;


use cabinet\classes\repositories\PaymeTransactionOrdersRepository;
use cabinet\models\Components;
use common\models\Company;
use common\models\Invoices;
use common\models\InvoicesLog;
use common\models\Olympiad;
use common\models\OlympiadEnroll;
use common\models\PaymeTransactionOrders;
use common\models\PaymeTransactions;
use common\models\Transactions;
use Exception;
//use frontend\components\Controller;
use Yii;
use yii\helpers\Json;
use yii\web\Response;

class PaymeController extends \yii\web\Controller
{
    const USERNAME = 'Paycom';
    const PASSWORD = 'MBuH?hXca&WoefpjjU@QYNGrnQUI9Y0QbRHV';
    const PASSWORD_TEST = 'sDyxwD34y03JvCDc2iPM#OT?&U9HRIcfeuVe';
    const METHOD_CHECK_PERFORM_TRANSACTION = 'CheckPerformTransaction';
    const METHOD_CREATE_TRANSACTION = 'CreateTransaction';
    const METHOD_CHECK_TRANSACTION = 'CheckTransaction';
    const METHOD_PERFORM_TRANSACTION = 'PerformTransaction';
    const METHOD_CANCEL_TRANSACTION = 'CancelTransaction';
    const METHOD = 'method';
    public $enableCsrfValidation = false;

    const CODE_UNAUTHORIZE = -32504;
    const CODE_OLYMPIAD_NOT_FOUND = -31050;
    const CODE_TRANSACTION_NOT_FOUND = -31003;
    const CODE_WRONG_AMOUNT = -31001;
    const CODE_DISABLED_CANCEL = -31007;
    const CODE_STATE_NOT_1 = -31008;
    const CODE_ALREADY_PAID = -31051;
    const CODE_WAITING_PAYMENT = -31052;
    const CODE_SERVER_ERROR = -31099;

    public function actionIndex(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(!$this->checkAuth())
            return $this->error(self::CODE_UNAUTHORIZE,'unauthorized');
        $methods = self::getAllMethods();
        Yii::$app->params['request'] =
        $request = json_decode(Yii::$app->request->getRawBody(),true);
        if(is_array($request) && array_key_exists(self::METHOD,$request) && in_array($request[self::METHOD],$methods)) {
            $key = array_search($request[self::METHOD],$methods);
            $method = $methods[$key];
            return $this->$method();
        } else {
            Yii::$app->response->statusCode = 404;
            return [];
        }
    }

    public function checkAuth() {
        $headers = Yii::$app->request->headers;
        if(isset($headers['authorization'])) {
            $str = base64_decode(str_replace('Basic ','',$headers['authorization']));
            $array = explode(':',$str);
            if(is_array($array) && count($array) == 2)
                return $array[0] == self::USERNAME && $array[1] == self::PASSWORD;
        }
        return  false;
    }

    public static function getAllMethods() {
        return [self::METHOD_CHECK_PERFORM_TRANSACTION,self::METHOD_CREATE_TRANSACTION,self::METHOD_CHECK_TRANSACTION,self::METHOD_PERFORM_TRANSACTION,self::METHOD_CANCEL_TRANSACTION];
    }

    public function CheckPerformTransaction() {
        try {
            $request = json_decode(Yii::$app->request->getRawBody(),true);
//            $model = OlympiadEnroll::findOne((int)$request['params']['account']['enroll_id']);
            $model = Company::findOne(['tin'=>$request['params']['account']['tin']]);
            if(empty($model))
                return $this->error(self::CODE_OLYMPIAD_NOT_FOUND,[
                    'uz' => 'So\'rov topilmadi',
                    'ru' => 'Запрос не найден',
                    'en' => 'Request not found',
                ]);
//            $tr = PaymeTransactions::findOne(['tin'=>$request['params']['account']['tin']]);
//            if(!empty($tr) && $tr->transaction_amount!=$request['params']['amount'])
//                return $this->error(self::CODE_WRONG_AMOUNT,[
//                    'uz' => 'Notogri summa',
//                    'ru' => 'Notogri summa',
//                    'en' => 'Notogri summa',
//                ]);

//            if($model->amount != $request['params']['amount'])
//                return $this->error(self::CODE_WRONG_AMOUNT,[
//                    'uz' => 'To\'lov summasi '.$model->olympiad->price.' so\'m bo\'lishi kerak',
//                    'ru' => 'Сумма платежа должна составлять '.$model->olympiad->price.' сум',
//                    'en' => 'The payment amount should be '.$model->olympiad->price.' sums'
//                ]);

        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }
        return $this->success(['allow' => true]);
    }

    public function CreateTransaction() {
        try {
            $request = json_decode(Yii::$app->request->getRawBody(),true);

            $model = Company::findOne(['tin'=>$request['params']['account']['tin']]);
            if(empty($model))
                return $this->error(self::CODE_OLYMPIAD_NOT_FOUND,[
                    'uz' => 'So\'rov topilmadi',
                    'ru' => 'Запрос не найден',
                    'en' => 'Request not found',
                ]);

            $transaction = PaymeTransactions::findOne(['transaction_id' => $request['params']['id']]);
            if(!empty($transaction) && $transaction->state != Transactions::STATE_NEW)
                return $this->error(self::CODE_STATE_NOT_1,[
                    'uz' => 'Tranzaksiya to\'lovni kutyapti',
                    'ru' => 'В ожидании оплаты',
                    'en' => 'Pending payment',
                ]);
//            $tr = PaymeTransactions::findOne(['tin'=>$request['params']['account']['tin'],'state'=>1]);
//            if(!empty($tr) && $tr->transaction_id!=$request['params']['id']){
//                return $this->error(self::CODE_SERVER_ERROR,[
//                    'uz' => 'Tranzaksiya to\'lovni kutyapti',
//                    'ru' => 'В ожидании оплаты',
//                    'en' => 'Pending payment',
//                ]);
//            }



        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }

        if(empty($transaction)) {
            $transaction = new PaymeTransactions();
            $transaction->transaction_id = $request['params']['id'];
            $transaction->order_id = 1;
            $transaction->transaction_account = Json::encode($request['params']['account']);
            $transaction->tin = $request['params']['account']['tin'];
            $transaction->transaction_create_time = $request['params']['time'];
            $transaction->create_time = (int)($transaction->create_time == null ? round(microtime(true) * 1000) : $transaction->create_time);
        }
        $transaction->transaction_amount = (int)$request['params']['amount'];
        $transaction->state = Transactions::STATE_NEW;
        $transaction->save();
        return $this->success([
            'create_time' => (int)$transaction->create_time,
            'transaction' => (string)$transaction->id,
            'state' => $transaction->state,
        ]);
    }

    public function CheckTransaction() {
        try {
            $request = json_decode(Yii::$app->request->getRawBody(),true);
            $model = PaymeTransactions::findOne(['transaction_id' => $request['params']['id']]);
            if(empty($model))
                return $this->error(self::CODE_TRANSACTION_NOT_FOUND,[
                    'uz' => 'Tranzaksiya topilmadi',
                    'ru' => 'Транзакция не найден',
                    'en' => 'Transaction not found',
                ]);

        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }

//        $model->state= -1 ?$model->reason = 3:0;
        $model->reason = $model->state==-1?3:$model->reason;
        return $this->success([
            'create_time' => (int)$model->create_time,
            'perform_time' => $model->perform_time== null ? 0 : (int)$model->perform_time ,
            'cancel_time' => $model->cancel_time == null ? 0 : (int)$model->cancel_time,
            'transaction' => (string)$model->id,
            'state' => $model->state,
            'reason' => $model->reason==null?null:(int)$model->reason
        ]);
    }

    public function PerformTransaction() {
        try {
            $request = json_decode(Yii::$app->request->getRawBody(),true);
            $model = PaymeTransactions::findOne(['transaction_id' => $request['params']['id']]);
            if(empty($model))
                return $this->error(self::CODE_TRANSACTION_NOT_FOUND,[
                    'uz' => 'Tranzaksiya topilmadi',
                    'ru' => 'Транзакция не найден',
                    'en' => 'Transaction not found',
                ]);

            if($model->state != Transactions::STATE_NEW && $model->state != Transactions::STATE_PAID)
                return $this->error(self::CODE_STATE_NOT_1,[
                    'uz' => 'To\'lovni amalga oshirish iloji y\'q',
                    'ru' => 'Невозможно выполнить данную операцию',
                    'en' => 'Cannot perform this operation'
                ]);

            $model->perform_time = (int)($model->perform_time == null ? round(microtime(true) * 1000) : $model->perform_time);
            $model->state = Transactions::STATE_PAID;
            if($model->save()){
                $resn_msg ="";
                $invoices = new Invoices();
                $invoices->company_id = Components::GetIdByTin($model->tin);
                $invoices->type_invoices = Invoices::PAY;
                $invoices->type_pay = Invoices::PAY_PAYME;
                $invoices->reason = "Payme tizimidan tranzaksiya ID si ".$model->id." bo'lgan to'lov qabul qilindi";
                $invoices->value = $model->transaction_amount/100;
                $invoices->created_date = date('Y-m-d H:i:s');
                $invoices->enabled = 1;
                if(!$invoices->save()){
                    $resn_msg = Json::encode($invoices->getErrors());
                }
                $logInvoices = new InvoicesLog();
                $logInvoices->reason = $resn_msg;
                $logInvoices->created_date = date('Y-m-d H:i:s');
                $logInvoices->enabled = 1;
                $logInvoices->status = Invoices::PAY;
                if($resn_msg==""){
                    $logInvoices->succes_type = 1;
                } else {
                    $logInvoices->succes_type = 0;
                }
                $logInvoices->save();
            }

        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }

        return $this->success([
            'transaction' => (string)$model->id,
            'perform_time' => (int)$model->perform_time,
            'state' => $model->state,
        ]);
    }

    public function CancelTransaction() {
        try {
            $request = json_decode(Yii::$app->request->getRawBody(),true);
            $model = PaymeTransactions::findOne(['transaction_id' => $request['params']['id']]);
            if(empty($model))
                return $this->error(self::CODE_TRANSACTION_NOT_FOUND,[
                    'uz' => 'Tranzaksiya topilmadi',
                    'ru' => 'Транзакция не найден',
                    'en' => 'Transaction not found',
                ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

        if($model->state!==Transactions::STATE_CANCELLED_2) {
            if ($model->state == Transactions::STATE_PAID) {
                $model->state = Transactions::STATE_CANCELLED_2;
            } else {
                $model->state = Transactions::STATE_CANCELLED;
            }
        }


        $model->cancel_time = (int)($model->cancel_time == null ? round(microtime(true) * 1000) : $model->cancel_time);
        $model->reason = "5";
//        $model->perform_time = 0;
        $model->save();
        return $this->success([
            'transaction' => (string)$model->id,
            'cancel_time' => (int)$model->cancel_time,
            'state' => (int)$model->state
        ]);
    }

    private function success($result) {
        return [
            'result' => $result
        ];
    }

    private function error($code,$message ='') {
        return [
            'error' => [
                'code' => $code,
                'message' => $message
            ],
        ];
    }

    private function serverError($m) {
        return $this->error(self::CODE_SERVER_ERROR,[
            'uz' => 'Server xatoligi',
            'ru' => 'Ошибка сервера',
            'en' => 'Server error',
            'm' => $m
        ]);
    }
}
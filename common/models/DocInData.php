<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_in_data".
 *
 * @property int $id
 * @property string|null $doc_data
 * @property string|null $reason
 * @property string|null $created_date
 * @property int|null $type
 * @property int|null $enabled
 */
class DocInData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const IN_DOC = 1;
    const SEND_DOC = 2;
//    const ACCEPT_DOC = 3;
//    const REJECT_DOC = 4;
//    const CANSEL_DOC = 5;

    public static function tableName()
    {
        return 'doc_in_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_data'], 'string'],
            [['created_date','reason'], 'safe'],
            [['enabled','type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_data' => 'Doc Data',
            'created_date' => 'Created Date',
            'enabled' => 'Enabled',
        ];
    }
}

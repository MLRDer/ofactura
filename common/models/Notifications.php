<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int $company_id
 * @property string $title
 * @property string|null $anons
 * @property int $type
 * @property int $status
 * @property string $created_date
 * @property int|null $is_view
 * @property string $path
 * @property string|null $view_date
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'title', 'type', 'status', 'created_date', 'path'], 'required'],
            [['company_id', 'type', 'status', 'is_view'], 'integer'],
            [['created_date', 'view_date'], 'safe'],
            [['title', 'path'], 'string', 'max' => 255],
            [['anons'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'title' => 'Title',
            'anons' => 'Anons',
            'type' => 'Type',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'is_view' => 'Is View',
            'path' => 'Path',
            'view_date' => 'View Date',
        ];
    }
}

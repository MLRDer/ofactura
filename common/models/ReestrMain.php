<?php

namespace common\models;

use Yii;
use cabinet\classes\consts\ExcelConst as Consts;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "reestr_main".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $reest_no
 * @property string|null $reestr_date
 * @property string|null $created_date
 * @property int|null $created_user
 * @property string|null $json_data
 */
class ReestrMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;
    public static function tableName()
    {
        return 'reestr_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['json_data','reest_no'], 'required'],
            [['company_id', 'created_user'], 'integer'],
            ['file', 'file', 'extensions' => 'xlsx'],
            [['reestr_date', 'created_date'], 'safe'],
            [['reest_no'], 'string', 'max' => 50],
            [['json_data'], 'string'],
        ];
    }


    public function upload()
    {
//        if (!$this->validate())
//            return $this->errors;

        if(!is_dir(Yii::getAlias(Consts::FILE_PATH)))
            FileHelper::createDirectory(Yii::getAlias(Consts::FILE_PATH));

        if(is_file(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME)))
            unlink(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        $file = UploadedFile::getInstance($this, 'file');
        $file->saveAs(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'reest_no' => Yii::t('main','Reest No'),
            'reestr_date' => Yii::t('main','Reestr Date'),
            'created_date' => 'Created Date',
            'created_user' => 'Created User',
        ];
    }
}

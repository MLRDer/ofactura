<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 03.12.2019
 * Time: 12:29
 */

namespace cabinet\models;


use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use cabinet\classes\consts\ReestrConst as Consts;

class Excel extends Model
{

    public $file;
    public $category_id;

    public function rules()
    {
        return [
            ['file', 'file', 'extensions' => 'xlsx'],
            ['category_id', 'integer'],

        ];
    }

    public function upload()
    {
        if (!$this->validate())
            return $this->errors;

        if(!is_dir(Yii::getAlias(Consts::FILE_PATH)))
            FileHelper::createDirectory(Yii::getAlias(Consts::FILE_PATH));

        if(is_file(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME)))
            unlink(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        $file = UploadedFile::getInstance($this, 'file');
        $file->saveAs(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        return true;
    }

}
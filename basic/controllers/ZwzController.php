<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2017/9/21
 * Time: 20:42
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class ZwzController extends Controller
{
    public function actionUpload()
    {


            $model = new UploadForm();

            if (Yii::$app->request->isPost) {
                $model->file = UploadedFile::getInstance($model, 'file');

                if ($model->file && $model->validate()) {

                    $model->file->saveAs('/uploads/' . $model->file->baseName . '.' . $model->file->extension);
                }
            }


        return $this->render('upload', ['model' => $model]);
    }
}
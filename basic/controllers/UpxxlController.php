<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Xinup;
use yii\web\UploadedFile;

class UpxxlController extends Controller
{
    public function actionUpload()
    {
        if($_POST){
            var_dump($_FILES);
            exit();
        }
        $model = new Xinup();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('xxl', ['model' => $model]);
    }
}
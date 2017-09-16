<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2017/9/9
 * Time: 15:30
 */
//header("Content-type:text/html;charset=utf-8");
namespace app\controllers;
use yii\web\Controller;
use app\models\Test;
class UseController extends  Controller
{
    public function actionIndex()
    {
        //echo 'index/index';
       //return $this->render('index');
        $model =new Test();
        //$data=$model->tableName();
        $data=$model->find()->one();
        return $this->render("index",array("row"=>$data));

    }
}

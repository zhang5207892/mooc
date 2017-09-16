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
class OrderController extends  Controller
{
    //不加载yii2布局
    public $layout='layout1';
    public function actionCheck(){
        return $this->render("check");
    }
    public function actionIndex(){
        return $this->render("index");
    }
}

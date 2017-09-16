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
class ProductController extends  Controller
{
    public $layout='layout1';
    public function actionIndex(){
        //不加载yii2布局

        return $this->render("index");

    }
}

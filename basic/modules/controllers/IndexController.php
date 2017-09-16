<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2017/9/9
 * Time: 15:30
 */
//header("Content-type:text/html;charset=utf-8");
namespace app\modules\controllers;
use yii\web\Controller;
use app\models\Test;
class PublicController extends  Controller
{
    //不加载yii2布局
    //public $layout=false;
    public $layout='layout1';
    public function actionlogin(){
        //
        $this->layout=false;
        $this->render('login');
    }
}

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
use app\modules\models\Product;
use yii;
class IndexController extends  CommonController
{
    //不加载yii2布局
    //public $layout=false;
    public $layout='layout1';
    public function actionIndex()
    {
        $this->layout = "layout1";
        $model=new Product;
      $data['tui'] = $model->find()->where('istui = "1" and ison = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['new'] = $model->find()->where('ison = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['hot'] = $model->find()->where('ison = "1" and ishot = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['all'] = $model->find()->where('ison = "1"')->orderby('createtime desc')->limit(7)->all();
       /*var_dump($model->find()->where('istui = "1" and ison = "1"')->orderby('createtime desc')->limit(4)->all());
        exit();*/
        return $this->render("index", ['data' => $data]);
    }

}

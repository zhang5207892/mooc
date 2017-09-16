<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\models\Admin;
use app\modules\models\Admin1;
use yii;
/**
 * Default controller for the `admin` module
 */
class PublicController extends Controller
{
    public $enableCsrfValidation=false;
    //public $layout=false;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin()
    {
       $this->layout='zwz';
        //$this->context->layout = 'main'; //设置使用的布局文件
        $model=new Admin();
        $model->scenario='login';
        if(Yii::$app->request->isPost){
            $post=yii::$app->request->post();
           if($model->login($post)){
               $this->redirect(['default/index']);
            Yii::$app->end();
           }
        }
        return $this->render('login',['model'=>$model]);
    }

    public function actionLogout()
    {
        yii::$app->session->removeAll();
        if(!isset(Yii::$app->session['admin']['isLogin'])){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        $this->goBack();
}

    public function actionLogin2()
    {
        Yii::$app->cache->flush();
        $this->layout='zwz';
        $model=new Admin1();
     /*   if(Yii::$app->request->isPost){
            $post=yii::$app->request->post();
            if($model->login($post)){
                $this->redirect(['default/index']);
                Yii::$app->end();
            }
        }*/
        return $this->render('login2',['model'=>$model]);
    }
//第一个字母大写后面小写，前台均小写
    public function actionSeekpassword()
    {
        $this->layout=false;
        $model=new Admin();
        if(Yii::$app->request->isPost){
            $post=yii::$app->request->post();
            if($model->seekPass($post)){
                Yii::$app->session->setFlash('info','电子邮件已经发送成功，请查收');
            }
        }
        return $this->render("seekpassword",['model'=>$model]);
    }
    public function actionZz(){
        $mail= Yii::$app->mailer->compose();
        $mail->setTo('2269025237@qq.com');
        $mail->setSubject("邮件测试");
        //$mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("<br>问我我我我我");    //发布可以带html标签的文本
        if($mail->send())
            echo "success";
        else
            echo "failse";
        die();
    }

}

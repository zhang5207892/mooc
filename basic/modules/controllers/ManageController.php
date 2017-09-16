<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\models\Admin;
use app\modules\models\Admin1;
use yii;
/**
 * Default controller for the `admin` module
 */
class ManageController extends Controller
{
    public function actionMailchangepass(){
        $this->layout=false;
        $time=yii::$app->request->get('timestamp');
        $adminuser=yii::$app->request->get("adminuser");
        $token=Yii::$app->request->get("token");
        $model= new Admin();
        $model->adminuser=$adminuser;
        $myToken=$model->createToken($adminuser,$time);
        if($myToken!=$token){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if(time()-$time>3000){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if(Yii::$app->request->isPost){

            $post=Yii::$app->request->post();
            if($model->changePass($post)){
                Yii::$app->session->setFlash('info','密码修改成功');
            }
        }
        return $this->render('mailchangepass',['model'=>$model]);

    }

    public function actionManagers()
    {
        $this->layout='layout1';
        $model=Admin::find();
        $count=$model->count();
        $pageSize=Yii::$app->params['pageSize']['manage'];
        $pager=new yii\data\Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
        $manager=$model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('managers',['managers'=>$manager,'pager'=>$pager]);
    }

    public function actionReg()
    {
       $this->layout='layout1';
        $model=new Admin();
        $model->scenario='adminadd';
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            if($model->reg($post)){
                Yii::$app->session->setFlash('info','添加成功');
            }
            else{
                Yii::$app->session->setFlash('info','添加失败');
            }
        }
        //前台添加下清除 更加美观
        $model->adminpass='';
        $model->repass='';
        return $this->render('reg',['model'=>$model]);

    }

    public function actionDel()
    {
        $adminid=(int)yii::$app->request->get('adminid');
        if(empty($adminid)){
            $this->redirect(['manage/managers']);
        }
        $model=new Admin();
        if($model->deleteAll('adminid = :id',[':id'=>$adminid])){
            Yii::$app->session->setFlash('info','删除成功');
            $this->redirect(['manage/managers']);
        }


    }

    public function actionChangeemail()
    {
        $this->layout='layout1';
        $model=Admin::find()->where('adminuser = :user',[':user'=>Yii::$app->session['admin']['adminuser']])->one();
        $model->scenario='changeemail';
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            if($model->changeemail($post)){
                Yii::$app->session->setFlash('info','修改成功');

            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }
        }
        $model->adminpass='';
        return $this->render('changeemail',['model'=>$model]);

}

    public function actionChangepass()
    {
        $this->layout='layout1';
        $model =Admin::find()->where('adminuser = :user',[':user'=>Yii::$app->session['admin']['adminuser']])->one();
        $model->scenario='changepass';
        $model->adminpass='';
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            if($model->changepass($post)){
                Yii::$app->session->setFlash('info','修改成功');

            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }
        }
        return $this->render('changepass',['model'=>$model]);
    }


}

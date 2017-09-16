<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2017/9/10
 * Time: 21:22
 */
//header("Content-type:text/html;charset=utf-8");

namespace app\modules\models;
use yii\db\ActiveRecord;
use  Yii;
class  Admin extends ActiveRecord
{
    public $rememberMe=true;
    public $repass;
    public static function tableName()
    {
        return "{{%admin}}";
    }

    public function rules()
    {
        return [
        ['adminuser','required','message'=>'管理员账号不能为空','on'=>['login','seekPass','changepass','adminadd','changeemail']],
        ['adminpass','required','message'=>'管理员密码不能为空','on'=>['login','changepass','adminadd','changeemail']],
        ['rememberMe','boolean','on'=>'login'],
        ['adminemail','required','message'=>'电子邮箱不能为空','on'=>['seekPass','adminadd','changeemail']],
        ['adminemail','email','message'=>'必须为电子邮箱格式','on'=>['seekPass','adminadd','changeemail']],
        //['adminemail','email','message'=>'电子邮箱已经注册','on'=>'adminadd'],
        ['adminemail','unique','message'=>'电子邮箱已经注册','on'=>['adminadd','changeemail']],
        ['adminuser','unique','message'=>'管理人员已经注册','on'=>'adminadd'],
        ['adminemail','validateEmail','on'=>'seekPass'],
        ['adminpass','validatePass','on'=>['login','changeemail']],
        ['repass','compare','compareAttribute'=>'adminpass','message'=>'密码需要一致','on'=>['changepass','adminadd']],
        ['repass','required','message'=>'确认密码不能为空','on'=>['changepass','adminadd']],
    ];
    }

    public function attributeLabels()
    {
        return  [
          'adminuser'=>'管理员账号',
            'adminemail'=>'管理员邮箱',
            'adminpass'=>'管理员密码',
            'repass'=>'确认密码',
        ];
    }
    public function validatePass()
    {
        if(!$this->hasErrors()){
            $data=self::find()->where(' adminuser = :user and adminpass = :pass',[':user'=>$this->adminuser,':pass'=>md5($this->adminpass)])->one();
            if(is_null($data)){
                $this->addError('adminpass','用户名或密码错误');
            }else{
                return true;
            }

        }
    }

    public function validateEmail()
    {
        if(!$this->hasErrors()){
            $data=self::find()->where('adminuser = :user and adminemail =:email',[':user'=>$this->adminuser,':email'=>$this->adminemail])->one();
            if(is_null($data)){
                $this->addError('adminemail','管理员账号不匹配邮箱');
            }
            else{
                return true;
            }
        }
    }

    public function login($date){
        if($this->load($date) && $this->validatePass()){
            //通过验证
            $lifetime=$this->rememberMe?24*3600:0;
            $session=Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin']=[
              'adminuser'=>$this->adminuser,
               'isLogin'=>1,
            ];
            $this->updateAll(['logintime'=>time(),'loginip'=>ip2long(Yii::$app->request->userIP)],'adminuser= :user',[':user'=>$this->adminuser]);
            return (bool)$session['admin']['isLogin'];
        }
            return false;
    }

    public function seekPass($date)
    {
        $this->scenario='seekPass';
        if($this->load($date) && $this->validateEmail()){
            $time=time();
            $token=$this->createToken($date['Admin']['adminuser'],$time);
            //通过验证
            $mailer=Yii::$app->mailer->compose('seekpass',['adminuser'=>$date['Admin']['adminuser'],'time'=>$time,'token'=>$token]);
            $mailer->setFrom('zhang5207892@163.com');
            $mailer->setTo($date['Admin']['adminemail']);
            $mailer->setSubject('文宗商城-找回密码');
            if($mailer->send()){
                return true;
            }

        }else{
            return false;
        }
    }

    public function createToken($adminuser,$time)
    {
        return md5(md5($adminuser).base64_decode(Yii::$app->request->userIP).md5($time));
    }
    public function changePass($data)
    {
        $this->scenario='changepass';

        if($this->load($data) && $this->validate()){
            return(bool)$this->updateAll(['adminpass' => md5($this->adminpass)], 'adminuser = :user',[':user'=>$this->adminuser]);
        }
        return false;

    }
    public function reg($data)
    {
        if($this->load($data) && $this->validate()){
            $this->adminpass=md5($data['Admin']['adminpass']);
            //参数false代表的是不进行验证
            if($this->save(false)){
                return true;
            }
            return false;
        }
        else{
            return false;
        }
    }

    public function changeemail($data)
    {
        if($this->load($data) && $this->validate()){
            return (bool)$this->updateAll(['adminemail'=>$this->adminemail],'adminuser = :user',[':user'=>$this->adminuser]);
        }else{
            return false;
        }
    }
}
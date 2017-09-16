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
class  Admin1 extends ActiveRecord
{
    public $rememberMe=true;
    public static function tableName()
    {
        return "{{%admin}}";
    }
    public function rules()
    {
        return [
            ['adminuser','required','message'=>'管理员账号不能为空'],
            ['adminpass','required','message'=>'管理员密码不能为空'],
            ['rememberMe','boolean'],
            //['adminpass','validatePass'],
        ];
    }
}
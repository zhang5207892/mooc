<?php
/**
 * Created by PhpStorm.
 * User: zhangwenzong
 * Date: 2017/9/9
 * Time: 16:09
 */
//header("Content-type:text/html;charset=utf-8");
namespace app\models;
use yii\db\ActiveRecord;
class Test extends ActiveRecord
{
    public static function tableName(){
        //表名
        return "{{%test}}";
    }
}


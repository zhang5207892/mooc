<?php
//创建Form组件
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html class="login-bg">

<head>
    <title>慕课商城 - 后台管理</title>
<body>
<?php $form=ActiveForm::begin
([
    'fieldConfig'=>[
        'template'=>'{error}{input}',
    ]
] ) ;?>

                <?php echo $form->field($model,'adminuser')->textInput();?>
                <?php echo $form->field($model,'adminpass')->passwordInput();?>
                <?php echo $form->field($model,'rememberMe')->checkbox([]);?>
                <?php echo Html::submitButton('登录');?>

    <?php ActiveForm::end();?>

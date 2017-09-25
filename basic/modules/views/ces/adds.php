<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .span8 div{
        display:inline;
    }
    .help-block-error {
        color:red;
        display:inline;
    }
</style>
<link rel="stylesheet" href="/assets/admin/css/compiled/new-user.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">
    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加商品</h3>
            </div>
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php
                        if (Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                        $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
                            ],
                            'options' => [
                                'class' => 'new_user_form inline-input',
                                'enctype' => 'multipart/form-data'
                            ],
                        ]);

                        echo $form->field($model, 'aa')->fileInput();
                            ?>

                        <hr>
                        <input type='button' id="addpic" value='增加一个'>
                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('提交', ['class' => 'btn-glow primary']); ?>
                            <span>OR</span>
                            <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                        </div>
                        <input type="file" id="zwz">;
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">
                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧表单当中填入要添加的商品信息,包括商品名称,描述,图片等
                    </div>
                    <h6>商城用户说明</h6>
                    <p>可以在前台进行购物</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main container -->

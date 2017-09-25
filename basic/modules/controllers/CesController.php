<?php
namespace app\modules\controllers;

use app\modules\models\Productce;
use Yii;
use yii\data\Pagination;
use yii\rest\Controller;
class CesController extends Controller{

    public $enableCsrfValidation = false;
    public function actionAdds()
    {
        if($_POST){
            var_dump($_FILES);
          exit();
        }
        $this->layout = "lay33";
        $model=new Productce();
        return $this->render("adds", [ 'model' => $model]);
    }
}

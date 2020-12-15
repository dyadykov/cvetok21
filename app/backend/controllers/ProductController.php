<?php


namespace backend\controllers;


use frontend\models\Product;
use Yii;
use yii\data\ActiveDataProvider;

class ProductController extends CommonController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => self::PAGE_SIZE,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->getQueryParam('id');
        $model = Product::findOne($id) ?: new Product();

        if ($model->load(Yii::$app->request->getBodyParams())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', self::MODEL_SAVED);
            } else {
                Yii::$app->session->setFlash('error', self::MODEL_NOT_SAVED);
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->getQueryParam('id');
        $model = Product::findOne($id);
        $model->delete();
        $this->redirect('/product');
    }
}
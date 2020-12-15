<?php


namespace backend\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

abstract class CommonController extends Controller
{
    const PAGE_SIZE = 20;
    const MODEL_SAVED = 'СОХРАНИЛОСЬ';
    const MODEL_NOT_SAVED = 'НЕ СОХРАНИЛОСЬ';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->modelClass::find(),
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
        $model = $this->modelClass::findOne($id) ?: new $this->modelClass();

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
        $model = $this->modelClass::findOne($id);
        $model->delete();
        $this->redirect($this->modelUrl);
    }
}
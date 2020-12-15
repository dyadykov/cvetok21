<?php


namespace backend\controllers;

use frontend\models\Slide;
use Yii;
use yii\data\ActiveDataProvider;

class SlideController extends CommonController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slide::find()->orderBy('pos'),
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
        $model = Slide::findOne($id) ?: new Slide();

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
        $model = Slide::findOne($id);
        $model->delete();
        $this->redirect('/slide');
    }
}
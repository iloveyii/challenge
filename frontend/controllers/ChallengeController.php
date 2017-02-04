<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\SubCategory;
use Yii;
use frontend\models\Challenge;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ChallengeController implements the CRUD actions for Challenge model.
 */
class ChallengeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Challenge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Challenge::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPlaynow()
    {
        /*
        $q = new Query();
        $q->join('INNER JOIN', 'subcategory');

        $query = (new Query())
            ->from('challenge')
            ->innerJoin('sub_category', 'sub_category_id = `sub_category`.id')
            ->innerJoin('category', 'category_id = category.id')
            ->limit(5);

        $command = $query->createCommand();
        $data = $command->queryAll();
        // print_r($data); exit;

        // $data = Challenge::find()->joinWith('subcategory', true, 'INNER JOIN')->all();
        // var_dump($data);
        $sql = '
            SELECT 
                category.id, category.name
            FROM
                challenge
                    INNER JOIN
                sub_category ON sub_category_id = sub_category.id
                    INNER JOIN
                category ON sub_category.category_id = category.id
        ';
*/



        $categories = Category::find()->all();

        foreach ($categories as $category) {
            echo 'Category : ' . $category->name;

            $query = (new Query())
                ->select(['sub_category.id AS sub_category_id', 'sub_category.name AS sub_category_name', 'challenge.title AS challenge_title', 'date_stop'])
                ->from('challenge')
                ->innerJoin('sub_category', 'sub_category_id = `sub_category`.id')
                ->innerJoin('category', 'category_id = category.id')
                ->where(['category.id'=>$category->id])
                ->limit(25);

            $dataProviders[$category->name] = new ActiveDataProvider([
                'query' => $query // $query->where(['category.id'=>$category->id]),
            ]);

            /*
            foreach($dataProviders[$category->name]->models as $model) {
               print_r($model);
            } */
        }

        return $this->render('playnow', [
            'dataProviders' => $dataProviders,
        ]);
    }

    /**
     * Displays a single Challenge model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Challenge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Challenge();
        $categories = Category::find()->select(['id', 'name'])->all();

        foreach($categories as $category) {
            $subcategory = SubCategory::find()->where(['category_id' => $category->id])->all();

            if(! empty($subcategory)) {
                $list[$category->name] = ArrayHelper::map($subcategory, 'id', 'name');
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'subcategories' => $list
        ]);
    }

    /**
     * Updates an existing Challenge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $subcategories = ArrayHelper::map(SubCategory::find()->select(['id', 'name'])->all(), 'id', 'name');;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'subcategories' => $subcategories
            ]);
        }
    }

    /**
     * Deletes an existing Challenge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Challenge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Challenge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Challenge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

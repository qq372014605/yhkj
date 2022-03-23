<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Supplier;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'export'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->get();
        $supplierModel = new Supplier();
        $dataProvider = $supplierModel->search($params);
        return $this->render('index',[
            'id'            =>  isset($params['id']) ? $params['id'] : '',
            'name'          =>  isset($params['name']) ? $params['name'] : '',
            'code'          =>  isset($params['code']) ? $params['code'] : '',
            't_status'      =>  isset($params['t_status']) ? $params['t_status'] : '',
            'dataProvider'  =>  $dataProvider
        ]);
    }

    /**
     * 导出选择的数据
     */
    public function actionExport()
    {
        if(yii::$app->request->isPost){
            $ids = Yii::$app->request->post('ids');
            $ids = explode(',',$ids);
            $fields = Yii::$app->request->post('fields');
            array_unshift($fields,'id');//id必选

            $data = Supplier::find()->where(['id'=>$ids])->select($fields)->asArray()->all();

            //添加表格标题
            $title = [
                'id'        =>  'ID',
                'name'      =>  '名称',
                'code'      =>  '代码',
                't_status'  =>  '状态'
            ];
            $tmp = [];
            foreach ($fields as $field){
                $tmp[$field] = $title[$field];
            }
            array_unshift($data,$tmp);
            Supplier::exportCsv($data);
        }else{
            $ids = Yii::$app->request->get('ids');
            return $this->render('export',[
                'ids'   =>  $ids
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

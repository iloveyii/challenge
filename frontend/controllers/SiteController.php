<?php
namespace frontend\controllers;

use app\models\Movie;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\modules\forum\Module;
use frontend\models\Tpb;
use IMDB;
use Madcoda\Youtube\Youtube;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ]
        ];
    }

    public function actionFame()
    {
        echo 'Coming soon';
        
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $m = Module::getInstance();

        $body = 'Accessed By IP: '.$_SERVER['REMOTE_ADDR'] . ' at ' . date('Y-m-d H:i:s');

        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('ali@flygresor.se')
            ->setSubject('UOI - Index accessed')
            ->setTextBody($body)
            ->setHtmlBody('<b>'.$body.'</b>'.
                Html::a('Go to home page', Url::home('http'))
            );
           // ->send();

        return $this->render('index');
    }

    public function actionServices()
    {
        $this->layout = 'main-column1';
        return $this->render('services');
    }

    public function actionCourses()
    {
        $this->layout = 'main-column1';
        $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/softhem/yii2-greenish/web');
        return $this->render('courses', ['directoryAsset'=>$directoryAsset]);
    }

    public function actionContact()
    {
        $this->layout = 'main-column1';
        $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/softhem/yii2-greenish/web');

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
              'model' => $model,
              'contact', ['directoryAsset'=>$directoryAsset]
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        // $this->layout = 'main-column1';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact2()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     *
     * @param yii\authclient\ClientInterface $client
     * @return boolean|yii\web\Response
     */
    public function oAuthSuccess($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();

        if (isset($userAttributes['email'])) {
            $email = $userAttributes['email'];
        }

        if (isset($userAttributes['emails'])) {
            $email = $userAttributes['emails'][0]['value'];
        }

        $model = new LoginForm();
        $user = User::findByEmail($email);

        if (isset($user)) {
            $model->setUser($user);
            $model->username = $user->username;
            if($model->login(false)) {
                return;
            }
        }

        $session = new Session;
        $session->open();
        $session['email']=$email;

        return;
    }

    public function actionSearch($q)
    {
        $data[] = $this->imdbData($q);

        return $this->render('search', [
            'movies' => $data,
        ]);
    }

    public function actionMovie($id)
    {
        $movie = Movie::findOne($id);

        if($movie !== null) {
            if (empty($movie->youtube_id)) {
                $movie->youtube_id = $this->findYoutubeId($movie->title);
                $movie->save();
            }

            if(empty($movie->magnet_link)) {
                $movie->magnet_link = $this->findMagnetLink($movie->title);
                $movie->save();
            }

            return $this->render('movie', [
                'movie' => $movie
            ]);
        }
    }

    private function findYoutubeId($title)
    {
        $youtube = new Youtube(array('key' => 'AIzaSyDMOpb7NF16HTqwfDmuvidmVPGUkrLmKN8'));
        $video = $youtube->search($title . ' trailer official' );

        if(is_array($video)) {
            foreach($video as $v) {
                $videoId = $v->id->videoId;
                if(! empty($videoId)) {
                    return $videoId;
                }
            }
        }

        return false;
    }

    public function actionMovies()
    {
        $movies = Movie::find()->all();
        $this->downloadImage($movies);

        return $this->render('search', [
            'movies' => $movies,
        ]);
    }

    private function downloadImage($movies)
    {
        $alias = Yii::getAlias('@webroot');

        foreach ($movies as $movie) {
            if(strlen($movie->poster) > 80) {
                $image = file_get_contents($movie->poster);
                $relPath = sprintf("/%s/%s-%d.%s", 'images', str_replace('--', '-', strtolower(preg_replace('/[^a-z\d-]/i', '-', $movie->title))), $movie->id, 'jpg');
                $path = sprintf("%s%s", $alias, $relPath);

                if($image) {
                    (! file_put_contents($path, $image)) || $movie->poster = $relPath;
                    $movie->save();
                }
            }
        }
    }

    protected function findMagnetLink($title)
    {
        $tpbObj = new Tpb();
        $searchResults = $tpbObj->searchByTitle($title);

        return isset($searchResults->Magnet) ? $searchResults->Magnet : 'NA';
    }

    public function actionDownload($movie)
    {

    }

    private function imdbData($title)
    {
        $movie = Movie::findOne(['title'=>trim($title)]);

        if($movie !== null)
        {
           return $movie;
        }

        $oIMDB = new IMDB($title);

        if ($oIMDB->isReady) {

            $data = $oIMDB->getAll();
            $title = $data['Title']['value'];
            $poster = $data['Poster']['value'];

            $movie = new Movie();
            $movie->title = $title;
            $movie->poster = $poster;
            $movie->save();

            return $movie;
        }

        return (object)[
            'id'=>'na',
            'title' => '',
            'poster' => '',
        ];

    }

}

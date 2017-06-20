<?php

namespace app\controllers;

use app\components\postManager\PostManager;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        return $this->render('index', ['posts' => $posts]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function actionPost()
    {
        if (!$id = Yii::$app->request->get('id')) {
            throw new \Exception('id не передан');
        }
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        return $this->render('post', ['post' =>$posts[$id]]);
    }

    public function actionReload()
    {
        Yii::$app->cache->flush();
        return $this->actionIndex();
    }

    public function actionError()
    {
        Yii::$app->layout = false;
        $exep = Yii::$app->errorHandler->exception;
        return $this->render('404',['exception' => $exep]);
    }
}

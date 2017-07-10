<?php

namespace app\controllers;

use app\components\postManager\PostManager;
use app\models\Post;
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
        $this->view->title = 'Чевостик';
        Yii::$app->params['og_meta'] = [
            'title' => 'Чевостик блог',
            'description' => 'Блог Чевостика, образовательный портал для детей',
            'img' => null
        ];
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
        Yii::$app->params['post'] = $posts[$id];
        /** @var Post $posts */
        $this->view->title = $posts[$id]->getTitle();
        Yii::$app->params['og_meta'] = [
            'title' => $posts[$id]->getTitle(),
            'description' => $posts[$id]->getExcerpt(),
            'img' => $_SERVER['HTTP_HOST'].'/image/post'.$posts[$id]->getId().'/main.png'
        ];
        return $this->render('post', ['post' => $posts[$id]]);
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
        return $this->render('404', ['exception' => $exep]);
    }
}

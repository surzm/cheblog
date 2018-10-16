<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 17:05
 */

namespace app\components\postManager;

use app\components\api\WpApiParams;
use app\components\transport\CurlTransport;
use app\models\Post;
use Yii;

class PostManager
{
    private $posts = [];
    private $params;
    private $handler = true;

    public function getPosts()
    {
        if (!Yii::$app->cache->get('posts')) {
            $this->params = new WpApiParams();
            $this->load();
            Yii::$app->cache->set('posts', $this->posts, 30*60);
        }
        return Yii::$app->cache->get('posts');
    }

    private function load()
    {
        if ($this->handler) {
            $this->loadPosts();
        }
    }


    private function loadPosts()
    {
        $transport = new CurlTransport($this->params);
        $json = json_decode($transport->getResponse());
        foreach ($json->posts as $post) {
            $this->posts[$post->ID] = new Post($post);
        }

        if (isset($json->meta->next_page)) {
            $this->params->setPageHandle(urlencode($json->meta->next_page));
            $this->handler = true;
        } else {
            $this->handler = false;
        }
        $this->load();
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 19:10
 */

namespace app\models;

use app\components\service\ImageService;

class Post
{

    private $id;
    private $title;
    private $content;
    private $date;
    private $modified;
    private $excerpt;

    private $attachments = [];

    private $user_id;
    private $user_name;
    private $user_nice_name;
    private $user_avatar;
    private $img;


    /**
     * Post constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->id = $params->ID;
        $this->title = $params->title;
        $this->content = $params->content;
        $this->date = $params->date;
        $this->modified = $params->modified;
        $this->excerpt = $params->excerpt;
        if ($params->featured_image){
            ImageService::saveImage($this->id, $params->featured_image);
            $this->img = $params->featured_image;
        }

        $this->user_id = $params->author->ID;
        $this->user_name = $params->author->name;
        $this->user_login = $params->author->login;
        $this->user_avatar = $params->author->avatar_URL;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getUserNiceName()
    {
        return $this->user_nice_name;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @return mixed
     */
    public function getUserAvatar()
    {
        return $this->user_avatar;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }
}
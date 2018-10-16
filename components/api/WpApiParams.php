<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 16:30
 */

namespace app\components\api;

class WpApiParams implements ApiParamsInterface
{
    private $url = 'https://public-api.wordpress.com/rest/v1.1/sites/128883635/posts/?context=display&number=1&page_handle=';

    private $method = 'GET';
    private $headers = [];
    private $content_type = 'application/json';
    private $data = [];
    private $page_handle = '';


    public function __construct($id = null)
    {
        $this->url.=$id;
    }

    public function getUrl()
    {
        return $this->url.$this->page_handle;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHeaders()
    {
       return $this->headers;
    }

    public function getContentType()
    {
        return $this->content_type;
    }

    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $page_handle
     */
    public function setPageHandle($page_handle)
    {
        $this->page_handle = $page_handle;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 16:47
 */

namespace app\components\api;

interface ApiParamsInterface
{
    public function getUrl();
    public function getMethod();
    public function getHeaders();
    public function getContentType();
    public function getData();
}
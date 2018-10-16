<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 16:25
 */
namespace app\components\transport;

use app\components\api\ApiParamsInterface;

/**
 * Interface TransportInterface
 * @package app\components\transport
 */
interface TransportInterface
{
    public function __construct(ApiParamsInterface $params);

    public function getResponse();
}
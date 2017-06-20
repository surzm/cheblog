<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 14.06.17
 * Time: 11:35
 */

namespace app\components\service;


use app\components\imageGenerator\ImageGenerator;
use Yii;

class ImageService
{
    public static function saveImage($post_id, \stdClass $attachment)
    {
        $base_image_path = Yii::$app->basePath . '/web/image';
        if (!is_dir($base_image_path)) {
            mkdir($base_image_path, 0777);
            chmod($base_image_path, 0777);
        }

        $source = $base_image_path . '/post' . $post_id;
        $file = $source . '/' . $attachment->ID . '.png';

        if (!is_file($file)) {
            if (!is_dir($source)) {
                mkdir($source, 0777);
                chmod($source, 0777);
            }
            if (!file_put_contents($file, file_get_contents($attachment->URL))) {
                throw new \Exception('файл не сохранен');
            }
            $small = $source . '/' . $attachment->ID . 'small.png';

            $generator = new ImageGenerator($file);
            $dim = ['373','197'];
            $generator->cropAndResize($dim[0],$dim[1])->save($small);

            chmod($file, 0777);
            chmod($small, 0777);
        }
    }
}
<?php
namespace app\components\imageGenerator;

/**
 * ${FILE_NAME}
 *
 * PHP version 7
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     unklefedor
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://breadhead.ru
 */
class ImageGenerator
{
    /** @var IMagickAdapter */
    private $image = null;
    private $crop_param = [];

    private $src = '';
    private $src_width = 0;
    private $src_height = 0;
    private $src_ratio = 1;

    private $dst = '';
    private $dst_quality = 100;
    private $dst_width = 0;
    private $dst_height = 0;
    private $dst_ratio = 1;

    /**
     * ImageGenerator constructor.
     *
     * @param $src
     */
    public function __construct($src)
    {
        $this->src = $src;

        $this->init();
    }

    /**
     * init
     *
     * @return void
     */
    private function init()
    {
        $this->image = IMagickAdapter::open($this->src);
        $this->src_width = $this->image->getWidth();
        $this->src_height = $this->image->getHeight();
    }

    /**
     * smartCrop
     * Умный кроп исходника, если требуется квадрат, а дан не квадрат, то кропаем до квадрата,
     * иначе кропаем до нужного соотношения сторон, если соотношение не верное
     *
     * @return void
     */
    private function smartCrop()
    {
        if ($this->dst_width == $this->dst_height && $this->src_width != $this->src_height) {
            //Если нужен квадрат, но изображение не квадрат - кропнем
            $this->cropToSquare();
        } else {
            //Если не свопадают пропорции исходного и результата, то кропаем до нужных пропорций
            $this->cropToRatio();
        }
    }

    /**
     * cropToRatio
     * Кроп под необходимые пропорции
     *
     * @return void
     */
    private function cropToRatio()
    {
        $this->src_ratio = $this->src_width / $this->src_height;
        $this->dst_ratio = $this->dst_width / $this->dst_height;

        //Поставлен минимальный лимит расхождения пропорции на 0.1, иначе все становится хуже
        if ($this->src_ratio != $this->dst_ratio && abs($this->src_ratio - $this->dst_ratio) > 0.1) {
            if ($this->src_ratio <= 1) {
                //Если исходник вертикальный, либо квадрат
                $c = $this->src_width / $this->dst_ratio;

                $this->crop_param['xStart'] = 0;
                $this->crop_param['yStart'] = ($this->src_height - $c) / 2;
                $this->crop_param['xEnd'] = $this->src_width;
                $this->crop_param['yEnd'] = $c;
            } else {
                //Если исходник горизонтальный

                //Расчетная ширина в новом соотношении от высоты
                $t_w = $this->src_height * $this->dst_ratio;
                if ($t_w < $this->src_width) {
                    //Если исходная ширина больше, чем требуется по высоте в новом соотношении,
                    //то режем ширину
                    $this->crop_param['xStart'] = ($this->src_width - $t_w) / 2;
                    $this->crop_param['yStart'] = 0;
                    $this->crop_param['xEnd'] = $t_w;
                    $this->crop_param['yEnd'] = $this->src_height;
                } else {
                    //Если исходной ширины не хватает, для текущей высоты в новом соотношении,
                    //то режем высоту

                    //Расчет коефицента необходимой высоты в нужной пропорции от ширины
                    $k = $t_w / $this->src_width;

                    //Целевая высота
                    $t_h = $this->src_height / $k;
                    $this->crop_param['xStart'] = 0;
                    $this->crop_param['yStart'] = ($this->src_height - $t_h) / 2;
                    $this->crop_param['xEnd'] = $this->src_width;
                    $this->crop_param['yEnd'] = $t_h;
                }
            }

            $this->setCrop();
        }
    }

    /**
     * cropToSquare
     * Кроп исходника в квадрат
     *
     * @return void
     */
    private function cropToSquare()
    {
        //Если в ширину больше, чем надо
        if ($this->src_width > $this->src_height) {
            $this->crop_param['xStart'] = ($this->src_width - $this->src_height) / 2;
            $this->crop_param['yStart'] = 0;
            $this->crop_param['xEnd'] = $this->src_height;
            $this->crop_param['yEnd'] = $this->src_height;
        } else {
            //Если в высоту больше, чем надо
            $this->crop_param['xStart'] = 0;
            $this->crop_param['yStart'] = ($this->src_height - $this->src_width) / 2;
            $this->crop_param['xEnd'] = $this->src_width;
            $this->crop_param['yEnd'] = $this->src_width;
        }

        $this->setCrop();
    }


    /**
     * setQuality
     *
     * @return void
     */
    private function setQuality()
    {
        $this->image->quality($this->dst_quality);
    }

    /**
     * setCrop
     *
     * @return void
     */
    private function setCrop()
    {
        $this->image->crop(
            $this->crop_param['xStart'],
            $this->crop_param['yStart'],
            $this->crop_param['xEnd'],
            $this->crop_param['yEnd']
        );
    }

    /**
     * setResize
     *
     * @return void
     */
    private function setResize()
    {
        $this->image->resize($this->dst_width, $this->dst_height);
    }

    /**
     * setInterpolateMethod
     *
     * @param $method
     *
     * @return void
     */
    private function setInterpolate($method)
    {
        $this->image->setImageInterpolateMethod($method);
    }

    /**
     * setReduceNoise
     *
     * @param $radius
     *
     * @return void
     */
    private function setReduceNoise($radius)
    {
        $this->image->reduceNoise($radius);
    }

    /**
     * cropAndResize
     *
     * @param $dst_width
     * @param $dst_height
     *
     * @return $this
     */
    public function cropAndResize($dst_width, $dst_height)
    {
        $this->dst_width = $dst_width;
        $this->dst_height = $dst_height;

        $this->smartCrop();
        $this->setQuality();
        $this->setInterpolate(\Imagick::INTERPOLATE_BICUBIC);
        $this->setResize();

        return $this;
    }

    /**
     * reduceNoise
     *
     * @param $radius
     *
     * @return $this
     */
    public function reduceNoise($radius)
    {
        $this->setReduceNoise($radius);

        return $this;
    }

    /**
     * interpolate
     *
     * @param $method
     *
     * @return $this
     */
    public function interpolate($method)
    {
        $this->setInterpolate($method);

        return $this;
    }

    /**
     * setQuality
     *
     * @param $dst_quality
     *
     * @return $this
     */
    public function quality($dst_quality)
    {
        $this->dst_quality = $dst_quality;
        $this->setQuality();

        return $this;
    }

    /**
     * crop
     *
     * @param $dst_width
     * @param $dst_height
     *
     * @return $this
     */
    public function resize($dst_width, $dst_height)
    {
        $this->dst_height = $dst_height;
        $this->dst_width = $dst_width;
        $this->setResize();

        return $this;
    }

    /**
     * crop
     *
     * @param $xStart
     * @param $yStart
     * @param $xEnd
     * @param $yEnd
     *
     * @return $this
     */
    public function crop($xStart, $yStart, $xEnd, $yEnd)
    {
        $this->crop_param['xStart'] = $xStart;
        $this->crop_param['yStart'] = $yStart;
        $this->crop_param['xEnd'] = $xEnd;
        $this->crop_param['yEnd'] = $yEnd;
        $this->setCrop();

        return $this;
    }

    /**
     * save
     *
     * @param $dst
     *
     * @return $this
     */
    public function save($dst)
    {
        $this->image->saveTo($dst);

        return $this;
    }
}

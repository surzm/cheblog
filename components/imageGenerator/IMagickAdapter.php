<?php
namespace app\components\imageGenerator;

use yii\base\InvalidConfigException;

/**
 * Working with Imagemagick
 */
class IMagickAdapter
{
    private $image;

    /**
     * @var integer Opened image height
     */
    private $height;

    /**
     * @var integer Opened image width
     */
    private $width;

    /**
     * Get opened image width
     * @return integer Image width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get opened image height
     * @return integer Image height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * IMagickAdapter constructor.
     */
    private function __construct()
    {
    }

    /**
     * open
     *
     * @param $imagePath
     *
     * @return IMagickAdapter
     */
    public static function open($imagePath)
    {
        $model = new self();
        $model->image = new \Imagick($imagePath);
        $geo = $model->image->getImageGeometry();
        $model->height = $geo['height'];
        $model->width = $geo['width'];

        return $model;
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
        $this->image->reduceNoiseImage($radius);

        return $this;
    }

    /**
     * Save result
     * @param string $path Save path
     * @return void
     */
    public function saveTo($path)
    {
        $this->image->writeImage($path);
        $this->image->destroy();
    }

    /**
     * border
     *
     * @param $width
     * @param $color
     *
     * @return $this
     */
    public function border($width, $color)
    {
        $border = new \ImagickDraw();
        $border->setFillColor('none');
        $border->setStrokeColor(new \ImagickPixel($color));
        $border->setStrokeWidth($width);
        $widthPart = $width / 2;
        $border->line(0, 0 + $widthPart, $this->width, 0 + $widthPart);
        $border->line(0, $this->height - $widthPart, $this->width, $this->height - $widthPart);
        $border->line(0 + $widthPart, 0, 0 + $widthPart, $this->height);
        $border->line($this->width - $widthPart, 0, $this->width - $widthPart, $this->height);
        $this->image->drawImage($border);

        return $this;
    }

    /**
     * blur
     *
     * @param $radius
     * @param $delta
     *
     * @return $this
     */
    public function blur($radius, $delta)
    {
        $this->image->blurImage($radius, $delta);

        return $this;
    }

    /**
     * quality
     *
     * @param $quality
     *
     * @return $this
     */
    public function quality($quality)
    {
        $this->image->setImageCompression(\Imagick::COMPRESSION_JPEG2000);
        $this->image->setImageCompressionQuality($quality);

        return $this;
    }

    /**
     * crop
     *
     * @param $startX
     * @param $startY
     * @param $width
     * @param $height
     *
     * @return $this
     */
    public function crop($startX, $startY, $width, $height)
    {
        $this->image->cropImage($width, $height, $startX, $startY);

        return $this;
    }

    /**
     * flip
     *
     * @return $this
     */
    public function flip()
    {
        $this->image->flipImage();

        return $this;
    }

    /**
     * flop
     *
     * @return $this
     */
    public function flop()
    {
        $this->image->flopImage();

        return $this;
    }

    /**
     * Add watermark to image
     *
     * @param string          $watermarkPath Path to watermark image
     * @param string          $xPos          Horizontal position - 'left', 'right' or 'center'
     * @param string          $yPos          Vertical position - 'top', 'bottom' or 'center'
     * @param bool|int|string $xSize         Horizontal watermark size: 100, '50%', 'auto' etc.
     * @param bool|int|string $ySize         Vertical watermark size: 100, '50%', 'auto' etc.
     * @param bool            $xOffset
     * @param bool            $yOffset
     *
     * @return $this
     * @throws InvalidConfigException
     */
    public function watermark($watermarkPath, $xPos, $yPos, $xSize = false, $ySize = false, $xOffset = false, $yOffset = false)
    {
        $watermark = new \Imagick($watermarkPath);

        // resize watermark
        $newSizeX = false;
        $newSizeY = false;
        if ($xSize !== false) {
            if (is_numeric($xSize)) {
                $newSizeX = $xSize;
            } elseif (is_string($xSize) && substr($xSize, -1) === '%') {
                $float = str_replace('%', '', $xSize) / 100;
                $newSizeX = $this->width * ((float) $float);
            }
        }
        if ($ySize !== false) {
            if (is_numeric($ySize)) {
                $newSizeY = $ySize;
            } elseif (is_string($ySize) && substr($ySize, -1) === '%') {
                $float = str_replace('%', '', $ySize) / 100;
                $newSizeY = $this->height * ((float) $float);
            }
        }
        // var_dump($newSizeX);var_dump($newSizeY);die();
        if ($newSizeX !== false && $newSizeY !== false) {
            $watermark->adaptiveResizeImage($newSizeX, $newSizeY);
        } elseif ($newSizeX !== false && $newSizeY === false) {
            $watermark->adaptiveResizeImage($newSizeX, 0);
        } elseif ($newSizeX === false && $newSizeY !== false) {
            $watermark->adaptiveResizeImage(0, $newSizeY);
        }

        $startX = false;
        $startY = false;
        $watermarkSize = $watermark->getImageGeometry();
        if ($yPos === 'top') {
            $startY = 0;
            if ($yOffset !== false) {
                $startY += $yOffset;
            }
        } elseif ($yPos === 'bottom') {
            $startY = $this->height - $watermarkSize['height'];
            if ($yOffset !== false) {
                $startY -= $yOffset;
            }
        } elseif ($yPos === 'center') {
            $startY = ($this->height / 2) - ($watermarkSize['height'] / 2);
        } else {
            throw new InvalidConfigException('Param $yPos should be "top", "bottom" or "center" insteed "'.$yPos.'"', 1);
        }

        if ($xPos === 'left') {
            $startX = 0;
            if ($xOffset !== false) {
                $startX += $xOffset;
            }
        } elseif ($xPos === 'right') {
            $startX = $this->width - $watermarkSize['width'];
            if ($xOffset !== false) {
                $startX -= $xOffset;
            }
        } elseif ($xPos === 'center') {
            $startX = ($this->width / 2) - ($watermarkSize['width'] / 2);
        } else {
            throw new InvalidConfigException('Param $xPos should be "left", "right" or "center" insteed "'.$xPos.'"', 1);
        }

        $this->image->compositeImage($watermark, \Imagick::COMPOSITE_OVER, $startX, $startY);

        return $this;
    }

    /**
     * thumb
     *
     * @param $width
     * @param $height
     *
     * @return $this
     */
    public function thumb($width, $height)
    {
        if ($this->width >= $this->height || $height === false) {
            $this->image->thumbnailImage($width, 0);
        } else {
            $this->image->thumbnailImage(0, $height);
        }

        return $this;
    }

    /**
     * setImageInterpolateMethod
     *
     * @param $method
     *
     * @return void
     */
    public function setImageInterpolateMethod($method)
    {
        $this->image->setImageInterpolateMethod($method);
    }

    /**
     * resize
     *
     * @param $width
     * @param $height
     *
     * @return $this
     */
    public function resize($width, $height)
    {
        if ($this->width >= $this->height || $height === false) {
            $this->image->adaptiveResizeImage($width, 0);
        } else {
            $this->image->adaptiveResizeImage(0, $height);
        }

        return $this;
    }
}
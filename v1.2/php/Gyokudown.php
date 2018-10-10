<?php

include_once('Parsedown.php');

class Gyokudown extends Parsedown
{
    protected $safeLinksWhitelist = array(
        'http://',
        'https://',
        'ftp://',
        'ftps://',
        'mailto:',
        'data:image/png;base64,',
        'data:image/gif;base64,',
        'data:image/jpeg;base64,',
        'irc:',
        'ircs:',
        'git:',
        'ssh:',
        'news:',
        'steam:',
        'blob:',
    );

    private $imagePathConverter;

    public function __construct($converter)
    {
        $this->imagePathConverter = $converter;
    }

    protected function inlineImage($excerpt)
    {
        $image = parent::inlineImage($excerpt);

        if (!isset($image))
        {
            return null;
        }

        $original = $image['element']['attributes']['src'];
        $converted = $this->imagePathConverter->convert($original);

        if ($converted === $original) {
            throw new ImagePathNotConverted("Image not found: $original");
        }

        $image['element']['attributes']['src'] = $converted;
        
        return $image;
    }
}

class ImagePathNotConverted extends Exception {}

class ImagePathConverter
{
    private $prefix;
    private $nameMap;

    public function __construct($pre = "", $conv = []) {
        $this->prefix = $pre;
        $this->nameMap = $conv;
    }

    public function convert($path)
    {
        foreach ($this->nameMap as $orig => $to) {
            if ($path === $orig) {
                $path = $to;
                break;
            }
        }
        return $this->prefix . $path;
    }
}
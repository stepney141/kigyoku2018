<?php

include_once('Parsedown.php');

class Gyokudown extends Parsedown
{
    private $baseImagePath = "/blog/images/";

    protected function inlineImage($excerpt)
    {
        $image = parent::inlineImage($excerpt);

        if (!isset($image))
        {
            return null;
        }

        $image['element']['attributes']['src'] = $this->baseImagePath . $image['element']['attributes']['src'];
        
        return $image;
    }
}
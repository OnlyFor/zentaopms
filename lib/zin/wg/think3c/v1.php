<?php
declare(strict_types=1);
namespace zin;

requireWg('thinkModel');

class think3c extends thinkModel
{
    public static function getPageJS(): string
    {
        return file_get_contents(__DIR__ . DS . 'js' . DS . 'v1.js');
    }

    protected function buildBody(): array
    {
        jsVar('modelImg', 'data/thinmory/thumbnail/model3c.png');

        return array(h::canvas(setID('canvas')));
    }

    protected function build(): node
    {
        $mode  = $this->prop('mode');
        $style = $mode == 'preview' ? setStyle(array('min-height' => '254px')) : setStyle(array('min-height' => '254px', 'width' => '2156px'));

        return div
        (
            setClass('model-3c my-1 flex col flex-wrap justify-between'),
            $style,
            $this->buildBody()
        );
    }
}
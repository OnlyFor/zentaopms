<?php
declare(strict_types=1);
namespace zin;

class pivotTable extends wg
{
    protected static array $defineProps = array(
        'title?: string',
        'class?: string',
        'width?: string',
        'cols?: array',
        'data?: array',
        'cellSpan?: array',
        'filters?: array',
        'onRenderCell?: function',
        'onCellClick?: function'
    );

    protected static array $defineBlocks = array(
        'heading'     => array()
    );

    public static function getPageCSS(): ?string
    {
        return file_get_contents(__DIR__ . DS . 'css' . DS . 'v1.css');
    }

    public static function getPageJS(): ?string
    {
        return file_get_contents(__DIR__ . DS . 'js' . DS . 'v1.js');
    }

    protected function buildFilters()
    {
        global $lang;
        list($filters) = $this->prop(array('filters'));

        if(empty($filters)) return div(setID('conditions'), setClass('mb-4'));

        return div
        (
            setID('conditions'),
            setClass('flex justify-start bg-canvas mt-4 mb-2 w-full' . (count($filters) == 1 ? ' flex-wrap' : ' items-center')),
            count($filters) == 1 ? $filters : div
            (
                setClass('flex flex-wrap w-full'),
                $filters
            ),
            button(setClass('btn primary mb-2 load-custom-pivot'), $lang->pivot->query)
        );
    }

    protected function buildDTable()
    {
        global $lang;
        list($cols, $data, $cellSpan, $filters, $onRenderCell, $onCellClick) = $this->prop(array('cols', 'data', 'cellSpan', 'filters', 'onRenderCell', 'onCellClick'));

        $filterCount = count($filters);
        return dtable
        (
            setID('designTable'),
            set::striped(true),
            set::bordered(true),
            set::height(jsRaw("() => getHeight(800, $filterCount)")),
            set::cols($cols),
            set::data($data),
            set::emptyTip($lang->pivot->noPivotTip),
            set::onRenderCell($onRenderCell),
            set::onCellClick($onCellClick),
            set::rowKey('ROW_ID'),
            set::plugins(array('header-group', $cellSpan ? 'cellspan' : null)),
            $cellSpan ? set::getCellSpan(jsRaw('getCellSpan')) : null,
            $cellSpan ? set::cellSpanOptions($cellSpan) : null
        );
    }

    protected function build()
    {
        global $lang;
        list($title, $class, $width) = $this->prop(array('title', 'class', 'width'));
        return div
        (
            setClass('dtable-content bg-canvas', $class),
            setStyle('width', $width),
            panel
            (
                set::title($title),
                set::shadow(false),
                set::bodyClass('pt-0 panel-body-height'),
                $this->buildFilters(),
                $this->buildDTable(),
                set::headingClass('h-12 border-b'),
                to::heading($this->block('heading'))
            )
        );
    }
}
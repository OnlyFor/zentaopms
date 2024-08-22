<?php
declare(strict_types=1);
namespace zin;

class thinkStep  extends wg
{
    protected static array $defineProps = array(
        'item: object',
        'action?: string="detail"',
        'addType?: string',
        'isRun?: bool=false',        // 是否是分析活动
    );

    protected function buildBody(): wg|array
    {
        list($item, $action, $addType, $isRun) = $this->prop(array('item', 'action', 'addType', 'isRun'));

        $step         = $addType ? null : $item;
        $questionType = $addType ? $addType : ($item->options->questionType ?? '');
        if($addType === 'node' || !$addType && $item->type === 'node') return thinkNode(set::step($step), set::mode($action), set::isRun($isRun));
        if($addType === 'transition' || !$addType && $item->type === 'transition') return thinkTransition(set::step($step), set::mode($action), set::isRun($isRun));
        if($questionType === 'input')      return thinkInput(set::step($step), set::questionType('input'), set::mode($action), set::isRun($isRun));
        if($questionType === 'radio')      return thinkRadio(set::step($step), set::questionType('radio'), set::mode($action), set::isRun($isRun));
        if($questionType === 'checkbox')   return thinkCheckbox(set::step($step), set::questionType('checkbox'), set::mode($action), set::isRun($isRun));
        if($questionType === 'tableInput') return thinkTableInput(set::step($step), set::questionType('tableInput'), set::mode($action), set::isRun($isRun));
        if($questionType === 'multicolumn') return thinkMulticolumn(set::step($step), set::questionType('multicolumn'), set::mode($action), set::isRun($isRun));
        return array();
    }

    protected function build(): wg|node|array
    {
        global $lang, $app;
        $app->loadLang('thinkstep');

        list($item, $action, $addType, $isRun) = $this->prop(array('item', 'action', 'addType', 'isRun'));
        if(!$item && !$addType) return array();

        $marketID  = data('marketID');
        $basicType = $item->type ?? '';
        $typeLang  = $action . 'Step';
        $type      = $addType ? $addType : ($basicType == 'question' ? $item->options->questionType : $basicType);
        $title     = $action == 'detail' ? sprintf($lang->thinkstep->info, $lang->thinkstep->$basicType) : sprintf($lang->thinkstep->formTitle[$type], $lang->thinkstep->$typeLang);
        $canEdit   = common::hasPriv('thinkstep', 'edit');
        $canDelete = common::hasPriv('thinkstep', 'delete');

        return div
        (
            setClass('think-step relative h-full overflow-y-auto scrollbar-thin'),
            !$isRun ? array(
                div
                (
                    setClass('flex items-center justify-between text-gray-950 h-12'),
                    setStyle(array('padding-left' => '48px', 'padding-right' => '48px')),
                    div(setClass('font-medium'), $title),
                    ($action != 'detail') ? null : div
                    (
                        setClass('ml-2'),
                        setStyle(array('min-width' => '48px')),
                        btnGroup
                        (
                            $canEdit ? btn
                            (
                                setClass('btn ghost text-gray w-5 h-5'),
                                set::icon('edit'),
                                set::url(createLink('thinkstep', 'edit', "marketID={$marketID}&stepID={$item->id}")),
                            ) : null,
                            $canDelete ? (!$item->existNotNode ? btn
                            (
                                setClass('btn ghost text-gray w-5 h-5 ml-1 ajax-submit'),
                                set::icon('trash'),
                                setData('url', createLink('thinkstep', 'delete', "marketID={$marketID}&stepID={$item->id}")),
                                setData('confirm',  $lang->thinkstep->deleteTips[$basicType])
                            ) : btn
                            (
                                set(array(
                                    'class'          => 'ghost w-5 h-5 text-gray opacity-50 ml-1',
                                    'icon'           => 'trash',
                                    'data-toggle'    => 'tooltip',
                                    'data-title'     => $lang->thinkstep->cannotDeleteNode,
                                    'data-placement' => 'bottom-start',
                                ))
                            )) : null
                        )
                    )
                ),
                h::hr()
            ) : null,
            div(setClass('pt-6 px-8 mx-4 pb-2'), $this->buildBody())
        );
    }
}

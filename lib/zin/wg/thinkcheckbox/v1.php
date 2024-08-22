<?php
declare(strict_types=1);
namespace zin;

requireWg('thinkRadio');

/**
 * 多选题型部件类
 * The thinkCheckbox widget class
 */
class thinkCheckbox extends thinkRadio
{
    protected static array $defineProps = array
    (
        'minCount?: string',
        'maxCount?: string',
    );

    protected function buildFormItem(): array
    {
        global $lang, $app;
        $app->loadLang('thinkstep');
        $formItems = parent::buildFormItem();

        list($step, $minCount, $maxCount, $required) = $this->prop(array('step', 'minCount', 'maxCount', 'required'));
        if($step)
        {
            $required = $step->options->required;
            $minCount = $step->options->minCount ?? null;
            $maxCount = $step->options->maxCount ?? null;
        }
        $className = 'selectable-rows' . (empty($required) ? ' hidden' : '');

        $formItems[] = formRow
        (
            setClass('gap-4'),
            formGroup
            (
                set::label($lang->thinkstep->label->minCount),
                set::labelClass('required'),
                setClass($className, 'min-count'),
                input
                (
                    set::placeholder($lang->thinkstep->placeholder->inputContent),
                    set::type('number'),
                    set::min(1),
                    set::name('options[minCount]'),
                    set::value($minCount),
                ),
            ),
            formGroup
            (
                set::label($lang->thinkstep->label->maxCount),
                set::labelClass('required'),
                setClass($className, 'max-count'),
                input
                (
                    set::placeholder($lang->thinkstep->placeholder->inputContent),
                    set::type('number'),
                    set::min(1),
                    set::name('options[maxCount]'),
                    set::value($maxCount)
                )
            )
        );
        $formItems[] = $this->children();
        return $formItems;
    }
}

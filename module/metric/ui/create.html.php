<?php
declare(strict_types=1);
/**
 * The create view file of company module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Chenxuan Song <songchenxuan@easycorp.ltd>
 * @package     metric
 * @link        https://www.zentao.net
 */
namespace zin;

$fnGenerateAfterCreateRatio = function() use ($lang)
{
    $afterCreateList = $lang->metric->afterCreateList;
    $hasImplementPriv = hasPriv('metric', 'implement');
    if(!$hasImplementPriv) unset($afterCreateList['implement']);
    $defaultValue = $hasImplementPriv ? 'implement' : 'back';

    return formGroup
    (
        set::width('1/2'),
        set::name('afterCreate'),
        set::label($lang->metric->afterCreate),
        set::control(array('type' => 'radioList', 'inline' => true)),
        set::items($afterCreateList),
        set::value($defaultValue)
    );
};

formPanel
(
    detailHeader
    (
        to::title
        (
            entityLabel
            (
                setClass('text-lg'),
                set::level(1),
                set::text($lang->metric->create)
            ),
            div
            (
                icon
                (
                    setClass('warning-ghost margin-left8'),
                    'help',
                ),
                label
                (
                    set::text($lang->metric->tips->noticeUnchangeable),
                    setClass('gray-200-pale')
                )
            )
        )
    ),
    formRow
    (
        formGroup
        (
            set::width('1/3'),
            set::label($lang->metric->formLabel->scope),
            set::name('scope'),
            set::items($lang->metric->scopeList),
            set::value($scope),
            set::required(true)
        ),
        formGroup
        (
            set::width('1/3'),
            set::label($lang->metric->formLabel->object),
            set::name('object'),
            set::items($lang->metric->objectList),
            set::value('program'),
            set::required(true)
        ),
        formGroup
        (
            set::width('1/3'),
            set::label($lang->metric->formLabel->purpose),
            set::name('purpose'),
            set::items($lang->metric->purposeList),
            set::value('scale'),
            set::required(true)
        )
    ),
    formGroup
    (
        set::label($lang->metric->formLabel->dateType),
        set::name('dateType'),
        set::items($lang->metric->dateTypeList),
        set::value($period),
        set::width('1/2'),
        set::required(true)
    ),
    formGroup
    (
        set::label($lang->metric->formLabel->name),
        set::name('name'),
        set::required(true)
    ),
    formGroup
    (
        set::label($lang->metric->formLabel->alias),
        set::name('alias'),
        set::required(false),
        set::placeholder($lang->metric->aliasTip)
    ),
    formGroup
    (
        set::label($lang->metric->formLabel->code),
        set::name('code'),
        set::required(true)
    ),
    formRow
    (
        set::id('unitBox'),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->metric->formLabel->unit),
            inputGroup
            (
                div
                (
                    setClass('grow'),
                    picker
                    (
                        set::name('unit'),
                        set::items($lang->metric->unitList)
                    )
                ),
                div
                (
                    setClass('flex items-center pl-2 clip'),
                    checkbox
                    (
                        set::name('customUnit'),
                        set::text($lang->metric->customUnit)
                    )
                )
            )
        )
    ),
    formRow
    (
        set::id('addUnitBox'),
        setClass('hidden'),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->metric->formLabel->unit),
            inputGroup
            (
                div
                (
                    setClass('grow'),
                    input(set::name('addunit'))
                ),
                div
                (
                    setClass('flex items-center pl-2 clip'),
                    checkbox
                    (
                        set::name('customUnit'),
                        set::text($lang->metric->customUnit)
                    )
                )
            )
        )
    ),
    on::change('[name=customUnit]', 'addUnit'),
    formGroup
    (
        set::label($lang->metric->formLabel->desc),
        set::control(array('type' => 'textarea', 'rows' => 3)),
        set::name('desc'),
        set::placeholder($lang->metric->descTip)
    ),
    formGroup
    (
        set::label($lang->metric->formLabel->definition),
        set::control(array('type' => 'textarea', 'rows' => 3)),
        set::name('definition'),
        set::placeholder($lang->metric->definitionTip)
    ),
    $fnGenerateAfterCreateRatio(),
    set::submitBtnText($lang->save)
);

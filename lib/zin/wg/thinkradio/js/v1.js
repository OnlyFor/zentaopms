/**
 * 修改引用题目。
 * Change quote title.
 *
 * @param  event
 * @access public
 * @return void
 */
window.changeQuoteTitle = function(event)
{
    let fields          = [];  //  所有的多列填空题的配置项
    let requiredFields  = [];  //  多列填空题必填的标题id
    let citationItems   = [];  //  选择列picker组件的下拉项
    let isMulticolumn   = false;
    let multicolumnStep = false

    const quoteQuestions = $('.options-quote-title').data().quoteQuestions;
    const quoteTitle     = $('input[name="options[quoteTitle]').val();

    $.each(quoteQuestions, function(index, item) {
        const options = JSON.parse(item.options);
        if(quoteTitle && item.id == quoteTitle && options.questionType === 'multicolumn')
        {
            multicolumnStep = true;
            requiredFields  = options.requiredCols;
            fields          = options.fields;
        }
    });

    /* 渲染选择列的下拉项。Renders a drop-down item for a select column.*/
    $.each(requiredFields, function(index, key) {
        /* 必填列的值-1是多列填空fields数组的key。The value of -1 in the required column is the key for the multi column fill in the blank fields array. */
        const keyValue = parseInt(key) - 1;
        citationItems.push({key: keyValue, value:keyValue, text: fields[keyValue]});
    })

    $('.quote-citation').toggleClass('gap-4', multicolumnStep);
    $('.select-column').toggleClass('hidden', !multicolumnStep);
    $('.citation').toggleClass('hidden', multicolumnStep);
    $('.multicolumn-citation').toggleClass('hidden', !multicolumnStep);
    if(multicolumnStep)
    {
        /* 引用题目为多列填空题的时候，重置选择列的下拉选项和默认值， 修改引用方式为：引用某行输入项。 */
        /* When the reference question is a multi-column fill-in-the-blank question, reset the drop-down options and default values of the selected column, and change the reference method to: reference an input item in a row. */
        $('.select-column .picker-box').zui('picker').render({items: citationItems});
        $('.select-column .picker-box').zui('picker').$.setValue(citationItems[0]);
        $('.multicolumn-citation input[name="options[citation]"]').prop('checked', true);
    }
    else
    {
        /* 引用题目类型为多选或者单选题是，清空选择列的下拉选项和默认值，修改默认引用方式为：引用题的选中项。 */
        /* If the reference question type is multiple choice or single choice, clear the drop-down options and default values in the selection column, and change the default reference method to: reference the selected item in the question. */
        $('.select-column .picker-box').zui('picker').render({items: []});
        $('.select-column .picker-box').zui('picker').$.setValue('');
        $('.citation input[id="options[citation]1"]').prop('checked', true);
    }
}
window.createSortLink = function(col)
{
    var sort = col.name + '_asc';
    if(sort == orderBy) sort = col.name + '_desc';

    return "javascript:loadTarget('" + sortLink.replace('{orderBy}', sort) + "', 'mr-bug')";
}

$(document).off('click','.dtable-footer .batch-btn').on('click', '.dtable-footer .batch-btn', function(e)
{
    const dtable = zui.DTable.query(e.target);
    const checkedList = dtable.$.getChecks();
    if(!checkedList.length) return;

    const tabType  = $(this).data('type');
    const postData = new FormData();
    checkedList.forEach((id) => postData.append(`${tabType}[]`, id));

    $.ajaxSubmit({
        url:  $(this).data('url'),
        data: postData
    });
    $(this).prop('disabled', true);
});

window.onSearchFormResult = function(formName, response)
{
    response.then(res => res.json())
        .then(json => {
            loadTarget(json.load, 'mr-bug');
        }).catch(console.error);
}

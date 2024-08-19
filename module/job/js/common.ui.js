window.customCount = 1;
window.addItem = function(event)
{
    const obj        = $(event.target);
    const inputGroup = obj.closest('.input-group').clone();
    const newName    = window.customCount + 'custom';
    window.customCount ++;

    $(inputGroup).find('input.custom').attr('id', newName);
    $(inputGroup).find('input.paramName').val('');
    $(inputGroup).find('input[id="' + newName + '"]').next().attr('for', newName);
    obj.closest('.form-group').append($(inputGroup));
}

window.deleteItem = function(event)
{
    const $obj = $(event.target);
    if($('.delete-param').length > 1) $obj.closest('.input-group').remove();
}

/**
 * Show input, hidden select.
 *
 * @param  obj $obj
 * @access public
 * @return void
 */
window.setValueInput = function(event)
{
    const obj = event.target;
    if($(obj).prop('checked'))
    {
        $(obj).closest('.input-group').find('select').attr('disabled', true);
        $(obj).closest('.input-group').find('select').addClass('hidden');
        $(obj).closest('.input-group').find("input[name^='paramValue']").removeClass('hidden');
        $(obj).closest('.input-group').find("input[name^='paramValue']").removeAttr('disabled');
    }
    else
    {
        $(obj).closest('.input-group').find("input[name^='paramValue']").attr('disabled', true);
        $(obj).closest('.input-group').find("input[name^='paramValue']").addClass('hidden');
        $(obj).closest('.input-group').find('select').removeClass('hidden');
        $(obj).closest('.input-group').find('select').removeAttr('disabled');
    }
}

window.loadRepoList = function(engine = '')
{
    const link = $.createLink('job', 'ajaxGetRepoList', 'engine=' + engine);
    $.get(link, function(data)
    {
        if(data)
        {
            $('#repo').replaceWith(data)
            $('#repo_chosen').remove();
            $('#repo').chosen();
        }
    });
}

window.changeTrigger = function(event)
{
    let useZentao;
    if(typeof(event) == 'object')
    {
        useZentao = $(event.target).val();
    }
    else
    {
        useZentao = event;
    }

    if(useZentao === '1')
    {
        const frame = $('[name=frame]').val();
        $('.job-form #paramDiv').show();
        if(frame == 'sonarqube') $('.job-form .sonarqube').removeClass('hidden');
        $('.job-form .custom-fields').show();
        $('.job-form .comment-fields').css('display', 'flex');
        $('.job-form [data-name="triggerType"]').show();
    }
    else
    {
        $('.job-form #paramDiv').hide();
        $('.job-form .sonarqube').addClass('hidden');
        $('.job-form .custom-fields').hide();
        $('.job-form .comment-fields').hide();
        $('.job-form [data-name="triggerType"]').hide();
    }
    $('[name=triggerType]').trigger('change');
}

/*
 * Check sonarqube linked.
 */
window.checkSonarquebLink = function()
{
    const repoID = $('[name=repo]').val();
    const frame  = $('[name=frame]').val();
    const jobID  = typeof(job) == 'undefined' ? 0 : job.id;

    if(frame != 'sonarqube' || repoID == 0) return false;

    $.getJSON($.createLink('job', 'ajaxCheckSonarqubeLink', 'repoID=' + repoID + '&jobID=' + jobID), function(result)
    {
        if(result.result  != 'success') zui.Modal.alert(result.message);
    })
}

window.changeJenkinsServer = function(event)
{
    const jenkinsID = $(event.target).val();

    const pipelineDropmenu = zui.Dropmenu.query('#pipelineDropmenu');
    if(!jenkinsID)
    {
        pipelineDropmenu.render({fetcher: ''});
    }
    else
    {
        pipelineDropmenu.render({fetcher: $.createLink('jenkins', 'ajaxGetJenkinsTasks', 'jenkinsID=' + jenkinsID)})
    }
}

window.changeTriggerType = function(event)
{
    let type;
    if(typeof(event) == 'object')
    {
        type = $(event.target).val();
    }
    else
    {
        type = event;
    }

    const repoID = $('[name=repo]').val();
    $('.svn-fields').addClass('hidden');
    if(type == 'tag' && repoList[repoID] && repoList[repoID].SCM == 'Subversion') $('.svn-fields').removeClass('hidden');

    $('.comment-fields').addClass('hidden');
    $('.custom-fields').addClass('hidden');
    const useZentao = $('[name=useZentao]:checked').val();
    if(useZentao == '1' && type == 'commit')   $('.comment-fields').removeClass('hidden');
    if(useZentao == '1' && type == 'schedule') $('.custom-fields').removeClass('hidden');
}

window.changeSonarqubeServer = function(event)
{
    const sonarqubeID = $('[name=sonarqubeServer]').val();
    $.get($.createLink('sonarqube', 'ajaxGetProjectList', 'sonarqubeID=' + sonarqubeID), function(data)
    {
        data = JSON.parse(data);
        $('#projectKey').zui('picker').render({items: data});
    })

    /* There has been a problem with handling the prompt label. */
    $('#projectKeyLabel').remove();
}

window.changeFrame = function(event)
{
    const frame     = $(event.target).val();
    const useZentao = $('[name=useZentao]:checked').val();
    if(frame == 'sonarqube')
    {
        /* Check exists sonarqube data. */
        checkSonarquebLink();

        if(useZentao == '1') $('div.sonarqube').removeClass('hidden');
    }
    else
    {
        $('div.sonarqube').addClass('hidden');
    }
}

window.changeEngine = function(event)
{
    const engine      = $(event.target).val();
    const repos       = [];
    let   checkedRepo = '';
    for(const repoID in repoList)
    {
        const repo = repoList[repoID];
        if(engine == 'jenkins')
        {
            if(repoID == pageRepoID || !checkedRepo) checkedRepo = repoID;
            repos.push({text: `[${repo.SCM}] ${repo.name}`, value: repoID});
        }
        else if(repo.SCM.toLowerCase() == engine)
        {
            if(repoID == pageRepoID || !checkedRepo) checkedRepo = repoID;
            repos.push({text: `[${repo.SCM}] ${repo.name}`, value: repoID});
        }
    }

    const picker = $('[name=repo]').zui('picker');
    picker.render({items: repos});
    picker.$.setValue(checkedRepo);

    if(engine == 'jenkins')
    {
        $('#jenkinsServerTR').removeClass('hidden');
    }
    else
    {
        $('#jenkinsServerTR').addClass('hidden');
    }

    const items = [];
    for(frame in frameList)
    {
        if(engine == 'jenkins' || frame != 'sonarqube') items.push({'text': frameList[frame], 'value': frame});
    }
    zui.Picker.query('[name=frame]').render({items: items});
}

window.changeRepo = function()
{
    const repoID = $('input[name="repo"]').val();
    if(!repoID) return;

    let link = $.createLink('repo', 'ajaxLoadProducts', 'repoID=' + repoID);
    $.get(link, function(data)
    {
        if(data)
        {
            $productPicker = $('input[name="product"]').zui('picker');
            data = JSON.parse(data);

            $productPicker.render({items: data});
            $productPicker.$.clear();
            if(data[1]) $productPicker.$.setValue(data[1].value);
        }
    });

    /* Add new way get repo type. */
    link = $.createLink('job', 'ajaxGetRepoType', 'repoID=' + repoID);
    const $trigger = $('[name=triggerType]').zui('picker');
    $.getJSON(link, function(data)
    {
        if(data.result == 'success')
        {
            const triggerOptions = [];
            for(code in triggerList)
            {
                if(code == 'tag' && !data.triggerByTag) continue;
                triggerOptions.push({text: triggerList[code], value: code})
            }
            $trigger.render({items: triggerOptions});
            if($('[name=triggerType]').val() == 'tag') $trigger.$.setValue(triggerOptions[0].value);

            if(data.type.indexOf('git') != -1)
            {
                $('.reference').addClass('gitRepo');

                $('.svn-fields').addClass('hidden');
                $('#reference option').remove();

                $.getJSON($.createLink('job', 'ajaxGetRefList', "repoID=" + repoID), function(response)
                {
                    if(response.result == 'success')
                    {
                        const $reference = $('#reference').zui('picker');
                        $reference.render({items: response.refList});
                        $reference.$.setValue(response.refList.length > 0 ? response.refList[0].value : '');
                    }
                });
            }
            else
            {
                $('.reference').removeClass('gitRepo');
                if($('[name=triggerType]').val() == 'tag') $('.svn-fields').removeClass('hidden');

                $.getJSON($.createLink('repo', 'ajaxGetSVNDirs', 'repoID=' + repoID), function(tags)
                {
                    const $svnDom = $('#svnDir').zui('picker');
                    const options = [];
                    for(path in tags) options.push({text: path, value: path});
                    $svnDom.render({items: options});
                })
            }

            for(i in triggerOptions)
            {
                if(triggerOptions[i].value == 'tag') triggerOptions[i].text = data.type != 'subversion' ? buildTag : dirChange;
            }
            $trigger.render({items: triggerOptions});
        }
    });

    /* Check exists sonarqube data. */
    window.checkSonarquebLink();
}

window.changeCustomField = function(event)
{
    let paramValue = $(event.target).val();
    paramValue = paramValue.substr(1).toUpperCase();
    $(event.target).prevAll('input').val(paramValue);
}

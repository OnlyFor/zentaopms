<?php
global $lang;

$scrumProjectManage = new stdClass();
$scrumProjectManage->name    = 'scrumProjectManage';
$scrumProjectManage->title   = $lang->tutorial->scrumProjectManage->title;
$scrumProjectManage->icon    = 'project text-special';
$scrumProjectManage->type    = 'basic';
$scrumProjectManage->modules = 'project,execution,build';
$scrumProjectManage->app     = 'project';
$scrumProjectManage->tasks   = array();

$scrumProjectManage->tasks['manageProject'] = array();
$scrumProjectManage->tasks['manageProject']['name']     = 'manageProject';
$scrumProjectManage->tasks['manageProject']['title']    = $lang->tutorial->scrumProjectManage->manageProject->title;
$scrumProjectManage->tasks['manageProject']['startUrl'] = array('project', 'browse');
$scrumProjectManage->tasks['manageProject']['steps']   = array();

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'  => 'openApp',
    'app'   => 'project',
    'title' => $lang->tutorial->scrumProjectManage->manageProject->step1->name,
    'desc'  => $lang->tutorial->scrumProjectManage->manageProject->step1->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'click',
    'target' => '#actionBar .create-project-btn',
    'page'   => 'project-browse',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step2->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step2->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'click',
    'target' => '#modelList div.scrum div.model-item',
    'page'   => 'project-browse',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step3->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step3->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'form',
    'target' => '#form-project-create',
    'page'   => 'project-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step4->name
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => '#form-project-create .form-actions button[type="submit"]',
    'page'   => 'project-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step5->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step5->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'click',
    'target' => '#table-project-browse .dtable-body div[data-row="3"] a',
    'page'   => 'project-browse',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step6->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step6->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'clickNavbar',
    'target' => 'settings',
    'page'   => 'project-index',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step7->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step7->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'clickMainNavbar',
    'target' => 'members',
    'page'   => 'project-view',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step8->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step8->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'click',
    'target' => '#mainContainer #mainMenu #actionBar a',
    'page'   => 'project-team',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step9->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step9->desc
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'form',
    'target' => '#teamForm',
    'page'   => 'project-manageMembers',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step10->name,
);

$scrumProjectManage->tasks['manageProject']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => '#teamForm #saveButton',
    'page'   => 'project-manageMembers',
    'title'  => $lang->tutorial->scrumProjectManage->manageProject->step11->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageProject->step11->desc
);

$scrumProjectManage->tasks['manageExecution'] = array();
$scrumProjectManage->tasks['manageExecution']['name']     = 'manageExecution';
$scrumProjectManage->tasks['manageExecution']['title']    = $lang->tutorial->scrumProjectManage->manageExecution->title;
$scrumProjectManage->tasks['manageExecution']['startUrl'] = array('project', 'index', 'project=2');
$scrumProjectManage->tasks['manageExecution']['steps']    = array();

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'clickNavbar',
    'target' => 'execution',
    'page'   => 'project-index',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step1->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step1->desc
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'click',
    'target' => '#mainMenu #actionBar a.create-execution-btn',
    'page'   => 'project-execution',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step2->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step2->desc
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'form',
    'target' => '#form-execution-create',
    'app'    => 'execution',
    'page'   => 'execution-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step3->name
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => '#form-execution-create .form-actions button[type="submit"]',
    'page'   => 'execution-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step4->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step4->desc
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'click',
    'target' => '#tipsModal div.panel-body button.linkstory-btn',
    'page'   => 'execution-create', //注意：需要验证一下，写execution-create正确还是execution-tips正确
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step5->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step5->desc
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'selectRow',
    'target' => '#table-execution-linkstory',
    'page'   => 'execution-linkstory',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step6->name
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'click',
    'target' => '#table-execution-linkstory .dtable-footer .link-story-btn',
    'page'   => 'execution-linkstory',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step7->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step7->desc
);

$scrumProjectManage->tasks['manageExecution']['steps'][] = array(
    'type'   => 'clickNavbar',
    'target' => 'burn',
    'page'   => 'execution-story',
    'title'  => $lang->tutorial->scrumProjectManage->manageExecution->step8->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageExecution->step8->desc
);

$scrumProjectManage->tasks['manageTask'] = array();
$scrumProjectManage->tasks['manageTask']['name']     = 'manageTask';
$scrumProjectManage->tasks['manageTask']['title']    = $lang->tutorial->scrumProjectManage->manageTask->title;
$scrumProjectManage->tasks['manageTask']['startUrl'] = array('execution', 'task', 'executionID=1');
$scrumProjectManage->tasks['manageTask']['steps']    = array();

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'clickNavbar',
    'target' => 'story',
    'page'   => 'execution-story',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step1->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step1->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'selectRow',
    'target' => '#table-execution-story',
    'page'   => 'execution-story',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step2->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '#table-execution-story ', //分解任务的按钮没有选中
    'page'   => 'execution-story',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step3->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step3->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'page'   => 'task-batchCreate',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step4->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => 'form button[type="submit"]',
    'page'   => 'task-batchCreate',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step5->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step5->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '', //任务列表的指派给按钮
    'page'   => 'execution-task',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step6->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step6->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'page'   => 'task-assignTo',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step7->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'page'   => 'form button[type="submit"]',
    'page'   => 'task-assignTo',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step8->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step8->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '', //任务列表的开始按钮
    'page'   => 'execution-task',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step9->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step9->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'page'   => 'task-start',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step10->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'page'   => 'form button[type="submit"]',
    'page'   => 'task-start',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step11->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step11->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '', //任务列表的记录工时按钮
    'page'   => 'execution-task',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step12->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step12->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'page'   => 'task-recordWorkhour',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step13->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'page'   => 'form button[type="submit"]',
    'page'   => 'task-recordWorkhour',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step14->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step14->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '', //任务列表的完成按钮
    'page'   => 'execution-task',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step15->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step15->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'page'   => 'task-finish',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step16->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => 'form button[type="submit"]',
    'page'   => 'task-finish',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step17->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step17->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'clickNavbar',
    'target' => 'build',
    'page'   => 'execution-task',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step18->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step18->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '#mainContainer #actionBar a',
    'page'   => 'execution-build',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step19->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step19->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'form',
    'target' => 'form',
    'page'   => 'build-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step20->name,
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'saveForm',
    'target' => 'form button[type="submit"]',
    'page'   => 'build-create',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step21->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step21->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '', //版本列表中关联需求按钮
    'page'   => 'execution-build',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step22->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step22->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'selectRow',
    'target' => '#unlinkStoryList',
    'page'   => 'build-view',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step23->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step23->desc
);

$scrumProjectManage->tasks['manageTask']['steps'][] = array(
    'type'   => 'click',
    'target' => '#unlinkStoryList .dtable-footer .linkObjectBtn',
    'page'   => 'build-view',
    'title'  => $lang->tutorial->scrumProjectManage->manageTask->step24->name,
    'desc'   => $lang->tutorial->scrumProjectManage->manageTask->step24->desc
);

$config->tutorial->guides[$scrumProjectManage->name] = $scrumProjectManage;
#!/usr/bin/env php
<?php

/**

title=count_of_test_task_in_execution_when_starting
timeout=0
cid=1

- 测试分组数。 @2
- 测试执行11开始时的测试任务数。第0条的value属性 @0
- 测试执行12开始时的测试任务数。第0条的value属性 @2
- 测试执行13开始时的测试任务数。第0条的value属性 @0
- 测试不存在执行开始时的测试任务数。 @0

*/
include dirname(__FILE__, 7) . '/test/lib/init.php';
include dirname(__FILE__, 4) . '/lib/calc.unittest.class.php';

zendata('project')->loadYaml('project_status', true, 4)->gen(10);
zendata('project')->loadYaml('execution', true, 4)->gen(20, false);
zendata('task')->loadYaml('task', true, 4)->gen(1000);

$metric = new metricTest();
$calc   = $metric->calcMetric(__FILE__);

r(count($calc->getResult())) && p('') && e('10'); // 测试分组数。
r($calc->getResult(array('execution' => 11)))  && p('0:value') && e('0'); // 测试执行11开始时的测试任务数。
r($calc->getResult(array('execution' => 12)))  && p('0:value') && e('2'); // 测试执行12开始时的测试任务数。
r($calc->getResult(array('execution' => 13)))  && p('0:value') && e('0'); // 测试执行13开始时的测试任务数。
r($calc->getResult(array('execution' => 110))) && p('') && e('0');        // 测试不存在执行开始时的测试任务数。

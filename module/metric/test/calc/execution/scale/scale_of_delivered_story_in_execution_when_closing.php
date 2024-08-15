#!/usr/bin/env php
<?php

/**

title=scale_of_delivered_story_in_closed_execution
timeout=0
cid=1

- 测试分组数。 @6
- 测试项目4。第0条的value属性 @10

*/
include dirname(__FILE__, 7) . '/test/lib/init.php';
include dirname(__FILE__, 4) . '/lib/calc.unittest.class.php';

zendata('product')->loadYaml('product', true, 4)->gen(10);
zendata('project')->loadYaml('project_type', true, 4)->gen(100);
zendata('story')->loadYaml('story_closeddate', true, 4)->gen(1000);
zendata('projectstory')->loadYaml('executionstory', true, 4)->gen(1000);

$metric = new metricTest();
$calc   = $metric->calcMetric(__FILE__);

r(count($calc->getResult())) && p('') && e('12'); // 测试分组数。

r($calc->getResult(array('project' => '4'))) && p('0:value') && e('10');  // 测试项目4。

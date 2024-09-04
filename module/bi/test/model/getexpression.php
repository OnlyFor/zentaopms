#!/usr/bin/env php
<?php
include dirname(__FILE__, 5) . '/test/lib/init.php';
include dirname(__FILE__, 2) . '/lib/bi.unittest.class.php';

/**

title=biModel->getExpression();
timeout=0
cid=1

*/

$bi = new biTest();
r($bi->getExpressionTest(null, '*'))                    && p('') && e('*');                           // 测试 *
r($bi->getExpressionTest(null, 'id'))                   && p('') && e('`id`');                        // 测试 id
r($bi->getExpressionTest('t1', 'id'))                   && p('') && e('`t1`.`id`');                   // 测试 t1.id
r($bi->getExpressionTest('t1', '*'))                    && p('') && e('`t1`.*');                      // 测试 t1.*
r($bi->getExpressionTest(null, 'id', 'project'))        && p('') && e('`id` AS `project`');           // 测试 id as project
r($bi->getExpressionTest('t1', 'id', 'project'))        && p('') && e('`t1`.`id` AS `project`');      // 测试 t1.id as project
r($bi->getExpressionTest(null, 'date', null, 'year'))   && p('') && e('YEAR(`date`)');                // 测试 year(date)
r($bi->getExpressionTest(null, 'date', 'year', 'year')) && p('') && e('YEAR(`date`) AS `year`');      // 测试 year(date) as year
r($bi->getExpressionTest('t1', 'date', 'year', 'year')) && p('') && e('YEAR(`t1`.`date`) AS `year`'); // 测试 year(t1.date) as year

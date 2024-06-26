<?php
/**
 * 按系统统计的任务总数。
 * Count of task.
 *
 * 范围：system
 * 对象：task
 * 目的：scale
 * 度量名称：按系统统计的任务总数
 * 单位：个
 * 描述：按系统统计的任务总数是指整个团队或组织当前存在的任务总量。该度量项可以用来跟踪任务的规模和复杂性，为资源分配和工作计划提供基础。较大的任务总数可能需要更多的资源和时间来完成，而较小的任务总数可能意味着团队负荷较轻或项目进展较好。
 * 定义：所有的任务个数求和;过滤已删除的任务;
 *
 * @copyright Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @author    zhouxin <zhouxin@easycorp.ltd>
 * @package
 * @uses      func
 * @license   ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @Link      https://www.zentao.net
 */
class count_of_task extends baseCalc
{
    public $dataset = 'getTasks';

    public $fieldList = array('t1.id');

    public $result = 0;

    public function calculate($row)
    {
        $this->result ++;
    }

    public function getResult($options = array())
    {
        $records = $this->getRecords(array('value'));
        return $this->filterByOptions($records, $options);
    }
}

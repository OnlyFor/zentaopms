<?php include '../../common/view/header.html.php';?>
<?php if(isset($suhosinInfo)):?>
<div class='alert alert-info'><?php echo $suhosinInfo?></div>
<?php elseif(empty($maxImport) and $allCount > $this->config->file->maxImport):?>
<div id="mainContent" class="main-content">
  <div class="main-header">
    <h2><?php echo $lang->caselib->import;?></h2>
  </div>
  <p><?php echo sprintf($lang->file->importSummary, $allCount, html::input('maxImport', $config->file->maxImport, "style='width:50px'"), ceil($allCount / $config->file->maxImport));?></p>
  <p><?php echo html::commonButton($lang->import, "id='import'", 'btn btn-primary');?></p>
</div>
<script>
$(function()
{
    $('#maxImport').keyup(function()
    {
        if(parseInt($('#maxImport').val())) $('#times').html(Math.ceil(parseInt($('#allCount').html()) / parseInt($('#maxImport').val())));
    });
    $('#import').click(function(){location.href = createLink('caselib', 'showImport', "libID=<?php echo $libID;?>&pageID=1&maxImport=" + $('#maxImport').val())})
});
</script>
<?php else:?>
<style>
#mainContent form {overflow: auto;}
.c-pri {width: 100px;}
.c-title {width: 200px;}
.c-precondition {width: 200px;}
</style>
<div id="mainContent" class="main-content">
  <div class="main-header clearfix">
    <h2><?php echo $lang->caselib->import;?></h2>
  </div>
  <form target='hiddenwin' method='post'>
    <table class='table table-form' id='showData'>
      <thead>
        <tr>
          <th class='c-number'><?php echo $lang->testcase->id?></th>
          <th class='c-title       <?php if(strpos(",$requiredFields,", ',title,')        !== false) echo 'required';?>' id='title'>       <?php echo $lang->testcase->title?></th>
          <th class='c-module      <?php if(strpos(",$requiredFields,", ',module,')       !== false) echo 'required';?>' id='module'>      <?php echo $lang->testcase->module?></th>
          <th class='c-pri         <?php if(strpos(",$requiredFields,", ',pri,')          !== false) echo 'required';?>' id='pri'>         <?php echo $lang->testcase->pri?></th>
          <th class='c-type        <?php if(strpos(",$requiredFields,", ',type,')         !== false) echo 'required';?>' id='type'>        <?php echo $lang->testcase->type?></th>
          <th class='c-stage       <?php if(strpos(",$requiredFields,", ',stage,')        !== false) echo 'required';?>' id='stage'>       <?php echo $lang->testcase->stage?></th>
          <th class='c-text        <?php if(strpos(",$requiredFields,", ',text,')         !== false) echo 'required';?>' id='keywords'>    <?php echo $lang->testcase->keywords?></th>
          <th class='c-precondition <?php if(strpos(",$requiredFields,", ',precondition,') !== false) echo 'required';?>' id='precondition'><?php echo $lang->testcase->precondition?></th>
          <th class='c-case-step    <?php if(strpos(",$requiredFields,", ',step,')         !== false) echo 'required';?> col-content'>
            <table class='w-p100 table-borderless'>
              <tr>
                <th><?php echo $lang->testcase->stepDesc?></th>
                <th><?php echo $lang->testcase->stepExpect?></th>
              </tr>
            </table>
          </th>
        </tr>
      </thead>
      <tbody>
      <?php
        $insert         = true;
        $hideContentCol = true;
      ?>
      <?php foreach($caseData as $key => $case):?>
      <?php if(empty($case->title)) continue;?>
      <?php if(!empty($case->id) and !isset($cases[$case->id])) $case->id = 0;?>
      <tr class='text-left' valign='top'>
        <td>
          <?php
          if(!empty($case->id))
          {
              echo $case->id . html::hidden("id[$key]", $case->id);
              $insert = false;
          }
          else
          {
              echo $key . " <sup class='text-green small'>{$lang->testcase->new}</sup>";
          }
          echo html::hidden("lib[$key]", $libID);
          ?>
        </td>
        <td><?php echo html::input("title[$key]", $case->title, "class='form-control' style='margin-top:2px'")?></td>
        <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, isset($case->module) ? $case->module : (!empty($case->id) ? $cases[$case->id]->module : ''), "class='form-control chosen'")?></td>
        <td><?php echo html::select("pri[$key]", $lang->testcase->priList, isset($case->pri) ? $case->pri : (!empty($case->id) ? $cases[$case->id]->pri : ''), "class='form-control chosen'")?></td>
        <td><?php echo html::select("type[$key]", $lang->testcase->typeList, isset($case->type) ? $case->type : (!empty($case->id) ? $cases[$case->id]->type : ''), "class='form-control chosen'")?></td>
        <td style='overflow:visible'><?php echo html::select("stage[$key][]", $lang->testcase->stageList, !empty($case->stage) ? $case->stage : (!empty($case->id) ? $cases[$case->id]->stage : ''), "multiple='multiple' class='form-control chosen'")?></td>
        <td><?php echo html::input("keywords[$key]", isset($case->keywords) ? $case->keywords : "", "class='form-control'")?></td>
        <td><?php echo html::textarea("precondition[$key]", isset($case->precondition) ? htmlSpecialString($case->precondition) : "", "class='form-control'")?></td>
        <td class='col-content'>
          <?php if(isset($stepData[$key]['desc'])):?>
          <table class='w-p100 bd-0'>
          <?php foreach($stepData[$key]['desc'] as $id => $desc):?>
          <?php
            if(empty($desc['content'])) continue;
            $hideContentCol = false;
          ?>
            <tr class='step'>
              <td><?php echo $id . html::hidden("stepType[$key][$id]", $desc['type'])?></td>
              <td><?php echo html::textarea("desc[$key][$id]", htmlSpecialString($desc['content']), "class='form-control'")?></td>
              <td><?php if($desc['type'] != 'group') echo html::textarea("expect[$key][$id]", isset($stepData[$key]['expect'][$id]['content']) ? htmlSpecialString($stepData[$key]['expect'][$id]['content']) : '', "class='form-control'")?></td>
            </tr>
          <?php endforeach;?>
          </table>
          <?php endif;?>
        </td>
      </tr>
      <?php endforeach;?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='9' class='text-center form-actions'>
            <?php
            $submitText = $isEndPage ? $this->lang->save : $this->lang->file->saveAndNext;
            if(!$insert and $dataInsert === '')
            {
              echo "<button type='button' data-toggle='modal' data-target='#importNoticeModal' class='btn btn-primary btn-wide'>{$submitText}</button>";
            }
            else
            {
              echo html::submitButton($submitText);
              if($dataInsert !== '') echo html::hidden('insert', $dataInsert);
            }
            echo html::hidden('isEndPage', $isEndPage ? 1 : 0);
            echo html::hidden('pagerID', $pagerID);
            echo ' &nbsp; ' . html::a($this->createLink('caselib', 'browse', "libID=$libID"), $lang->goback, '', 'class="btn btn-wide"');
            echo ' &nbsp; ' . sprintf($lang->file->importPager, $allCount, $pagerID, $allPager);
            ?>
          </td>
        </tr>
      </tfoot>
    </table>
    <?php if(!$insert and $dataInsert === '') include '../../common/view/noticeimport.html.php';?>
  </form>
</div>
<?php endif;?>
<?php if(isset($hideContentCol) and $hideContentCol):?>
<style>#mainContent .col-content{display: none;}</style>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>

<?php
include dirname(__FILE__, 5) . '/test/lib/ui.php';
class createDocTester extends tester
{
    /**
     * 编辑文档。
     * Edit a draft.
     *
     * @param  string $editDocName
     * @access public
     * @return void
     */
    public function editDoc($docName, $editDocName)
    {
        /*进入我的空间下创建文档*/
        $this->openUrl('doc', 'myspace', array('objectType' => 'mine'));
        $form = $this->loadPage('doc', 'myspace', array('objectType' => 'mine'));
        $form->dom->createDocBtn->click();
        $form->wait(1);
        $form->dom->showTitle->setValue($docName->dcName);
        $form->dom->saveBtn->click();
        $form->wait(1);
        $form->dom->releaseBtn->click();

        /*编辑文档*/
        $this->openUrl('doc', 'mySpace', array('type' => 'mine'));
        $form = $this->loadPage('doc', 'mySpace', array('type' => 'mine'));
        $form->dom->fstEditBtn->click();
        $form->wait(1);
        $form->dom->title->setValue($editDocName->editName);
        $form->dom->saveDraftBtn->click();
        $form->wait(1);

        $this->openUrl('doc', 'mySpace', array('objectType' => 'mine'));
        $form = $this->loadPage('doc', 'mySpace', array('objectType' => 'mine'));
        $form->dom->search(array("文档标题,=,{$editDocName->editName}"));
        $form->wait(1);

        if($form->dom->fstDocName->getText() != $editDocName->editName) return $this->failed('文档编辑失败');
        $this->openUrl('doc', 'mySpace');
        return $this->success('文档编辑成功');
    }
}
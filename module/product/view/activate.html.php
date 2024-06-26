<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='prefix label-id'><strong><?php echo $product->id;?></strong></span>
      <?php echo isonlybody() ? ("<span title='$product->name'>" . $product->name . '</span>') : html::a($this->createLink('product', 'view', "productID=$product->id"), $product->name);?>
      <?php if(!isonlybody()):?>
      <small><?php echo $lang->arrow . $lang->product->close;?></small>
      <?php endif;?>
    </h2>
  </div>
  <form class='load-indicator main-form' method='post' target='hiddenwin'>
    <table class='table table-form'>
      <tr class='hide'>
        <th class='w-40px'><?php echo $lang->product->status;?></th>
        <td><?php echo html::hidden('status', 'normal');?></td>
      </tr>
      <?php $this->printExtendFields($product, 'table');?>
      <tr>
        <th class='w-40px'><?php echo $lang->comment;?></th>
        <td><?php echo html::textarea('comment', '', "rows='6' class='form-control kindeditor' hidefocus='true'");?></td>
      </tr>
      <tr>
        <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
        </td>
      </tr>
    </table>
  </form>
  <hr class='small' />
  <div class='main'>
    <?php include '../../common/view/action.html.php';?>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>

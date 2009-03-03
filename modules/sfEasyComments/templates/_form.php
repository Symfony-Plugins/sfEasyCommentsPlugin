<?php if (!$commentPosted): ?>
  <form action="<?php echo url_for('@sfEasyComments_form'); ?>" method="post" class="sfEasyCommentsForm" onsubmit="return sfEasyComments.processSubmit(this);">
    <?php
      echo $form->renderGlobalErrors();
      echo $form->renderHiddenFields();

      foreach ($form as $name => $field)
      {
        if (!$field->isHidden())
        {
          echo $field->renderError().$field->renderLabel().$field->render().'<br />';
        }
      }
    ?>
    <input type="submit" value="Post!" class="submit-button" />
  </form>
<?php endif; ?>

<?php if (count($placeholder['Items'])): ?>
  <ul class="sfEasyCommentsItemList">
    <?php foreach ($placeholder['Items'] as $item): ?>
      <li>
        <?php include_partial('sfEasyComments/item', array('item'=>$item)); ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

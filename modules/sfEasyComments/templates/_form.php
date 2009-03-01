<?php if (!$commentPosted): ?>
  <form action="<?php echo url_for('sfEasyComments/index'); ?>" method="post" class="sfEasyCommentsForm" onsubmit="return sfEasyComments.processSubmit(this);">
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

  <hr />

  <?php foreach ($placeholder['Items'] as $item): ?>
    <?php include_partial('sfEasyComments/item', array('item'=>$item)); ?>
  <?php endforeach; ?>

<?php endif; ?>

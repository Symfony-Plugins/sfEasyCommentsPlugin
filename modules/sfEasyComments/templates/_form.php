<?php if (!$commentPosted): ?>
  <form action="<?php echo url_for('sfEasyComments/index'); ?>" method="post" class="sfEasyCommentsForm" onsubmit="return sfEasyComments.processSubmit(this);">
    <?php
      echo $form->renderGlobalErrors();
      echo $form->renderHiddenFields();

      foreach ($form as $name => $field)
      {
        if (!$field->isHidden())
        {
          echo '<div>'.$field->renderError();
          echo $field->renderLabel();
          echo $field->render().'</div>';
        }
      }
    ?>
    <input type="submit" value="Post!" />
  </form>
<?php endif; ?>

<?php if (count($placeholder['Items'])): ?>

  <hr />

  <?php foreach ($placeholder['Items'] as $item): ?>
    <?php include_partial('sfEasyComments/item', array('item'=>$item)); ?>
  <?php endforeach; ?>

<?php endif; ?>

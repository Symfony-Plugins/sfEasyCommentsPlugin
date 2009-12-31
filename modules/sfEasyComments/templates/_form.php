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

<?php include_partial('sfEasyComments/items', array('items' => $placeholder['Items'])); ?>

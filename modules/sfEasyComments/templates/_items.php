<?php if (isset($items) && count($items)): ?>
  <ul class="sfEasyCommentsItemList">
    <?php foreach ($items as $item): ?>
      <li>
        <?php include_partial('sfEasyComments/item', array('item' => $item)); ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

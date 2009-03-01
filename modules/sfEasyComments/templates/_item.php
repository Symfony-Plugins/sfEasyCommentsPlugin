<div>
  <h4>
    <?php if ($item['author_website']): ?>
      <a href="<?php echo htmlentities($item['author_website']); ?>" rel="nofollow"><?php echo htmlentities($item['author_name']); ?></a>
    <?php else: ?>
      <?php echo htmlentities($item['author_name']); ?>
    <?php endif; ?>
    (<?php echo sfEasyCommentsHelper::render_interval(strtotime($item['created_at'])); ?>)
  </h4>

  <?php echo htmlentities(str_replace("\n", '<br />', $item['body'])); ?>
</div>

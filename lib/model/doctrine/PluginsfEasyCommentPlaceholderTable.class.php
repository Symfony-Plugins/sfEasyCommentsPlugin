<?php
/**
 * PluginsfEasyCommentPlaceholderTable
 *
 * @package
 * @version SVN: $Id$
 * @author  Romain Dorgueil <romain.dorgueil@symfony-project.com>
 */
class PluginsfEasyCommentPlaceholderTable extends Doctrine_Table
{
  /**
   * get - retrieve an existing placeholder or create one for the given context
   *
   * @param mixed $context
   * @return void
   */
  public function get($context)
  {
    $key = md5($context);

    $object = $this->findOneByKey($key);

    if (!$object)
    {
      $object = new sfEasyCommentPlaceholder();
      $object['key'] = $key;
      $object->save();
    }

    return $object;
  }
}

<?php
/**
 * PluginsfEasyCommentPlaceholderTable
 *
 * @package
 * @version SVN: $Id$
 * @author  Romain Dorgueil <romain.dorgueil@symfony-project.com>
 */
class PluginsfEasyCommentsPlaceholderTable extends Doctrine_Table
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

    $object = $this->createQuery('p')
      ->select('p.*, i.*')
      ->leftJoin('p.Items i')
      ->where('p.identifier_key = ?', array($key))
      ->execute()
      ->getFirst();

    if (!$object)
    {
      $object = new sfEasyCommentsPlaceholder();
      $object['identifier_key'] = $key;
      $object->save();
    }

    return $object;
  }
}

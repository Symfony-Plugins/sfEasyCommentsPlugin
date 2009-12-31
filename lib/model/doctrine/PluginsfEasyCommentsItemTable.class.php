<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginsfEasyCommentsItemTable extends Doctrine_Table
{
  /**
   * Returns $count last entries, without taking any placeholder criteria.
   *
   * @param  integer $count
   * @return Doctrine_Collection
   */
  public function getLatest($count)
  {
    return $this
      ->createQuery('items')
      ->orderBy('items.created_at desc')
      ->limit($count)
      ->execute();
  }
}

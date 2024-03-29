<?php

/**
 * sfEasyCommentsPlugin configuration.
 *
 * @package     sfEasyCommentsPlugin
 * @subpackage  config
 * @author      Romain Dorgueil <romain.dorgueil@symfony-project.com>
 * @version     SVN: $Id$
 */
class sfEasyCommentsPluginConfiguration extends sfPluginConfiguration
{
  static protected $DEPENDENCIES = array(
    'sfDoctrinePlugin' => 'database layer',
    'sfDynamicsPlugin' => 'assets management',
  );

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $enabledPlugins = $this->configuration->getPlugins();

    foreach (self::$DEPENDENCIES as $pluginName => $whatFor)
    {
      if (!in_array($pluginName, $enabledPlugins))
      {
        throw new sfConfigurationException(sprintf('You must install and enable plugin "%s" which provides %s.', $pluginName, $whatFor));
      }
    }

    /* required for symfony 1.1 compatibility */
    require dirname(__FILE__).'/config.php';
  }
}

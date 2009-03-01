<?php

class sfEasyCommentsRouting
{
  const PLUGIN_NAME = 'sfEasyCommentsPlugin';
  const ROUTE       = 'sfEasyComments';

  static protected $newStyleRoutes;

  static public function versionCheck()
  {
    list($sfVersionMajor, $sfVersionMinor, $sfVersionRelease) = explode('.', SYMFONY_VERSION);

    if (($sfVersionMajor!=1) || (!in_array($sfVersionMinor, array(1,2,3))))
    {
      throw new sfConfigurationException(self::PLUGIN_NAME.' needs symfony 1.1 to 1.3 to run.');
    }

    self::$newStyleRoutes = (bool)($sfVersionMinor>1);
  }

  static public function addRoute(sfRouting $r, $routeName, $routeUrl, $routeParameters)
  {
    if (self::$newStyleRoutes)
    {
      $r->prependRoute($routeName, new sfRoute($routeUrl, $routeParameters));
    }
    else
    {
      $r->prependRoute($routeName, $routeUrl, $routeParameters);
    }
  }

  static public function configure(sfEvent $event)
  {
    self::versionCheck();

    $routing = $event->getSubject();
    $prefix = sfConfig::get('app_sfEasyCommentsPlugin_base_route', '/easy_comments');

    self::addRoute($routing, self::ROUTE.'_form', $prefix, array('module'=>'sfEasyComments', 'action'=>'index'));
  }
}

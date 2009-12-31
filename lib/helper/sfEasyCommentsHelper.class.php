<?php

class sfEasyCommentsHelper
{
  /**
   * render_for - render the comments form and list for a given context.
   *
   * Context is what determines which comments set to show.
   *
   * @param  mixed $context
   * @return string
   */
  static public function render_for($context)
  {
    return get_component('sfEasyComments', 'index', array(
      'placeholder' => Doctrine::getTable('sfEasyCommentsPlaceholder')->get($context)
    ));
  }

  static public function render_latest($count=8)
  {
    return get_component('sfEasyComments', 'latest', array('count' => $count));
  }

  static public function render_interval($timestamp)
  {
    $ts_diff = time() - $timestamp;
    $unit = 'second';

    if ($ts_diff >= 60)
    {
      $ts_diff = round( $ts_diff / 60 );
      $unit = 'minute';
      if ($ts_diff >= 60)
      {
        $ts_diff = round( $ts_diff / 60 );
        $unit = 'hour';
        if ($ts_diff >= 24)
        {
          $ts_diff = round( $ts_diff / 24 );
          $unit = 'day';
          if ($ts_diff > 30)
          {
            $ts_diff = round( $ts_diff / 30 );
            $unit = 'month';
            if ($ts_diff >= 12)
            {
              $ts_diff = round( $ts_diff / 12 );
              $unit = 'year';
            }
          }
        }
      }
    }

    return $ts_diff . '&nbsp;' . $unit . (($ts_diff>1)?'s':''). ' ago';
  }
}

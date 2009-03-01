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
}

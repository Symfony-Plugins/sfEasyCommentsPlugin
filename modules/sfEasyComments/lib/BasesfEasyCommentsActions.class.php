<?php

/**
 * Base Actions for the sfEasyCommentsPlugin sfEasyComments module.
 *
 * @package     sfEasyCommentsPlugin
 * @subpackage  sfEasyComments
 * @author      Romain Dorgueil <romain.dorgueil@symfony-project.com>
 * @version     SVN: $Id$
 */
abstract class BasesfEasyCommentsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward404Unless($placeholder = Doctrine::getTable('sfEasyCommentsPlaceholder')->find($request->getParameter(sfEasyCommentsItemForm::QUERY_STRING_NAMESPACE.'[placeholder_id]')));

    return $this->renderComponent('sfEasyComments', 'form', array(
      'placeholder' => $placeholder,
    ));
  }
}

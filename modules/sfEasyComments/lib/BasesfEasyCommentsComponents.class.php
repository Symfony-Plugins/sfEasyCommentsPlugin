<?php

/**
 * Base Components for the sfEasyCommentsPlugin sfEasyComments module.
 *
 * @package     sfEasyCommentsPlugin
 * @subpackage  sfEasyComments
 * @author      Romain Dorgueil <romain.dorgueil@symfony-project.com>
 * @version     SVN: $Id$
 */
abstract class BasesfEasyCommentsComponents extends sfComponents
{
  public function executeIndex(sfWebRequest $request)
  {
    sfDynamics::load('sfEasyCommentsPlugin.main');

    $this->addRequiredMember('placeholder', 'sfEasyCommentsPlaceholder');
  }

  public function executeLatest(sfWebRequest $request)
  {
    sfDynamics::load('sfEasyCommentsPlugin.main');

    $this->addOptionalMember('count', 8);

    $this->items = Doctrine::getTable('sfEasyCommentsItem')->getLatest($this->count);
  }

  public function executeForm(sfWebRequest $request)
  {
    $this->addRequiredMember('placeholder', 'sfEasyCommentsPlaceholder');

    $this->form = new sfEasyCommentsItemForm(null, array('placeholder'=>$this->placeholder));
    $this->commentPosted = false;

    if ($request->isMethod('post') && is_array($formData=$request->getParameter(sfEasyCommentsItemForm::QUERY_STRING_NAMESPACE)))
    {
      $this->form->bind($formData);

      if ($this->form->isValid())
      {
        $this->form->save();
        $this->commentPosted = true;
      }
    }
  }

  /**
   * addRequiredMember - adds a required member to this component
   *
   * If $type is given, check member type.
   *
   * @param  string $memberName
   * @param  string $type
   * @return mixed
   */
  protected function addRequiredMember($memberName, $type=null)
  {
    if (!isset($this->$memberName))
    {
      throw new InvalidArgumentException(get_class($this).' needs a «'.$memberName.'» member.');
    }

    $this->assertMemberType($memberName, $type);

    return $this->$memberName;
  }

  /**
   * addOptionalMember - adds an optional member to this component, and set it to default if it's not present.
   *
   * @param   $memberName
   * @param mixed $default
   * @return void
   */
  protected function addOptionalMember($memberName, $default=null, $type=null)
  {
    if (!isset($this->$memberName))
    {
      $this->$memberName = $default;
    }

    $this->assertMemberType($memberName, $type);

    return $this->$memberName;
  }

  /**
   * assertMemberType - checks a member's type
   *
   * @throw InvalidArgumentException
   *
   * @param  string $memberName
   * @param  string $type
   * @return void
   */
  protected function assertMemberType($memberName, $type=null)
  {
    if (!is_null($type))
    {
      switch($type)
      {
        case 'array': case 'integer': case 'int': case 'string': case 'numeric':
          $function = 'is_'.$type;
          if (!$function($this->$memberName))
          {
            throw new InvalidArgumentException(sprintf('%s\'s «%s» member must be of «%s» type', get_class($this), $memberName, $type));
          }
          break;

        default:
          if (!$this->$memberName instanceof $type)
          {
            throw new InvalidArgumentException(sprintf('%s\'s «%s» member must be instance of «%s»', get_class($this), $memberName, $type));
          }
      }
    }
  }
}

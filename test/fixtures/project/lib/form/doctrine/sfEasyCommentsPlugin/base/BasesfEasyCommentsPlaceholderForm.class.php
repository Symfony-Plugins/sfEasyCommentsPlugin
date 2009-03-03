<?php

/**
 * sfEasyCommentsPlaceholder form base class.
 *
 * @package    form
 * @subpackage sf_easy_comments_placeholder
 * @version    SVN: $Id$
 */
class BasesfEasyCommentsPlaceholderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'identifier_key' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'sfEasyCommentsPlaceholder', 'column' => 'id', 'required' => false)),
      'identifier_key' => new sfValidatorString(array('max_length' => 32, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_easy_comments_placeholder[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfEasyCommentsPlaceholder';
  }

}
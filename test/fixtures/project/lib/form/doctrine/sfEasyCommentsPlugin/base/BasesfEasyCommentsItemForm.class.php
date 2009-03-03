<?php

/**
 * sfEasyCommentsItem form base class.
 *
 * @package    form
 * @subpackage sf_easy_comments_item
 * @version    SVN: $Id$
 */
class BasesfEasyCommentsItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'placeholder_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'sfEasyCommentsPlaceholder', 'add_empty' => true)),
      'parent_id'          => new sfWidgetFormInput(),
      'body'               => new sfWidgetFormTextarea(),
      'spam_value'         => new sfWidgetFormInput(),
      'author_name'        => new sfWidgetFormInput(),
      'author_email'       => new sfWidgetFormInput(),
      'author_website'     => new sfWidgetFormInput(),
      'author_notify_flag' => new sfWidgetFormInputCheckbox(),
      'validation_flag'    => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => 'sfEasyCommentsItem', 'column' => 'id', 'required' => false)),
      'placeholder_id'     => new sfValidatorDoctrineChoice(array('model' => 'sfEasyCommentsPlaceholder', 'required' => false)),
      'parent_id'          => new sfValidatorInteger(array('required' => false)),
      'body'               => new sfValidatorString(array('max_length' => 4096, 'required' => false)),
      'spam_value'         => new sfValidatorInteger(array('required' => false)),
      'author_name'        => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'author_email'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'author_website'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'author_notify_flag' => new sfValidatorBoolean(array('required' => false)),
      'validation_flag'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sf_easy_comments_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfEasyCommentsItem';
  }

}
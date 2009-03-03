<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * sfEasyCommentsPlaceholder filter form base class.
 *
 * @package    filters
 * @subpackage sfEasyCommentsPlaceholder *
 * @version    SVN: $Id$
 */
class BasesfEasyCommentsPlaceholderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'identifier_key' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'identifier_key' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_easy_comments_placeholder_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfEasyCommentsPlaceholder';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'identifier_key' => 'Text',
    );
  }
}
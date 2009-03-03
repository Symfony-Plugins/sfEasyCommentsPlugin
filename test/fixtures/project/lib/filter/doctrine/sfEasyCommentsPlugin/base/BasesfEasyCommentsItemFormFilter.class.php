<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * sfEasyCommentsItem filter form base class.
 *
 * @package    filters
 * @subpackage sfEasyCommentsItem *
 * @version    SVN: $Id$
 */
class BasesfEasyCommentsItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'placeholder_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'sfEasyCommentsPlaceholder', 'add_empty' => true)),
      'parent_id'          => new sfWidgetFormFilterInput(),
      'body'               => new sfWidgetFormFilterInput(),
      'spam_value'         => new sfWidgetFormFilterInput(),
      'author_name'        => new sfWidgetFormFilterInput(),
      'author_email'       => new sfWidgetFormFilterInput(),
      'author_website'     => new sfWidgetFormFilterInput(),
      'author_notify_flag' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'validation_flag'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'placeholder_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfEasyCommentsPlaceholder', 'column' => 'id')),
      'parent_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'body'               => new sfValidatorPass(array('required' => false)),
      'spam_value'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author_name'        => new sfValidatorPass(array('required' => false)),
      'author_email'       => new sfValidatorPass(array('required' => false)),
      'author_website'     => new sfValidatorPass(array('required' => false)),
      'author_notify_flag' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'validation_flag'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_easy_comments_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfEasyCommentsItem';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'placeholder_id'     => 'ForeignKey',
      'parent_id'          => 'Number',
      'body'               => 'Text',
      'spam_value'         => 'Number',
      'author_name'        => 'Text',
      'author_email'       => 'Text',
      'author_website'     => 'Text',
      'author_notify_flag' => 'Boolean',
      'validation_flag'    => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
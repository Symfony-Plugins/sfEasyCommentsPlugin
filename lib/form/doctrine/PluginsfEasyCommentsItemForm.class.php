<?php

/**
 * PluginsfEasyCommentsItem form.
 *
 * @package    form
 * @subpackage sfEasyCommentsItem
 * @version    SVN: $Id$
 */
abstract class PluginsfEasyCommentsItemForm extends BasesfEasyCommentsItemForm
{
  const QUERY_STRING_NAMESPACE = 'comment';

  public function setup()
  {
    $this->addRequiredOption('placeholder');

    parent::setup();

    unset($this['spam_value'], $this['validation_flag'], $this['created_at'], $this['updated_at']);

    /* @TODO not yet implemented */
    unset($this['author_notify_flag']);

    /* invisible fields */
    $this->widgetSchema['placeholder_id']    = new sfWidgetFormInputHidden();
    $this->widgetSchema['parent_id']         = new sfWidgetFormInputHidden();
    $this->validatorSchema['placeholder_id'] = new sfValidatorDoctrineChoice(array('model' => 'sfEasyCommentsPlaceholder', 'required' => true));
    $this->validatorSchema['parent_id']      = new sfValidatorDoctrineChoice(array('model' => 'sfEasyCommentsItem', 'required' => false));

    /* visible */
    $this->validatorSchema['body'] = new sfValidatorString(
      array(
        'min_length' => 16,
        'max_length' => 4096,
        'required'   => true,
      ),
      array(
        'min_length' => 'Your comment is too short. Please take some time to write a meaningful message.',
        'max_length' => 'You\'re for sure a talkative people. Can\'t you sum it up a bit?',
        'required'   => 'Please enter a comment message.',
      )
    );
    $this->validatorSchema['author_name']    = new sfValidatorString(
      array(
        'max_length' => 64,
        'required' => true
      ),
      array(
        'max_length' => 'Your name is too long.',
        'required'   => 'You must enter a name or nickname to post a comment.',
      )
    );
    $this->validatorSchema['author_email'] = new sfValidatorEmail(
      array(
        'max_length' => 128,
        'required'   => true
      ),
      array(
        'max_length' => 'My database will never handle a so long e-mail address...',
        'required' => 'Please enter an email adress. We won\'t show it, nor send anything you did not ask for. This helps us excluding spammers and allows to send answer notification if you asked for it.',
        'invalid'  => 'Invalid e-mail address.'
      )
    );
    $this->validatorSchema['author_website'] = new sfValidatorUrl(
      array(
        'max_length' => 128,
        'required' => false
      ),
      array(
        'max_length' => 'Your URL is too long.',
        'invalid'  => 'Invalid URL.'
      )
    );

    $this->widgetSchema->moveField('body', sfWidgetFormSchema::LAST);

    $this->widgetSchema->setLabels(array(
      'author_name'        => 'Your name: *',
      'author_email'       => 'Your e-mail (not shown): *',
      'author_website'     => 'Your website:',
      'author_notify_flag' => 'Check this if you want to receive a mail when your comment gets an answer.',
      'body'               => 'Your comment:',
    ));

    $this->widgetSchema->setNameFormat(self::QUERY_STRING_NAMESPACE.'[%s]');

    $this->setDefault('placeholder_id', $this->placeholder);
  }

  protected function addOption($optionName, $default=null, $varName=null)
  {
    if (is_null($varName))
    {
      $varName = $optionName;
    }

    $this->$varName = $this->getOption($optionName, $default);
  }

  protected function addRequiredOption($optionName, $className=null, $varName=null)
  {
    if (is_null($varName))
    {
      $varName = $optionName;
    }

    if (!($this->$varName=$this->getOption($optionName)))
    {
      throw new InvalidArgumentException(sprintf('%s needs a «%s» option.', get_class($this), $optionName));
    }

    if (!(is_null($className) || $this->$varName instanceof $className))
    {
      throw new InvalidArgumentException(get_class($this).' required option «'.$optionName.'» must be an instance of «'.$className.'».');
    }
  }
}

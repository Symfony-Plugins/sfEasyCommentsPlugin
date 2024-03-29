<?php

/**
 * BasesfEasyCommentsItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $placeholder_id
 * @property integer $parent_id
 * @property string $body
 * @property integer $spam_value
 * @property string $author_name
 * @property string $author_email
 * @property string $author_website
 * @property boolean $author_notify_flag
 * @property boolean $validation_flag
 * @property sfEasyCommentsPlaceholder $Placeholder
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id$
 */
abstract class BasesfEasyCommentsItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_easy_comments_item');
        $this->hasColumn('placeholder_id', 'integer', null, array('type' => 'integer'));
        $this->hasColumn('parent_id', 'integer', null, array('type' => 'integer'));
        $this->hasColumn('body', 'string', 4096, array('type' => 'string', 'length' => '4096'));
        $this->hasColumn('spam_value', 'integer', null, array('type' => 'integer'));
        $this->hasColumn('author_name', 'string', 64, array('type' => 'string', 'length' => '64'));
        $this->hasColumn('author_email', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('author_website', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('author_notify_flag', 'boolean', null, array('type' => 'boolean'));
        $this->hasColumn('validation_flag', 'boolean', null, array('type' => 'boolean'));
    }

    public function setUp()
    {
        $this->hasOne('sfEasyCommentsPlaceholder as Placeholder', array('local' => 'placeholder_id',
                                                                        'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}
<?php

include dirname(__FILE__).'/../bootstrap/functional.php';

$browser = new sfTestFunctional(new sfBrowser());
$test = $browser->test();

$formData = new testFormData();

$browser
  ->get('/example')
  ->with('response')->begin()
    ->isStatusCode(200)
    ->checkElement('div.sfEasyCommentsFormContainer form.sfEasyCommentsForm', true)
  ->end()

  ->setField('comment[author_name]', $formData->getAuthorName())
  ->setField('comment[author_email]', $formData->getAuthorEmail())
  ->setField('comment[author_website]', $formData->getAuthorWebsite())
  ->setField('comment[body]', $formData->getBody())

  ->click('Post!')
;

$newItem = Doctrine::getTable('sfEasyCommentsItem')->createQuery('i')->orderBy('i.created_at desc')->fetchOne();

$test->is($newItem['author_name'], $formData->getAuthorName(), 'newly inserted item contains author name.');
$test->is($newItem['author_email'], $formData->getAuthorEmail(), 'newly inserted item contains author email.');
$test->is($newItem['author_website'], $formData->getAuthorWebsite(), 'newly inserted item contains author website.');
$test->is($newItem['body'], $formData->getBody(), 'newly inserted item contains comment body.');

$placeholder = $newItem['Placeholder'];
$itemCount = count($placeholder['Items']);

$browser
  ->with('response')->begin()
    ->isStatusCode(200)
    ->checkElement('div.sfEasyCommentsFormContainer form.sfEasyCommentsForm', false)
    ->checkElement('ul.sfEasyCommentsItemList li', $itemCount)
  ->end()
;

class testFormData
{
  protected
    $author_name,
    $author_email,
    $author_website,
    $body;

  public function __construct()
  {
    $this->author_name    = $this->generateRandomString(rand(10, 20));
    $this->author_email   = $this->generateRandomString(rand(5, 10)).'@example.com';
    $this->author_website = 'http://'.$this->generateRandomString(rand(5, 10)).'.example.com/';

    $this->body = '';
    for($words=rand(10,20),$i=0; $i<$words; $i++)
    {
      $this->body .= (isset($this->body[0])?' ':'').$this->generateRandomString(rand(2, 15));
    }
  }

  public function getAuthorName()
  {
    return $this->author_name;
  }

  public function getAuthorEmail()
  {
    return $this->author_email;
  }

  public function getAuthorWebsite()
  {
    return $this->author_website;
  }

  public function getBody()
  {
    return $this->body;
  }

  protected function generateRandomString($length)
  {
    $str = '';

    for ($i=0; $i<$length; $i++)
    {
      $str .= chr(ord('a')+rand(0,25));
    }

    return $str;
  }
}

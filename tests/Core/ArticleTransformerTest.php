<?php  namespace Test\Core;

use Test\Transformers\ArticleTransformer;

class ArticleTransformerTest extends \PHPUnit_Framework_TestCase
{

	private $uow;

	public function setup()
	{
		$this->uow = new ArticleTransformer();
	}

	public function test_transformer_shouldHaveIdentifier()
	{
		$identifier = $this->uow->toIdentifier();
		$this->assertArrayHasKey( 'id', $identifier );
		$this->assertArrayHasKey( 'type', $identifier );
	}




}
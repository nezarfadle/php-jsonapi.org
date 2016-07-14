<?php  namespace Test\Core;

use Test\Transformers\ArticleTransformer;

class ArticleTransformerTest extends \PHPUnit_Framework_TestCase
{

	private $uow;

	public function setup()
	{
		$this->uow = new ArticleTransformer();
	}

	public function test_ShouldBeTransformedToResourceIdentifier()
	{
		$identifier = $this->uow->toIdentifier();

		$this->assertArrayHasKey( 'id', $identifier );
		$this->assertEquals( '123ABC', $identifier['id'] );

		$this->assertArrayHasKey( 'type', $identifier );
		$this->assertEquals( 'articles', $identifier['type'] );
	}

	public function test_ShouldBeTransformedToResourceObject()
	{
		$resource = $this->uow->toResource();
		$this->assertArrayHasKey( 'id', $resource );
		$this->assertArrayHasKey( 'type', $resource );
		$this->assertArrayHasKey( 'attributes', $resource );
		$this->assertArrayHasKey( 'links', $resource );
		$this->assertArrayHasKey( 'meta', $resource );
		$this->assertArrayHasKey( 'relationships', $resource );

	}





}
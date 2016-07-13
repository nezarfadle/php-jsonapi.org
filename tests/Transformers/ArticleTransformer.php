<?php namespace Test\Transformers;

use JsonApi\Core\BaseTransformer;

class ArticleTransformer extends BaseTransformer
{

	public function __construct()
	{
		parent::__construct('http://fake.com');
	}
	
	public function getId()
	{
		return "123ABC";
	}

	public function getType()
	{
		return "articles";
	}

	public function getAttributes()
	{
		return [
			'title' => 'fake title',
			'content' => 'fake content'
		];
	}

}
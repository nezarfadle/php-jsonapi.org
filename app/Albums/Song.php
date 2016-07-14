<?php namespace App\Albums;

class Song
{
	private $id, $title, $album;

	public function __construct( $id, $title, Album $album )
	{
		$this->id = $id;
		$this->title = $title;
		$this->album = $album;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}
	
	public function getAlbum()
	{
		return $this->album;
	}
}
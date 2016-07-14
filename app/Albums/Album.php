<?php namespace App\Albums;

class Album
{
	private $id, $title, $artist, $songs = [];

	public function __construct( $id, $title, Artist $artist )
	{
		$this->id = $id;
		$this->title = $title;
		$this->artist = $artist;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getArtist()
	{
		return $this->artist;
	}

	public function getSongs()
	{
		return $songs;
	}
	
}
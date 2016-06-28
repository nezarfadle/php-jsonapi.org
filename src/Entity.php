<?php namespace JsonApi;

interface Entity
{
	public function getId();
	public function getType();
	public function getIdentity();
	public function getAttributes();
	public function toRaw();	
}
<?php
// use \Users\Ivan\Documents\WebSide\myWebSide\app\libs\Google\Client;


class AboutController extends BaseController 
{
	public function index()
	{
		return View::make( 'about/main', $this->getData() );
	}
}

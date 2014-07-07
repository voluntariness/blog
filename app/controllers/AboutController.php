<?php
// use \Users\Ivan\Documents\WebSide\myWebSide\app\libs\Google\Client;


class AboutController extends BaseController 
{
	public function index()
	{
        ($row = Page::where('key', 'About')->first()) or $row = new Page;
        $this->setData('row', $row );
		return View::make( 'about/main', $this->getData() );
	}
}

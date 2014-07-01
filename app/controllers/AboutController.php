<?php

class AboutController extends BaseController 
{
	public function index()
	{
		return View::make( 'about/main', $this->getData() );
	}
}
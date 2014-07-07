<?php

class LinkController extends BaseController 
{
    public function index () 
    {
        ($row = Page::where('key', 'Link')->first()) or $row = new Page;
        $this->setData('row', $row );
        return View::make('link/main', $this->getData() );
    }
}

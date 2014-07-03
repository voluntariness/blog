<?php

class LinkController extends BaseController 
{
    public function index () 
    {
        $this->setData('list', []);
        return View::make('link/list', $this->getData() );
    }
}

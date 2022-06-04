<?php

class WrongPage extends Controller
{
    public function index()
    {
        $this->view('404error');
    }
}

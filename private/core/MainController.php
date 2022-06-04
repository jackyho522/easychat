<?php

class Controller
{
    public function model($model)
    {
        require_once '../private/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists('../private/views/' . $view . '.view.php')) {
            require_once '../private/views/' . $view . '.view.php';
        }
    }
}

<?php

Namespace App\controllers;

abstract class Controller {
    public function renderPhpView($view, $array=[]) {
        $templateDir = "src/views/";
        extract($array);
        include $templateDir . $view;
    }
}
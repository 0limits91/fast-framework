<?php
namespace controllers;

class example
{
    public function info($req, $res)
    {
        $res->render('info', ['title' => 'Info page']);
    }

    public function home($req, $res)
    {
        $res->render('home', ['title' => 'Home page']);
    }
}
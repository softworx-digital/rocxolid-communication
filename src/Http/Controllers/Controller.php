<?php

namespace Softworx\RocXolid\Communication\Http\Controllers;

use Softworx\RocXolid\Communication\Components\Dashboard\Main as MainDashboard;

class Controller extends AbstractController
{
    public function index()
    {
        return (new MainDashboard($this))->render();
    }
}
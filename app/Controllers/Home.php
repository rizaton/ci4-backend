<?php

namespace App\Controllers;

use App\Models\Users;

class Home extends BaseController
{
    public function index()
    {
        $model = new Users();
        dd($model->findAll());
    }
}

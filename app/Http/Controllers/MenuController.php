<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Get simple menu for example
     */
    public function index()
    {
        return [
            'title' => 'Справочник',
            'items' => [
                ['url' => false, 'action' => 'create', 'title' => '+ Добавить запись'],
                ['url' => route('logout'), 'title' => 'Выход'],
            ]

        ];
    }
}

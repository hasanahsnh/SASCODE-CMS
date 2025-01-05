<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;

class UserController extends Controller
{
    protected $database;
    protected $refTableName;
    protected $storage;
    public function __construct(Database $database) {
        $this->database = $database;
        $this->refTableName = 'users';
    }

    function getActiverUser() {
        $users = $this->database->getReference($this->refTableName)->getValue();
        $activeUsers = array_filter($users, function ($users) {
            return isset($users['statusLogin']) && $users['statusLogin'] === 'active';
        });

        return count($activeUsers);
    }

    function index() {
        return view('pengunjung.pages.index');
    }
}

<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;
use PasswordLib\PasswordLib;

class LoginController extends Controller
{
    protected $database;
    protected $refTableName;

    public function __construct(Database $database) {
        $this->database = $database;
        $this->refTableName = 'users';
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $users = $this->database->getReference($this->refTableName)->getValue();

        if ($users) {
            foreach ($users as $key => $user) {
                if (isset($user['username']) && $user['username'] === $username) {
                    if (password_verify($password, $user['password']) && $user['role'] === 'admin') {
                        session(['admin' => $user]);

                        return redirect('/home')->with('success', 'Login successful.');
                    }
                }
            }
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials or unauthorized access.']);
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}

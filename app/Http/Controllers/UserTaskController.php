<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'USR')->get();
        return view('admin.user-list', compact('users'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function create()
    {
        $roles = Role::ROLES;

        return view('users.create', compact('roles'));
    }

    public function index()
    {
        $query = User::select();

        $nameSort = request('name');
        $emailSort = request('email');

        if ($nameSort) {
            if ($nameSort === 'asc') {
                $query->orderBy('name');
            } else {
                $query->orderByDesc('name');
            }
        }

        if ($emailSort) {
            if ($emailSort === 'asc') {
                $query->orderBy('email');
            } else {
                $query->orderByDesc('email');
            }
        }

        $users = $query->get();

        return view('users.index', compact('users'));
    }

    public function store()
    {
        $data = request()->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users',
           'roles' => [
               'required',
               'array',
               Rule::in(array_keys(Role::ROLES))
           ]
        ]);

        $user = User::create($data);

        foreach (request('roles') as $role) {
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => $role,
            ]);
        }

        return redirect()->route('users');
    }
}

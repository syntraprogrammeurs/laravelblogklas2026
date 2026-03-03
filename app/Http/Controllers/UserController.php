<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserIndexRequest $request)
    {
        $filters = $request->defaults();

        $users = User::query()
            ->with('role')
            ->search($filters['q'])
            ->roleFilter($filters['role'])
            ->statusFilter($filters['status'])
            ->verifiedFilter($filters['verified'])
            ->sortBySafe($filters['sort'], $filters['dir'])
            ->paginate($filters['per_page'])
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('backend.users.index', [
            'users' => $users,
            'roles' => $roles,
            'filters' => $filters,
            'perPageAllowed' => [10, 25, 50, 100],
        ]);
    }
}

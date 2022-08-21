<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;

class UserRepository
{
    public function store($userData)
    {
        $data =$userData->validated();
        $data['password'] = bcrypt($userData->password); 
        $data['random_key'] = Str::random(60); 
        return User::create($data);
    }

    public function showUser($request)
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC');

        if (!empty($request->qu)) 
            $users =  $users->where('email', 'LIKE', '%' . $request->qu . '%');
        $users = $users->paginate(5, ['*'], 'users');
        $users->appends($request->all());
        return $users;
    }

    public function showCustomer($request)
    {
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC');
        if (!empty($request->qc))
            $customers = $customers->where('email', 'LIKE', '%' . $request->qc . '%');
        $customers = $customers->Paginate(5, ['*'], 'customers');
        $customers->appends($request->all());
        return $customers;
    }
}

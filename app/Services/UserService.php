<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function storeUser($validated)
    {
        $user = User::create([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'password' => Hash::make($validated['password'])
        ]);

	    $user->syncRoles($validated['roles']);
    }

    public function updateUser($validated, $user)
    {
        $data = [
            'name' => $validated['name'],
        ];
    
        if(!empty($request->password)){
            $data += ['password' => Hash::make($validated['password'])];
        }
    
        $user->update($data);
        $user->syncRoles($validated['roles']);
    }
}

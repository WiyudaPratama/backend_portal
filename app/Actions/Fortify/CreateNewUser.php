<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\AuthorStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'no_hp' => ['required', 'string', 'max:13'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'no_hp' => $input['no_hp'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profil' => 'profile-200x200.png',
            'role' => 'Author',
        ]);

        AuthorStatus::create([
            'status' => 'Pending',
            'user_id' => $user->id,
        ]);

        return $user;

    }
}

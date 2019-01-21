<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Source
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'nada_users';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'nada_user_roles');
    }

    public function validate()
    {
        request()->validate($this->rules());
    }

    public function rules()
    {
        return [
            'id' => 'exists:nada_users',
            'name' => 'required',
            'email' => 'required|unique:nada_users,email' . ($this->id ? "," . $this->id : ''),
        ];
    }

    public function fetchSave(array $data = [])
    {
        $data = array_merge(request(['avatar', 'name', 'email', 'password']), $data);
        $this->name = $data['name'];
        $this->email = $data['email'];
        if (isset($data['avatar'])) {
            $this->avatar = $data['avatar'];
        }
        if (isset($data['password'])) {
            $this->password = bcrypt($data['password']);
        }
        $this->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    protected $primaryKey = "user_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', "last_name", 'email', "date_of_birth", 'password',
        "gender", "cell_phone", "identity_rg", "identity_em_dt",
        "identity_issuing_authority", "cpf", "user_name", "cep_user",
        "level", "num_residence", "complement_residence"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserLocality()
    {
        return $this->hasOne(\App\Models\Locality::class, 'cep', 'cep_user');
    }

    public function UserContacts()
    {
        return $this->hasMany(\App\Models\Contact::class, 'user_id', 'user_id');
    }
}

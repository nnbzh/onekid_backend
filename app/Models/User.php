<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'username',
        'password',
        'last_name',
        'is_verified',
        'email',
        'parent_id',
        'gender',
        'birth_date',
        'avatar_url',
        'first_name',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function findForPassport($username) {
        return User::query()->where('username', $username)->first();
    }

    public function children() {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function isParent(): bool
    {
        return $this->parent()->doesntExist();
    }

    public function entities() {
        return $this->belongsToMany(ClassEntity::class, 'class_entries');
    }
}

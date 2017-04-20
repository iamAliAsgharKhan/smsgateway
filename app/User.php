<?php

namespace App;

use App\Role;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'created_diff'
    ];

    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function assign($role)
    {
        if (is_string($role)) {
            $role = Role::firstOrCreate([
                'name' => $role
            ]);
        }

        return $this->roles()->attach($role);
    }

    public function revoke($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->first();
        }

        return $this->roles()->detach($role);
    }

    public function has($role)
    {
        foreach ($this->roles as $assignedRole) {
            return $assignedRole->name == $role;
        }

        return false;
    }
}

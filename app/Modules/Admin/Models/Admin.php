<?php

namespace App\Modules\Admin\Models;

use App\Modules\Common\Support\PermissionPoliciesTrait;
use App\Modules\Common\Support\PermissionsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles, PermissionPoliciesTrait, PermissionsTrait;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstRoleAttribute()
    {
        return !empty($this->roles[0]) ? $this->roles[0] : (new Role());
    }
}

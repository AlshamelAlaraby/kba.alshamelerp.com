<?php

namespace App\Modules\Role;

use App\Modules\Common\Support\BaseLibrary;
use App\Modules\Role\Repositories\RoleRepository;

class RoleLibrary extends BaseLibrary
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        parent::__construct($roleRepository);
    }

    public function create($data)
    {
        $role = parent::create(['name' => $data['name']]);
        if(array_key_exists('permissions', $data)) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
    }

    public function update($id, $data)
    {
        $role = parent::find($id);
        parent::update($id, ['name' => $data['name']]);
        if(array_key_exists('permissions', $data)) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
    }
}

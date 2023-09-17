<?php

namespace App\Modules\Admin;

use App\Modules\Admin\Repositories\AdminRepository;
use App\Modules\Common\Support\BaseLibrary;

class AdminLibrary extends BaseLibrary
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        parent::__construct($adminRepository);
    }

    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = parent::create($data);
        if(isset($data['role'])){
            $user->syncRoles($data['role']);
        }
        return $user;
    }

    public function update($id, $data)
    {
        $user = parent::find($id);
        $role = $data['role'];
        unset($data['role']);
        $data['password'] = isset($data['password'])?bcrypt($data['password']):$user->password;
        if(isset($data['role'])){
            $user->syncRoles($role);
        }
        return parent::update($id,$data);
    }
}

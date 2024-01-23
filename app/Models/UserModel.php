<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            'lastname'
        ];
    }

    public function getUser($id = false)
    {
        if ($id === false) {
            return null;
        }

        return $this->where(['id' => $id])->first();

    }
}

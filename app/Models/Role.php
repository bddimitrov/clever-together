<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    public const ADMIN_ROLE = 1;
    public const USER_ROLE = 2;
    public const COMPANY_ROLE = 3;
    public const DELIVERY_ROLE = 4;

    public const ROLES = [
      self::ADMIN_ROLE => 'admin',
      self::USER_ROLE => 'user',
      self::COMPANY_ROLE => 'company',
      self::DELIVERY_ROLE => 'delivery',
    ];
}

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserRoleEnum extends Enum
{
    const ADMIN = 0;
    const APPLICANT = 1;
    const HR = 2;
}

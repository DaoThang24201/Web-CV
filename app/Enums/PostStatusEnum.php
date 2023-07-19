<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PostStatusEnum extends Enum
{
    const PENDING = 0;
    const ADMIN_PENDING = 1;
    const ADMIN_APPROVED = 2;
}

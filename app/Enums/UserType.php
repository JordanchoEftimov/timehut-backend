<?php

namespace App\Enums;

enum UserType: int
{
    case ADMIN = 1;
    case COMPANY = 2;
    case EMPLOYEE = 3;
}

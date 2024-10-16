<?php

namespace App\Enum;

enum ApiScope: string
{
    case GAME_CREATE = 'ROLE_GAME_CREATE';
    case GAME_READ = 'ROLE_GAME_READ';
    case GAME_UPDATE = 'ROLE_GAME_UPDATE';
    case GAME_DELETE = 'ROLE_GAME_DELETE';
}

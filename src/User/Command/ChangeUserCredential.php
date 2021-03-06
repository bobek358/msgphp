<?php

declare(strict_types=1);

namespace MsgPhp\User\Command;

use MsgPhp\User\UserId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class ChangeUserCredential
{
    public $userId;
    public $fields;

    public function __construct(UserId $userId, array $fields)
    {
        $this->userId = $userId;
        $this->fields = $fields;
    }
}

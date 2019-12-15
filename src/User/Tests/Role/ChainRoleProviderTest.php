<?php

declare(strict_types=1);

namespace MsgPhp\User\Tests\Role;

use MsgPhp\User\Role\ChainRoleProvider;
use MsgPhp\User\Role\RoleProvider;
use MsgPhp\User\User;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ChainRoleProviderTest extends TestCase
{
    public function testRoles(): void
    {
        $user = $this->createMock(User::class);
        $first = $this->createMock(RoleProvider::class);
        $first->expects(self::once())
            ->method('getRoles')
            ->with($user)
            ->willReturn(['ROLE_USER', 'ROLE_ADMIN'])
        ;
        $second = $this->createMock(RoleProvider::class);
        $second->expects(self::once())
            ->method('getRoles')
            ->with($user)
            ->willReturn(['ROLE_ADMIN', 'foo' => 'super admin'])
        ;

        self::assertSame(['ROLE_USER', 'ROLE_ADMIN', 'super admin'], (new ChainRoleProvider([$first, $second]))->getRoles($user));
    }
}

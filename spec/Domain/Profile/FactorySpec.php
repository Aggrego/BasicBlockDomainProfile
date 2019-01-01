<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace spec\Aggrego\BasicBlockDomainProfile\Domain\Profile;

use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_should_factory_profile(): void
    {
        $this->factory('1.0')->shouldBeAnInstanceOf(Profile::class);
    }
}

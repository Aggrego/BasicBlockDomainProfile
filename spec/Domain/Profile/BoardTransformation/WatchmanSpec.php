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

namespace spec\Aggrego\BasicBlockDomainProfile\Domain\Profile\BoardTransformation;

use Aggrego\BasicBlockDomainProfile\Domain\Profile\BoardTransformation\Watchman;
use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\Domain\Profile\BoardTransformation\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class WatchmanSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Watchman::class);
        $this->shouldBeAnInstanceOf(DomainWatchman::class);
    }

    function it_should_check_profile(): void
    {
        $this->isSupported(Factory::factory('1.0'))->shouldBe(true);
    }

    function it_should_reject_another_profile(): void
    {
        $this->isSupported(Profile::createFromName('unknown:1.0'))->shouldBe(false);
    }
}

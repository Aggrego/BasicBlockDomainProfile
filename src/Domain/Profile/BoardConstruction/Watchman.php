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

namespace Aggrego\BasicBlockDomainProfile\Domain\Profile\BoardConstruction;

use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Assert\InvalidArgumentException;

class Watchman implements DomainWatchman
{
    public function isSupported(Profile $profile): bool
    {
        try {
            Assertion::regex($profile->getVersion(), '~^([0-9]+\.{0,1})+$~');
        } catch (InvalidArgumentException $e) {
            return false;
        }
        return $profile->getName() === Factory::PROFILE_NAME;
    }

    public function passBuilder(Profile $profile): DomainBuilder
    {
        return new Builder(Factory::factory($profile->getVersion()));
    }
}

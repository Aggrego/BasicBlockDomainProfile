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

namespace Aggrego\BasicBlockDomainProfile\Domain\Profile\BoardTransformation;

use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\Domain\Profile\BoardTransformation\Transformation as DomainTransformation;
use Aggrego\Domain\Profile\BoardTransformation\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;

class Watchman implements DomainWatchman
{
    public function isSupported(Profile $profile): bool
    {
        return $profile->getName() === Factory::PROFILE_NAME;
    }

    public function passTransformation(Profile $profile): DomainTransformation
    {
        return new Transformation();
    }
}

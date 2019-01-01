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

namespace Aggrego\BasicBlockDomainProfile\Domain\Profile;

use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Composer\Semver\VersionParser;

class Factory
{
    public const PROFILE_NAME = 'basic_block';

    static public function factory(string $version): Profile
    {
        Assertion::regex($version, '~^([0-9]+\.{0,1})+$~');
        $normalized = (new VersionParser())->normalize($version);
        return Profile::createFromParts(self::PROFILE_NAME, $normalized);
    }
}

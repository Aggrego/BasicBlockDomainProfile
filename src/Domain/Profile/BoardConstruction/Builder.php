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

use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Prototype\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Exception;

class Builder implements DomainBuilder
{
    private const KEY_NAME = 'name';
    private const KEY_VALUE = 'value';

    /** @var Profile */
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param Key $key
     * @return BoardPrototype
     * @throws UnableToBuildBoardException
     */
    public function build(Key $key): BoardPrototype
    {
        $keyValue = $key->getValue();
        try {
            Assertion::keyExists($keyValue, self::KEY_NAME);
            Assertion::keyExists($keyValue, self::KEY_VALUE);
        } catch (Exception $e) {
            throw new UnableToBuildBoardException('Unable to create board due to: ' . $e->getMessage(), 0, $e);
        }

        return new Board(
            new Key(['name' => $keyValue[self::KEY_NAME]]),
            $this->profile,
            new Data($keyValue[self::KEY_VALUE])
        );
    }
}

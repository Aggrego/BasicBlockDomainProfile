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

use Aggrego\BasicBlockDomainProfile\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\DataBoard\Board\Board;
use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Metadata;
use Aggrego\DataBoard\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\Profile\BoardTransformation\Transformation as DomainTransformation;
use PhpSpec\ObjectBehavior;

class TransformationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Transformation::class);
        $this->shouldBeAnInstanceOf(DomainTransformation::class);
    }

    function it_should_build_data_prototype()
    {
        $key = new Key(['name' => 'test2', 'value' => 'new_test_value']);
        $board = new Board(
            new Uuid('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'),
            new Key(['name' => 'test']),
            Factory::factory('1.0'),
            new Metadata(new Data('test_value')),
            null
        );
        $this->transform($key, $board)->shouldBeAnInstanceOf(BoardPrototype::class);
    }

    function it_should_throw_exception_with_invalid_key_value()
    {
        $key = new Key([]);
        $board = new Board(
            new Uuid('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'),
            new Key(['name' => 'test']),
            Factory::factory('1.0'),
            new Metadata(new Data('test_value')),
            null
        );
        $unableToBuildBoardException = new UnprocessableBoardException('Unable to process board due to: Array does not contain an element with key "value"');
        $this->shouldThrow($unableToBuildBoardException)
            ->during('transform', [$key, $board]);
    }
}

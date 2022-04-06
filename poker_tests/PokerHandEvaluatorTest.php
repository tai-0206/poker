<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerCard;
use Poker\PokerHandEvaluator;
use Poker\PokerTwoCardRule;
use Poker\PokerThreeCardRule;

require_once(__DIR__ . '/../../lib/poker/PokerHandEvaluator.php');

class PokerHandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        // カードが2枚の場合
        $handEvaluator = new PokerHandEvaluator(new PokerTwoCardRule());
        $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('SK')]));

        // カードが3枚の場合
        $handEvaluator = new PokerHandEvaluator(new PokerThreeCardRule());
        $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('S2'), new PokerCard('C3')]));
    }
}

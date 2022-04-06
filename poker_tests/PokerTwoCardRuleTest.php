<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerCard;
use Poker\PokerTwoCardRule;

require_once(__DIR__ . '/../../lib/poker/PokerTwoCardRule.php');

class PokerTwoCardRuleTest extends TestCase
{
    public function testGetHand()
    {
        $rule = new PokerTwoCardRule();
        $this->assertSame(['name' => 'high card','rank' => 1, 'primary' => 6, 'secondary' => 4], $rule->getHand([new PokerCard('H5'), new PokerCard('C7')]));
        // $this->assertSame('pair', $rule->getHand([new PokerCard('H10'), new PokerCard('C10')]));
        // $this->assertSame('straight', $rule->getHand([new PokerCard('DA'), new PokerCard('S2')]));
        // $this->assertSame('straight', $rule->getHand([new PokerCard('DA'), new PokerCard('SK')]));
    }
}

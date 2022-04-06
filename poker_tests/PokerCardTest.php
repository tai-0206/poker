<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerCardTest extends TestCase
{
    public function testGetRank()
    {
        $card = new PokerCard('C10');
        $this->assertSame(9, $card->getRank());
    }
}

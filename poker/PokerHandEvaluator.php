<?php

namespace Poker;

require_once('PokerCard.php');
require_once('PokerRule.php');

class PokerHandEvaluator
{
    public function __construct(private PokerRule $rule)
    {
    }

    public function getHand(array $pokerCards): array
    {
        return $this->rule->getHand($pokerCards);
    }

    public function getWinner(array $hands): int
    {
        return $this->rule->getWinner($hands[0], $hands[1]);
    }
}

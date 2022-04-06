<?php

namespace Poker;

interface PokerRule
{
    public function getHand(array $cards);
    public function getWinner(array $hand1, array $hand2);
}

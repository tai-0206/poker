<?php

namespace Poker;

require_once('PokerCard.php');
require_once('PokerRule.php');

class PokerTwoCardRule implements PokerRule
{
    private const HIGH_CARD = ['high card', 1];
    private const PAIR = ['pair', 2];
    private const STRAIGHT = ['straight', 3];

    public function getHand(array $pokerCards): array
    {
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        $name = self::HIGH_CARD;
        $primary = max($cardRanks);
        $secondary = min($cardRanks);
        if ($this->isStraight($cardRanks[0], $cardRanks[1])) {
            $name = self::STRAIGHT;
        } elseif ($this->isPair($cardRanks[0], $cardRanks[1])) {
            $name = self::PAIR;
        }

        return [
            'name' => $name[0],
            'rank' => $name[1],
            'primary' => $primary,
            'secondary' => $secondary,
        ];
    }

    private function isStraight(int $cardRank1, int $cardRank2): bool
    {
        return abs($cardRank1 - $cardRank2) === 1 || $this->isMinMax($cardRank1, $cardRank2);
    }

    private function isMinMax(int $cardRank1, int $cardRank2): bool
    {
        return abs($cardRank1 - $cardRank2) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }

    private function isPair(int $cardRank1, int $cardRank2): bool
    {
        return $cardRank1 === $cardRank2;
    }

    public function getWinner(array $hand1, array $hand2): int
    {
        foreach (['rank', 'primary', 'secondary'] as $k) {
            if ($hand1[$k] > $hand2[$k]) {
                return 1;
            }

            if ($hand1[$k] < $hand2[$k]) {
                return 2;
            }
        }
        return 0;
    }
}

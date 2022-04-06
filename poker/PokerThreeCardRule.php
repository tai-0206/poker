<?php

namespace Poker;

require_once('PokerCard.php');
require_once('PokerRule.php');

class PokerThreeCardRule implements PokerRule
{
    private const HIGH_CARD = ['high card', 1];
    private const PAIR = ['pair', 2];
    private const STRAIGHT = ['straight', 3];
    private const THREE_OF_A_KIND = ['three of a kind', 4];

    public function getHand(array $pokerCards): array
    {
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        $name = self::HIGH_CARD;
        sort($cardRanks);
        $primary = $cardRanks[0];
        $secondary = $cardRanks[1];
        $tertiary = $cardRanks[2];
        if ($this->isThreeOfAKind($cardRanks)) {
            $name = self::THREE_OF_A_KIND;
        } elseif ($this->isStraight($cardRanks)) {
            $name = self::STRAIGHT;
        } elseif ($this->isPair($cardRanks)) {
            $name = self::PAIR;
        }

        return [
            'name' => $name[0],
            'rank' => $name[1],
            'primary' => $primary,
            'secondary' => $secondary,
            'tertiary' => $tertiary,
        ];
    }

    private function isThreeOfAKind(array $cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 1;
    }

    private function isStraight(array $cardRanks): bool
    {
        sort($cardRanks);
        return range($cardRanks[0], $cardRanks[0] + count($cardRanks) - 1) === $cardRanks || $this->isMinMax($cardRanks);
    }

    private function isMinMax(array $cardRanks): bool
    {
        return $cardRanks === [min(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, max(PokerCard::CARD_RANK)];
    }

    private function isPair(array $cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 2;
    }

    public function getWinner(array $hand1, array $hand2): int
    {
        foreach (['rank', 'primary', 'secondary', 'tertiary'] as $k) {
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

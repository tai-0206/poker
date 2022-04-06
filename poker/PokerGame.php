<?php

/**
 *  1. ルール、ゲーム、カードそれぞれ一つのアクターに対して処理をしているためが単一責任の原則で書かれている
 *  2. ルールごとに処理を分ける手法がオープンクローズドの原則基いて書かれている
 *  3. ルールがリスコフの置換原則に従って書かれている
 *  4. ルールインターフェースがそれぞれのルールに対して必要な処理だけを持っているためインターフェース分離の原則で書かれている
 *  5. PokerGame.phpはルールインターフェースという抽象に依存しているため、ツーカードのルールが修正されてもPokerGameには影響がないため、
 *  依存性逆転の原則で書かれている
 */


namespace Poker;

require_once('PokerCard.php');
require_once('PokerHandEvaluator.php');
require_once('PokerTwoCardRule.php');
require_once('PokerThreeCardRule.php');
require_once('PokerFiveCardRule.php');

class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function start(): array
    {
        $hands = [];
        foreach ([$this->cards1, $this->cards2] as $cards) {
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $rule = $this->getRule($cards);
            $handEvaluator = new PokerHandEvaluator($rule);
            $hands[] = $handEvaluator->getHand($pokerCards);
        }
        $winner = $handEvaluator->getWinner($hands);
        return [$hands[0]['name'], $hands[1]['name'], $winner];
    }

    private function getRule(array $cards): PokerRule
    {
        $rule = new PokerTwoCardRule();
        if (count($cards) === 3) {
            $rule = new PokerThreeCardRule();
        }
        if (count($cards) === 5) {
            $rule = new PokerFiveCardRule();
        }
        return $rule;
    }
}

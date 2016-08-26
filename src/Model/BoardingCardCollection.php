<?php
namespace ItinerarySorter\Model;

class BoardingCardCollection
{
    /**
     * @var BoardingCard[]
     */
    private $boardingCards;

    /**
     * @param BoardingCard[] $boardingCards
     */
    public function __construct(array $boardingCards)
    {
        $this->boardingCards = $boardingCards;
    }

    /**
     * @return BoardingCard[]
     */
    public function getBoardingCards()
    {
        return $this->boardingCards;
    }

    /**
     * @param BoardingCard $boardingCard
     */
    public function push(BoardingCard $boardingCard)
    {
        array_push($this->boardingCards, $boardingCard);
    }

    /**
     * @todo potential performance drop here
     * php arrays are evil, has to be reindexed for this operation, which would cost O(1) in real array.
     *
     * @param BoardingCard $boardingCard
     */
    public function unshift(BoardingCard $boardingCard)
    {
        array_unshift($this->boardingCards, $boardingCard);
    }
}

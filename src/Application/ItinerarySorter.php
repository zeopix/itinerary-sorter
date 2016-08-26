<?php
namespace ItinerarySorter\Application;

use ItinerarySorter\Model\BoardingCardCollection;

class ItinerarySorter
{
    /**
     * @param BoardingCardCollection $boardingCards
     * @return BoardingCardCollection
     */
    public function sortBoardingCards(BoardingCardCollection $boardingCards)
    {
        return new BoardingCardCollection([]);
    }
}

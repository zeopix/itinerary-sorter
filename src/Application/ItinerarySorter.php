<?php
namespace ItinerarySorter\Application;

use ItinerarySorter\Exception\EmptyItineraryException;
use ItinerarySorter\Exception\ItineraryNotFoundException;
use ItinerarySorter\Model\BoardingCardCollection;
use ItinerarySorter\Model\BoardingCard;

class ItinerarySorter
{
    /**
     * @var array
     */
    private $destinationHashmap = [];

    /**
     * @var array
     */
    private $originHashmap = [];

    /**
     * @var array
     */
    private $pointersHashmap = [];

    /**
     * @var null|BoardingCard
     */
    private $backwardPointer;

    /**
     * @var null|BoardingCard
     */
    private $forwardPointer;

    /**
     * @var BoardingCardCollection
     */
    private $sortedBoardingCards;

    /**
     * Given a unsorted collection of boarding cards
     * Returns a sorted collection of boarding cards
     *
     * @param BoardingCardCollection $boardingCards
     * @return BoardingCardCollection
     * @throws ItineraryNotFoundException
     * @throws EmptyItineraryException
     */
    public function sort(BoardingCardCollection $boardingCards)
    {
        $this->generateHashmaps($boardingCards);

        $initialPointer = $this->initializePointers($boardingCards);

        $this->sortedBoardingCards = new BoardingCardCollection([$initialPointer]);

        while (!empty($this->forwardPointer)) {
            $this->moveForward();
        }

        while (!empty($this->backwardPointer)) {
            $this->moveBackward();
        }

        if (!empty($this->pointersHashmap)) {
            throw new ItineraryNotFoundException();
        }

        $this->clearHashmaps();

        return $this->sortedBoardingCards;
    }

    /**
     * @param BoardingCardCollection $boardingCards
     */
    private function generateHashmaps(BoardingCardCollection $boardingCards)
    {
        foreach ($boardingCards->getBoardingCards() as $pointer) {
            /** @var $pointer BoardingCard */
            $this->pointersHashmap[$pointer->getUuid()] = $pointer;
            $this->destinationHashmap[$pointer->getDestination()][] = $pointer->getUuid();
            $this->originHashmap[$pointer->getOrigin()][] = $pointer->getUuid();
        }
    }

    private function clearHashmaps()
    {
        unset($this->pointersHashmap);
        unset($this->destinationHashmap);
        unset($this->originHashmap);
    }

    private function moveBackward()
    {
        $origin = $this->backwardPointer->getOrigin();

        if ($this->forwardPointer != $this->backwardPointer) {
            unset($this->pointersHashmap[$this->backwardPointer->getUuid()]);
            $this->backwardPointer = null;
        }

        if ($this->isThereNextLeg($this->destinationHashmap, $origin)) {
            $backwardLeg = array_shift($this->destinationHashmap[$origin]);
            $pointer = $this->pointersHashmap[$backwardLeg];

            if ($pointer) {
                $this->sortedBoardingCards->unshift($pointer);
                $this->backwardPointer = $pointer;
            }
        }
    }

    private function moveForward()
    {
        $target = $this->forwardPointer->getDestination();

        unset($this->pointersHashmap[$this->forwardPointer->getUuid()]);
        $this->forwardPointer = null;

        if ($this->isThereNextLeg($this->originHashmap, $target)) {
            $forwardLeg = array_shift($this->originHashmap[$target]);
            $pointer = $this->pointersHashmap[$forwardLeg];

            if ($pointer) {
                $this->sortedBoardingCards->push($pointer);
                $this->forwardPointer = $pointer;
            }
        }
    }

    /**
     * @param BoardingCardCollection $boardingCards
     * @return \ItinerarySorter\Model\BoardingCard
     * @throws EmptyItineraryException
     */
    public function initializePointers(BoardingCardCollection $boardingCards)
    {
        $initialPointer = $boardingCards->getInitialBoardingCard();

        $this->forwardPointer = $initialPointer;
        $this->backwardPointer = $initialPointer;

        return $initialPointer;
    }

    /**
     * @param array $hashmap
     * @param string $location
     * @return bool
     */
    private function isThereNextLeg($hashmap, $location)
    {
        return isset($hashmap[$location]) && !empty($hashmap[$location]);
    }
}

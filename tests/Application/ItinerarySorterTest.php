<?php
namespace ItinerarySorter\Application;

use ItinerarySorter\Exception\EmptyItineraryException;
use ItinerarySorter\Exception\ItineraryNotFoundException;
use ItinerarySorter\Model\Accommodation;
use ItinerarySorter\Model\BoardingCard;
use ItinerarySorter\Model\BoardingCardCollection;
use PHPUnit\Framework\TestCase;

class ItinerarySorterTest extends TestCase
{
    /**
     * @var BoardingCard[]
     */
    private $sampleBoardingCards;

    /**
     * @param $unsortedBoardingCards
     * @param $expectedSortedBoardingCards
     * @param null|\Exception $expectedException
     * @dataProvider sortBoardingCardsDataProvider
     */
    public function testSortBoardingCards(
        $unsortedBoardingCards,
        $expectedSortedBoardingCards,
        $expectedException = null
    ) {
        $itinerarySorter = new ItinerarySorter();

        if ($expectedException) {
            $this->expectException($expectedException);
        }

        $sortedBoardingCards = $itinerarySorter->sort($unsortedBoardingCards);

        $this->assertEquals($expectedSortedBoardingCards, $sortedBoardingCards);
    }

    public function sortBoardingCardsDataProvider()
    {
        $this->prepareSamples();

        return [
            'sorts normal path' => [
                'unsortedBoardingCards' => new BoardingCardCollection(
                    [
                        $this->sampleBoardingCards[2],
                        $this->sampleBoardingCards[0],
                        $this->sampleBoardingCards[3],
                        $this->sampleBoardingCards[1],
                    ]
                ),
                'expectedSortedBoardingCards' => new BoardingCardCollection(
                    [
                        $this->sampleBoardingCards[0],
                        $this->sampleBoardingCards[1],
                        $this->sampleBoardingCards[2],
                        $this->sampleBoardingCards[3],
                    ]
                ),
                'expectedException' => null,
            ],
            'throw exception for incomplete path' => [
                'unsortedBoardingCards' => new BoardingCardCollection(
                    [
                        new BoardingCard('AB', 'A', 'B', new Accommodation('vector')),
                        new BoardingCard('CD', 'C', 'D', new Accommodation('vector')),
                        new BoardingCard('DE', 'D', 'E', new Accommodation('vector')),
                    ]
                ),
                'expectedSortedBoardingCards' => null,
                'expectedException' => ItineraryNotFoundException::class,
            ],
            'throw exception for empty itinerary' => [
                'unsortedBoardingCards' => new BoardingCardCollection([]),
                'expectedSortedBoardingCards' => null,
                'expectedException' => EmptyItineraryException::class,
            ],
        ];
    }

    private function prepareSamples()
    {
        $this->sampleBoardingCards[] = new BoardingCard(
            0,
            'Madrid',
            'Barcelona',
            new Accommodation('Train', '78A', null, '45B')
        );

        $this->sampleBoardingCards[] = new BoardingCard(
            1,
            'Barcelona',
            'Gerona Airport',
            new Accommodation('Airport Bus', null, null, '45B')
        );

        $this->sampleBoardingCards[] = new BoardingCard(
            2,
            'Gerona Airport',
            'Stockholm',
            new Accommodation('Plane', 'SK455', '45B', '3A', 'drop', 'counter 344')
        );

        $this->sampleBoardingCards[] = new BoardingCard(
            3,
            'Stockholm',
            'New York JFK',
            new Accommodation('Plane', 'SK22', '22', '7B', 'auto')
        );
    }
}

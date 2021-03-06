[![Build Status](https://travis-ci.org/zeopix/itinerary-sorter.svg?branch=master)](https://travis-ci.org/zeopix/itinerary-sorter)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zeopix/itinerary-sorter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zeopix/itinerary-sorter/?branch=master)

# ItinerarySorter
Sort a trip itinerary given a set of boarding passes which form a full trip.

#### Installation
######Using composer
Include the package
```
composer require zeopix/itinerary-sorter
```

#### Usage
Sample index.php 
```php
<?php
include './vendor/autoloader.php';

use ItinerarySorter\Application\ItinerarySorter;
use ItinerarySorter\Model\BoardingCard;
use ItinerarySorter\Model\Accommodation;
use ItinerarySorter\Model\BoardingCardCollection;

$boardingCards = [
    new BoardingCard(3, 'Barcelona', 'Madrid', new Accomodation('plane')),
    new BoardingCard(1, 'Stockholm', 'Lisboa', new Accomodation('plane')),
    new BoardingCard(2, 'Lisboa', 'Barcelona', new Accomodation('plane')),
];

$unsortedItinerary = new BoardingCardCollection();

$itinerarySorter = new ItinerarySorter();
$sortedItinerary = $itinerarySorter->sort($unsortedItinerary);

```
Run tests 
```
vendor/bin/phpunit
```

#### Model
See phpdoc for Model classes.

###Implementation Notes
- The (greedy) sorting algorithm assumes that there is one and only one path for the itinerary.
- Replacing array_unshift by a implementation of SplFixedArray would improve the performance, as
simple arrays must reindex all elements for insert operations in php.

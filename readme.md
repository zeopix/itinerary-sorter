[![Build Status](https://travis-ci.org/zeopix/itinerary-sorter.svg?branch=master)](https://travis-ci.org/zeopix/itinerary-sorter)

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
use ItinerarySorter\Model\BoardingCardCollection;

$boardingCards = [
    new BoardingCard(3, 'Barcelona', 'Lisboa', new Accomodation('plane')),
    new BoardingCard(1, 'Stockholm', 'Lisboa', new Accomodation('plane')),
    new BoardingCard(2, 'Madrid', 'Barcelona', new Accomodation('plane')),
];

$unsortedItinerary = new BoardingCardCollection();

$sortedItinerary = $itinerarySorter->sort($unsortedItinerary);

```
Run tests 
```
vendor/bin/phpunit
```

#### Model
Accommodation
- type: string - 
- name: string (optional) - 

###Implementation Notes
- The (greedy) sorting algorithm assumes that there is one and only one path for the itinerary.
- Replacing array_unshift by a implementation of SplFixedArray would improve the performance, as
simple arrays must reindex all elements for insert operations in php.
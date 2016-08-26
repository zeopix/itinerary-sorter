# ItinerarySorter
Sort a trip itinerary given a set of boarding passes which constitute a full trip.

#### Dependencies
- php ^5.6 || ^7.0
- composer

Install phpunit 
```bash
composer install
```
Run tests 
```bash
vendor/bin/phpunit
```

#### Usage
- php ^5.6 || ^7.0
- composer

Install phpunit 
```php
<?php
include 'ItinerarySorter/vendor/autoloader.php';

use ItinerarySorter\Application\ItinerarySorter;
use ItinerarySorter\Model\BoardingCard;
use ItinerarySorter\Model\BoardingCardCollection;

$boardingCards = [
    new BoardingCard(3, 'Barcelona', 'Lisboa'),
    new BoardingCard(1, 'Stockholm', 'Lisboa'),
    new BoardingCard(2, 'Madrid', 'Barcelona'),
];

$unsortedItinerary = new BoardingCardCollection();

$sortedItinerary = $itinerarySorter->sort($unsortedItinerary);

```
Run tests 
```
vendor/bin/phpunit
```
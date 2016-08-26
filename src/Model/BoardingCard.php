<?php
namespace ItinerarySorter\Model;

class BoardingCard
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $origin;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var Accommodation
     */
    private $accommodation;

    /**
     * @param string $uuid
     * @param string $origin
     * @param string $destination
     * @param Accommodation $accommodation
     */
    public function __construct($uuid, $origin, $destination, Accommodation $accommodation)
    {
        $this->uuid = $uuid;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->accommodation = $accommodation;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }
}

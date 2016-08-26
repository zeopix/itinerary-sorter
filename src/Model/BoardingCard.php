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
     * @param string $uuid
     * @param string $origin
     * @param string $destination
     */
    public function __construct($uuid, $origin, $destination)
    {
        $this->uuid = $uuid;
        $this->origin = $origin;
        $this->destination = $destination;
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

<?php
namespace ItinerarySorter\Model;

class Accommodation
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var null|string
     */
    private $id;

    /**
     * @var null|string
     */
    private $gate;

    /**
     * @var null|string
     */
    private $seat;

    /**
     * @var null|string
     */
    private $baggage;

    /**
     * @var null|string
     */
    private $baggage_pickup;

    /**
     * @param string $type
     * @param null|string $id
     * @param null|string $gate
     * @param null|string $seat
     * @param null|string $baggage
     * @param null|string $baggage_pickup
     */
    public function __construct($type, $id = null, $gate = null, $seat = null, $baggage = null, $baggage_pickup = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->baggage = $baggage;
        $this->baggage_pickup = $baggage_pickup;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * @return null|string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @return null|string
     */
    public function getBaggage()
    {
        return $this->baggage;
    }

    /**
     * @return null|string
     */
    public function getBaggagePickup()
    {
        return $this->baggage_pickup;
    }
}

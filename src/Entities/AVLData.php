<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 12/07/2018
 * Time: 19:39
 */

namespace lbarrous\TeltonikaDecoder\Entities;

class AVLData implements \JsonSerializable
{
    private $timestamp;
    private $dateTime;
    private $priority;
    private $gpsData;
    private $IOData;
    private $imei;

    /**
     * @return mixed
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * @param mixed $imei
     */
    public function setImei($imei): void
    {
        $this->imei = $imei;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getGpsData()
    {
        return $this->gpsData;
    }

    /**
     * @param mixed $gpsData
     */
    public function setGpsData($gpsData)
    {
        $this->gpsData = $gpsData;
    }

    /**
     * @return mixed
     */
    public function getIOData()
    {
        return $this->IOData;
    }

    /**
     * @param mixed $IOData
     */
    public function setIOData($IOData)
    {
        $this->IOData = $IOData;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return
            [
                'imei' => $this->getImei()->getImeiNumber(),
                'timestamp'   => $this->getTimestamp(),
                'datetime'   => $this->getDateTime(),
                'priority'   => $this->getPriority(),
                'gpsdata'   => $this->getGpsData(),
                'iodata'   => $this->getIOData(),
            ];

    }
}
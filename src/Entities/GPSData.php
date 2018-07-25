<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 12/07/2018
 * Time: 19:47
 */

namespace lbarrous\TeltonikaDecoder\Entities;


class GPSData implements \JsonSerializable
{
    private $longitude;
    private $latitude;
    private $altitude;
    private $angle;
    private $satellites;
    private $speed;

    /**
     * GPSData constructor.
     * @param $longitude
     * @param $latitude
     * @param $altitude
     * @param $angle
     * @param $satellites
     * @param $speed
     */
    public function __construct($longitude, $latitude, $altitude, $angle, $satellites, $speed)
    {
        //$this->longitude = $this->coordinateNegative($longitude) ? $longitude : $longitude *= -1;
        //$this->latitude = $this->coordinateNegative($latitude) ? $latitude : $latitude *= -1;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->altitude = $altitude;
        $this->angle = $angle;
        $this->satellites = $satellites;
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param mixed $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return mixed
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * @param mixed $angle
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
    }

    /**
     * @return mixed
     */
    public function getSatellites()
    {
        return $this->satellites;
    }

    /**
     * @param mixed $satellites
     */
    public function setSatellites($satellites)
    {
        $this->satellites = $satellites;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
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
                'longitude'   => $this->getLongitude(),
                'latitude'   => $this->getLatitude(),
                'altitude'   => $this->getAltitude(),
                'angle'   => $this->getAngle(),
                'satellites'   => $this->getSatellites(),
                'speed'   => $this->getSpeed(),
            ];
    }

    private function coordinateNegative(float $coordinate): bool
    {
        $binCoordinate = decbin($coordinate);
        if (strlen($binCoordinate) === 32) {
            return (int)substr($binCoordinate, 0, 1) === 1;
        }

        return false;
    }
}
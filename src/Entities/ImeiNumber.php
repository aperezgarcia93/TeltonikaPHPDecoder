<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 18/07/2018
 * Time: 11:09
 */

namespace lbarrous\TeltonikaDecoder\Entities;


class ImeiNumber implements \JsonSerializable
{
    const IMEI_LENGTH = 15;

    private $hexImei;
    private $imei;

    /**
     * ImeiNumber constructor.
     * @param $imei
     */
    public function __construct($hexImei)
    {
        $this->hexImei = $hexImei;
        $this->decodeImei();
    }

    /**
     * @return mixed
     */
    public function getImeiNumber()
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
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'imei' => $this->getImei()
        ];
    }

    private function decodeImei() {
        $hexImeiWithoutPayload = substr($this->hexImei, 4);
        $this->imei = hex2bin($hexImeiWithoutPayload);
    }
}
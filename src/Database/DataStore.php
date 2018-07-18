<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 18/07/2018
 * Time: 13:23
 */

namespace lbarrous\TeltonikaDecoder\Database;

use Medoo\Medoo;
//include("/../../config.php");

class DataStore
{
    private $dataBaseInstance;

    /**
     * DataStore constructor.
     * @param $dataBaseInstance
     */
    public function __construct()
    {
        $this->dataBaseInstance = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => \Conf::db_name,
            'server' => \Conf::db_host,
            'username' => \Conf::db_user,
            'password' => \Conf::db_pass,
        ]);
    }

    public function storeDataFromDevice($AVLElement) {
        $insertData = $this->dataBaseInstance->insert(
            'gps_data_devices',
            array(
                'imei' => $AVLElement->getImei()->getImeiNumber(),
                'longitude' => $AVLElement->getGpsData()->getLongitude(),
                'latitude' => $AVLElement->getGpsData()->getLatitude(),
                'altitude' => $AVLElement->getGpsData()->getAltitude(),
                'angle' => $AVLElement->getGpsData()->getAngle(),
                'satellites' => $AVLElement->getGpsData()->getSatellites(),
                'speed' => $AVLElement->getGpsData()->getSpeed(),
                'datetime' => $AVLElement->getDateTime(),
            )
        );
    }


}
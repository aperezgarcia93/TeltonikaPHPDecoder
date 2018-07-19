<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 16/07/2018
 * Time: 13:23
 */

namespace lbarrous\TeltonikaDecoder\Server;

require 'vendor/autoload.php';

use lbarrous\TeltonikaDecoder\Entities\ImeiNumber;
use React\Socket\ConnectionInterface;
use lbarrous\TeltonikaDecoder\TeltonikaDecoderImp;
use lbarrous\TeltonikaDecoder\Database\DataStore;

class SocketServer
{

    private $host;
    private $port;
    private $dataBase;

    /**
     * SocketServer constructor.
     * @param $host
     * @param $port
     */
    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dataBase = new DataStore();
    }

    public function runServer() {

        $loop = \React\EventLoop\Factory::create();

        //Creation of new TCP socket
        $socket = new \React\Socket\Server($this->host.":".$this->port, $loop);

        $socket->on('connection', function(ConnectionInterface $connection){

            //We nget on two scenarios:
            //1. We get IMEI, which we decode, we can even valid if it's correct, and then we send to the device a hex confirmation "\x01"
            //2. We start getting AVL Data in two ways
                //2.1 We firstly get a first part of the HEX string
                //2.2 We get the last of the HEX string, so we match the two parts and we finally get the complete HEX string which we can decode to get the data

            //As we get the data in two times we need to get a variable to store it
            $hexDataGPS = "";

            //We store the imei to store with the data
            $imei = "";

            //We set a react event for every time we get data on our socket.
            $connection->on('data', function($data) use ($connection, &$hexDataGPS, &$imei){

                //If we get a 17 characters string it means we are getting IMEI number, we have to decode it, check IMEI and send confirmation
                if(strlen($data) == 17) {

                    //We always get binary info so we decode it into HEX
                    $data = bin2hex($data);

                    //DECODE IMEI
                    $imei = new ImeiNumber($data);

                    //YOU CAN OPTIONALLY DO STUFF WITH YOUR IMEI BEFORE SENDING CONFIRMATION

                    /**/

                    //SEND CONFIRMATION
                    $connection->write("\x01"); //(Binary packet => 01)
                }

                else {

                    //We always get binary info so we decode it into HEX
                    $data = bin2hex($data);

                    //We get the first part of the data
                    if(strlen($data) == 20) {
                        $hexDataGPS .= $data;
                    }

                    //We get the last part
                    else {
                        $hexDataGPS .= $data;

                        echo "Got a complete AVLMessage:\n";
                        echo $hexDataGPS;
                        echo "\n";

                        //We decode the message
                        $decoder = new TeltonikaDecoderImp($hexDataGPS, $imei);
                        $AVLArray = $decoder->getArrayOfAllData();

                        //Show output
                        echo json_encode($AVLArray);
                        echo "\n";


                        $numerOfElementsReceived = $decoder->getNumberOfElements();
                        echo "Elements received: ".$numerOfElementsReceived."\n";

                        foreach ($AVLArray as $AVLElement) {
                            $this->dataBase->storeDataFromDevice($AVLElement);
                        }
                        echo "Data saved into the database"."\n";

                        //Send the response to server with the number of records we got (4 bytes integer)
                        $connection->write(pack('N', $numerOfElementsReceived));
                        //$connection->write($numerOfElementsReceived);
                    }
                }


            });
        });
        echo "Listening on {$socket->getAddress()}\n";
        $loop->run();

    }

}
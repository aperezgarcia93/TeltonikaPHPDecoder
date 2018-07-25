<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 13/07/2018
 * Time: 14:24
 */

namespace tests;

use lbarrous\TeltonikaDecoder\Entities\AVLData;
use lbarrous\TeltonikaDecoder\TeltonikaDecoderImp;
use lbarrous\TeltonikaDecoder\TeltonikaDecoder;
use PHPUnit\Framework\TestCase;

class TeltonikaDecoderImpTest extends TestCase
{

    private $decoder;

    public function setUp()
    {
        $hexAVLData = "0000000000000043080200000164AD61763800FEC011361C16546F001F0162080020000101150100000000000164AD61996000FEBFF69C1C166A1E001D0136080022000101150100000002000071D8";

        $imeiHex = "000f383631313037303332393035363331";

        $this->decoder = new TeltonikaDecoderImp($hexAVLData, $imeiHex);
    }

    /*public function testGetArrayOfAllData()
    {

    }*/

    public function testGetCodecType()
    {
        $codecType = $this->decoder->getCodecType();
        $this->assertEquals(8, $codecType);
    }

    public function testDecodeAVLArrayData()
    {
        $AVLArray = $this->decoder->getArrayOfAllData();



        foreach ($AVLArray as $element) {
            $this->assertInstanceOf(AVLData::class, $element);
        }

        //Get first element
        $AVLElement = $AVLArray[0];

        $this->assertEquals(1531917203, $AVLElement->getTimestamp());

        $this->assertEquals(-2.0967114, $AVLElement->getGpsData()->getLongitude());
        $this->assertEquals(47.1225455, $AVLElement->getGpsData()->getLatitude());
        $this->assertEquals(31, $AVLElement->getGpsData()->getAltitude());
        $this->assertEquals(354, $AVLElement->getGpsData()->getAngle());
        $this->assertEquals(8, $AVLElement->getGpsData()->getSatellites());
        $this->assertEquals(32, $AVLElement->getGpsData()->getSpeed());

        //var_dump($AVLElement);

    }

    public function testGetNumberOfElements()
    {
        $AVLArray = $this->decoder->getArrayOfAllData();
        $numberOfElements = $this->decoder->getNumberOfElements();

        $this->assertEquals($numberOfElements, count($AVLArray));
    }

}

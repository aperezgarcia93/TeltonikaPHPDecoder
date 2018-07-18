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
        $hexAVLData = "0000000000000403082000000164acb8c6a000ff22905a1bc07efd005000c6090000000101150300000000000164acb8ca8800ff2290771bc07f16004f00c6090000000101150300000000000164acb8ce7000ff2290a61bc07f33004f00c609
0000000101150300000000000164acb8d25800ff2290d01bc07f54004e00c6090000000101150300000000000164acb8d64000ff2290f31bc07f6c004e00c6090000000101150300000000000164acb8da2800ff22910c1bc07f7b004e00c609
0000000101150300000000000164acb8de1000ff2291221bc07f8c004e00c6090000000101150300000000000164acb8e1f800ff2291331bc07f94004e00c6090000000101150300000000000164acb8e5e000ff2291411bc07f94004e00c609
0000000101150300000000000164acb8e9c800ff2291491bc07f90004e00c6090000000101150300000000000164acb8edb000ff2291561bc07f8e004e00c6090000000101150300000000000164acb8f19800ff2291611bc07f8e004e00c609
0000000101150300000000000164acb8f58000ff2291681bc07f8d004e00c6090000000101150300000000000164acb8f96800ff22916d1bc07f90004e00c6090000000101150300000000000164acb8fd5000ff22916e1bc07f91004e00c609
0000000101150300000000000164acb9013800ff22916e1bc07f8f004e00c6090000000101150300000000000164acb9052000ff2291701bc07f91004e00c6090000000101150300000000000164acb9090800ff2291711bc07f91004e00c609
0000000101150300000000000164acb90cf000ff2291721bc07f91004e00c6090000000101150300000000000164acb910d800ff2291721bc07f91004e00c60a0000000101150300000000000164acb914c000ff2291731bc07f91004e00c60a
0000000101150300000000000164acb918a800ff2291731bc07f92004e00c60a0000000101150300000000000164acb91c9000ff2291741bc07f92004e00c60a0000000101150300000000000164acb9207800ff2291721bc07f91004e00c60a
0000000101150300000000000164acb9246000ff2291711bc07f90004e00c60a0000000101150300000000000164acb9284800ff22916e1bc07f8c004e00c60a0000000101150300000000000164acb92c3000ff22916d1bc07f8a004e00c60a
0000000101150300000000000164acb9301800ff22916a1bc07f87004f00c60a0000000101150300000000000164acb9340000ff2291691bc07f85004f00c60a0000000101150300000000000164acb937e800ff2291661bc07f82004f00c60a
0000000101150300000000000164acb93bd000ff2291641bc07f80004f00c60a0000000101150300000000000164acb93fb800ff2291631bc07f7e004f00c60a00000001011503000000200000c7f5";

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

        $this->assertEquals(1531906148, $AVLElement->getTimestamp());

        $this->assertEquals(428.0455258, $AVLElement->getGpsData()->getLongitude());
        $this->assertEquals(46.5600253, $AVLElement->getGpsData()->getLatitude());
        $this->assertEquals(80, $AVLElement->getGpsData()->getAltitude());
        $this->assertEquals(198, $AVLElement->getGpsData()->getAngle());
        $this->assertEquals(9, $AVLElement->getGpsData()->getSatellites());
        $this->assertEquals(0, $AVLElement->getGpsData()->getSpeed());

    }

    public function testGetNumberOfElements()
    {
        $AVLArray = $this->decoder->getArrayOfAllData();
        $numberOfElements = $this->decoder->getNumberOfElements();

        $this->assertEquals($numberOfElements, count($AVLArray));
    }

}

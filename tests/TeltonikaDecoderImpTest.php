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
        $hexAVLData = "00000000000000A7080400000113FC208DFF000F14F650209CCA80006F00D60400040004030101150316030001460000015D0000000113FC17610B000F14FFE0209CC580006E00C00500010004030101150316010001460000015E0000000113FC284945000F150F00209CD200009501080400000004030101150016030001460000015D0000000113FC267C5B000F150A50209CCCC0009300680400000004030101150016030001460000015B00040000BA48";
        $this->decoder = new TeltonikaDecoderImp($hexAVLData);
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

        $this->assertEquals(1185345998, $AVLElement->getTimestamp());

        $this->assertEquals(25.3032016, $AVLElement->getGpsData()->getLongitude());
        $this->assertEquals(54.7146368, $AVLElement->getGpsData()->getLatitude());
        $this->assertEquals(111, $AVLElement->getGpsData()->getAltitude());
        $this->assertEquals(214, $AVLElement->getGpsData()->getAngle());
        $this->assertEquals(4, $AVLElement->getGpsData()->getSatellites());
        $this->assertEquals(4, $AVLElement->getGpsData()->getSpeed());

    }

    public function testGetNumberOfElements()
    {
        $AVLArray = $this->decoder->getArrayOfAllData();
        $numberOfElements = $this->decoder->getNumberOfElements();

        $this->assertEquals($numberOfElements, count($AVLArray));
    }

}

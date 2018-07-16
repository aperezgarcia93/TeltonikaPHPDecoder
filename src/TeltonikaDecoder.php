<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 12/07/2018
 * Time: 19:01
 */

namespace lbarrous\TeltonikaDecoder;


use lbarrous\TeltonikaDecoder\Entities\AVLData;

interface TeltonikaDecoder
{
    public function getNumberOfElements() :int;
    public function getCodecType() :int;
    public function decodeAVLArrayData(string $hexDataOfElement) :AVLData;
    public function getArrayOfAllData() :array;
}
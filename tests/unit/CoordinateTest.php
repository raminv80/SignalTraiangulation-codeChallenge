<?php
require_once 'App/Coordinate.php';

use PHPUnit\Framework\TestCase;
use App\Coordinate;

class CoordinateTest extends TestCase {

    /**
     * @dataProvider coordinateEqualityProvider
     */
    public function testCoordinateEquality($x1, $y1, $x2, $y2, $isEqual){
        $coordinate1 = new Coordinate($x1, $y1);
        $coordinate2 = new Coordinate($x2, $y2);

        $this->assertEquals($coordinate1->isEqual($coordinate2), $isEqual);
    }

    /**
     * @dataProvider coordinateDistanceProvider
     */
    public function testCoordinateDistanceCalculation($x1, $y1, $x2, $y2, $distance){
        $coordinate1 = new Coordinate($x1, $y1);
        $coordinate2 = new Coordinate($x2, $y2);

        $this->assertEquals($coordinate1->distance($coordinate2), $distance);
    }

    public function coordinateEqualityProvider() {
        // $x1, $y1, $x2, $y2, $isEqual
        return [
            [0, 0, 0, 1, false],
            [0, 0, 0, 0, true],
            [0,0, 0.0000001, 0.0000002, true],
            [0, 0, 0.00001, 0.00002, false],
        ];
    }

    public function coordinateDistanceProvider() {
        // $x1, $y1, $x2, $y2, $distance
        return [
            [0, 0, 0, 1, 1],
            [0, 0, 0, 0, 0],
            [0, 0, 1, 1, sqrt(2)],
        ];
    }
}

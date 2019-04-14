<?php
require_once 'tests/TestHelper.php';
require_once 'App/Coordinate.php';

class CoordinateTest extends DataProvider {

    /**
     * @dataProvider coordinateEqualityProvider
     */
    public function testCoordinateEquality($x1, $y1, $x2, $y2, $isEqual){
        $coordinate1 = new \App\Coordinate($x1, $y1);
        $coordinate2 = new \App\Coordinate($x2, $y2);

        $this->assertEquals($coordinate1->isEqual($coordinate2), $isEqual);
    }

    /**
     * @dataProvider coordinateDistanceProvider
     */
    public function testCoordinateDistanceCalculation($x1, $y1, $x2, $y2, $distance){
        $coordinate1 = new \App\Coordinate($x1, $y1);
        $coordinate2 = new \App\Coordinate($x2, $y2);

        $this->assertEquals($coordinate1->distance($coordinate2), $distance);
    }

}

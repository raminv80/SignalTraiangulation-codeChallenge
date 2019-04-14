<?php
require_once 'App/Geometry.php';

use PHPUnit\Framework\TestCase;
use App\Geometry;

class GeometryTest extends TestCase {

    /**
     * @dataProvider geometryProvider
     */
    public function testPrecisionComparison($a, $b, $precision, $result){
        $obj = new Geometry();

        $this->assertEquals($obj->compareValuesWithPrecision($a, $b, $precision), $result);
    }

    public function geometryProvider() {
        // $a, $b, $precision, $result
        return [
            [0, 0, 0, 0],
            [0.0, 0.1, 0, 0],
            [0, 0.1, 1, -1],
            [0, 0.000001, 6, -1],
            [0, 0.0000001, 6, 0],
            [0.000001, 0, 6, 1],
            [0.0000001, 0, 6, 0],
            [0.000005, 0, 6, 1],
            [0.0000005, 0, 6, 0],
            [0.000009, 0, 6, 1],
            [0.0000009, 0, 6, 1],
        ];
    }
}

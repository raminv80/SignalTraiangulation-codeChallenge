<?php
require_once 'tests/TestHelper.php';
require_once 'App/Geometry.php';

class GeometryTest extends DataProvider {

    /**
     * @dataProvider geometryProvider
     */
    public function testPrecisionComparison($a, $b, $precision, $result){
        $obj = new \App\Geometry();

        $this->assertEquals($obj->compareValuesWithPrecision($a, $b, $precision), $result);
    }

}

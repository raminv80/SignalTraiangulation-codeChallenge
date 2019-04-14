<?php
require_once 'tests/TestHelper.php';
require_once 'App/Circle.php';

class CircleTest extends DataProvider {

    /**
     * @dataProvider calcIntersectionsProvider
     */
    public function testCalcIntersections($x1, $y1, $radius1, $x2, $y2, $radius2, $intersections) {
        $circle1 = new \App\Circle($x1, $y1, $radius1);
        $circle2 = new \App\Circle($x2, $y2, $radius2);
        $res = $circle1->calcIntersections($circle2);
        $sources = [];

        foreach($res as $intersection) {
            $sources[] = $intersection->asArray();
        }

        $this->assertEquals($sources, $intersections);
    }

    /**
     * @dataProvider calcNumIntersectionsProvider
     */
    public function testCalcNumIntersections($x1, $y1, $radius1, $x2, $y2, $radius2, $intersections) {
        $circle1 = new \App\Circle($x1, $y1, $radius1);
        $circle2 = new \App\Circle($x2, $y2, $radius2);
        $res = count($circle1->calcIntersections($circle2));

        $this->assertEquals($res, $intersections);
    }

    /**
     * @dataProvider circleDoIntersectProvider
     */
    public function testDoIntersect($x1, $y1, $radius1, $x2, $y2, $radius2, $result) {
        $circle1 = new \App\Circle($x1, $y1, $radius1);
        $circle2 = new \App\Circle($x2, $y2, $radius2);

        $this->assertEquals($circle1->doIntersect($circle2), $result);
    }

    /**
     * @dataProvider circleEqualityProvider
     */
    public function testEquality($x1, $y1, $radius1, $x2, $y2, $radius2, $result) {
        $circle1 = new \App\Circle($x1, $y1, $radius1);
        $circle2 = new \App\Circle($x2, $y2, $radius2);

        $this->assertEquals($circle1->isEqual($circle2), $result);
    }

}

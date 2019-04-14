<?php
require_once 'App/Circle.php';

use PHPUnit\Framework\TestCase;
use App\Circle;

class  CircleTest extends TestCase {

    /**
     * @dataProvider calcIntersectionsProvider
     */
    public function testCalcIntersections($x1, $y1, $radius1, $x2, $y2, $radius2, $intersections) {
        $circle1 = new Circle($x1, $y1, $radius1);
        $circle2 = new Circle($x2, $y2, $radius2);
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
        $circle1 = new Circle($x1, $y1, $radius1);
        $circle2 = new Circle($x2, $y2, $radius2);
        $res = count($circle1->calcIntersections($circle2));

        $this->assertEquals($res, $intersections);
    }

    /**
     * @dataProvider circleDoIntersectProvider
     */
    public function testDoIntersect($x1, $y1, $radius1, $x2, $y2, $radius2, $result) {
        $circle1 = new Circle($x1, $y1, $radius1);
        $circle2 = new Circle($x2, $y2, $radius2);

        $this->assertEquals($circle1->doIntersect($circle2), $result);
    }

    /**
     * @dataProvider circleEqualityProvider
     */
    public function testEquality($x1, $y1, $radius1, $x2, $y2, $radius2, $result) {
        $circle1 = new Circle($x1, $y1, $radius1);
        $circle2 = new Circle($x2, $y2, $radius2);

        $this->assertEquals($circle1->isEqual($circle2), $result);
    }

    public function calcIntersectionsProvider() {
        // $x1, $y1, $radius1, $x2, $y2, $radius2, $intersections
        return [
            [0, 0, 5, 6, 8, 5, [['x'=>3, 'y'=>4]]],
            [0, 0, 5, 6.0000001, 8, 5, [['x'=>3, 'y'=>4]]], // fault tolerance
            [0, 0, 5, 0, 0, 5, []], // same signal
            [0, 0, 5, 0.0000001, -0.0000001, 5.000001, []], // fault tolerance
        ];
    }

    public function calcNumIntersectionsProvider() {
        // $x1, $y1, $radius1, $x2, $y2, $radius2, $intersections
        return [
            [0, 0, 5, 6, 8, 5, 1],
            [0, 0.5, 5, 6, 8, 5, 2],
        ];
    }

    public function circleDoIntersectProvider() {
        // $x1, $y1, $radius1, $x2, $y2, $radius2, $result
        return [
            [0, 0, 1, 0, 0, 1.0000004, false],
            [0, 0, 1, 0.000001, 0, 1, true],
            [0, 0, 1, 0.0000001, 0, 1, false],
            [0, 0, 5, 6, 8, 5, true],
        ];
    }

    public function circleEqualityProvider() {
        // $x1, $y1, $radius1, $x2, $y2, $radius2, $result
        return [
            [0, 0, 1, 0, 0, 1.0000004, true],
            [0, 0, 1, 0, 0, 1.000009, false],
        ];
    }
}

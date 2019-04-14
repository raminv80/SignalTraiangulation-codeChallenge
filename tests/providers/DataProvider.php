<?php

define('PRECISION', 6);

require_once 'App/Coordinate.php';

class DataProvider extends TestHelper {

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

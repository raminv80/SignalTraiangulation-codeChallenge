<?php
namespace App;

require_once 'App/Geometry.php';

class Coordinate extends Geometry{
    public $x, $y;

    public function __construct($x, $y) {
        $this->x = round($x, PRECISION);
        $this->y = round($y, PRECISION);
    }

    /**
     * Returns true if two coordinates are the same
     * @param Coordinate
     * @return Boolean
     */
    public function isEqual(Coordinate $coord) {
        return $this->compareValuesWithPrecision($this->x, $coord->x) === 0 &&
               $this->compareValuesWithPrecision($this->y, $coord->y) === 0;
    }

    /**
     * Returns distance between center of two circles
     * @param Coordinate
     * @return float
     */
    public function distance(Coordinate $coord) {
        return sqrt(pow($this->x - $coord->x, 2) + pow($this->y - $coord->y, 2));
    }

    /**
     * Returns scalar coordinates
     * @return array
     */
    public function asArray() {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}

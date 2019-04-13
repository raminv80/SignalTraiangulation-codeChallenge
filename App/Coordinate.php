<?php
namespace App;

class Coordinate {
    public $x, $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Returns true if two coordinates are the same
     * @param Coordinate
     * @return Boolean
     */
    public function isEqual(Coordinate $coord) {
        return bccomp($this->x, $coord->x, PRECISION) === 0 &&
               bccomp($this->y, $coord->y, PRECISION) === 0;
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

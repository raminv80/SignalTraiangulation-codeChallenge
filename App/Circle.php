<?php
namespace App;

use phpDocumentor\Reflection\Types\Boolean;

Class Circle {
    private $radius, $x, $y;

    public function __construct($x, $y, $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function distance(Circle $otherCircle) {
        return sqrt(pow($this->x - $otherCircle->x, 2) + pow($this->y - $otherCircle->y, 2));
    }

    public function doIntersect(Circle $otherCircle) {
        $d = $this->distance($otherCircle);
        return (($this->radius + $otherCircle->radius) >= $d) && ($d >= abs($this->radius - $otherCircle->radius));
    }

    public function calcIntersections(Circle $otherCircle) {
        // TODO
    }
}

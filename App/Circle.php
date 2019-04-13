<?php
namespace App;

require 'App/Coordinate.php';

Class Circle {
    public $radius, $center;

    public function __construct($x, $y, $radius) {
        $this->center = new Coordinate($x, $y);
        $this->radius = $radius;

        defined('PRECISION') or define('PRECISION', 6);
    }

    /*
     * Returns true if two circles are the same
     * @param Circle
     * @return Boolean
     */
    public function isEqual(Circle $otherCircle) {
        return bccomp($this->radius, $otherCircle->radius, PRECISION) === 0 &&
               $this->center->isEqual($otherCircle->center);
    }

    /*
     * Returns distance between center of two circles
     * @param Circle
     * @return float
     */
    public function distance(Circle $otherCircle) {
        return $this->center->distance($otherCircle->center);
    }

    /*
     * Tests if two circle do intersect
     * @param Circle
     * @return Boolean
     */
    public function doIntersect(Circle $otherCircle) {
        $d = $this->distance($otherCircle);
        return (bccomp($this->radius + $otherCircle->radius, $d, PRECISION) >= 0) &&
               (bccomp($d, abs($this->radius - $otherCircle->radius), PRECISION) >= 0);
    }

    /*
     * Calculates intersection of two circles
     * @param Circle
     * @return Array intersections
     */
    public function calcIntersections(Circle $otherCircle) {
        if ($this->doIntersect($otherCircle)) {
            // Two circles intersects or tangent
            // Area according to Heron's formula
            //----------------------------------
            $d = $this->distance( $otherCircle );

            $a1   = $d + $this->radius + $otherCircle->radius;
            $a2   = $d + $this->radius - $otherCircle->radius;
            $a3   = $d - $this->radius + $otherCircle->radius;
            $a4   = - $d + $this->radius + $otherCircle->radius;
            $area = sqrt( $a1 * $a2 * $a3 * $a4 ) / 4;

            // Calculating x axis intersection values
            //---------------------------------------
            $d2     = $d * $d;
            $thisR2 = $this->radius * $this->radius;
            $thatR2 = $otherCircle->radius * $otherCircle->radius;
            $val1   = ( $this->center->x + $otherCircle->center->x ) / 2 +
                      ( $otherCircle->center->x - $this->center->x ) *
                      ( $thisR2 - $thatR2 ) / ( 2 * $d2 );
            $val2   = 2 * ( $this->center->y - $otherCircle->center->y ) * $area / $d2;
            $x1     = $val1 + $val2;
            $x2     = $val1 - $val2;

            // Calculating y axis intersection values
            //---------------------------------------
            $val1 = ( $this->center->y + $otherCircle->center->y ) / 2 +
                    ( $otherCircle->center->y - $this->center->y ) *
                    ( $thisR2 - $thatR2 ) / ( 2 * $d2 );
            $val2 = 2 * ( $this->center->x - $otherCircle->center->x ) * $area / $d2;
            $y1   = $val1 - $val2;
            $y2   = $val1 + $val2;

            // Intersection points are (x1, y1) and (x2, y2)

            // Because for every x we have two values of y, and the same thing for y,
            // we have to verify that the intersection points as chose are on the
            // circle otherwise we have to swap between the points.
            // Lets test if [x1, y1] is on current circle

            $radius = pow( $x1 - $this->center->x, 2 ) + pow( $y1 - $this->center->y, 2 );
            if ( ! bccomp( $radius, $this->radius, PRECISION ) === 0 ) {
                $t  = $y1;
                $y1 = $y2;
                $y2 = $t;
            }

            $intersection1 = new Coordinate($x1, $y1);
            $intersection2 = new Coordinate($x2, $y2);

            if($intersection1->isEqual($intersection2)) return [ $intersection1 ];
            else return [ $intersection1, $intersection2 ];
        } else return [];
    }
}

<?php
namespace App;

defined('PRECISION') or define('PRECISION', 6);

class Geometry {
    public function compareValuesWithPrecision($a, $b, $precision = PRECISION) {
        return bccomp(sprintf('%F', $a), sprintf('%F', $b), $precision);
    }
}

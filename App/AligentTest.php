<?php
namespace App;

require_once 'App/Api.php';
require 'App/Circle.php';

class AligentTest extends Api {
    function routeRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->getInput();
            if ($input['samples']) {
                $samples = $input['samples'];
                $result = $this->processSamples($samples);
                $this->setResponse( $result, 200 );
                return;
            } else {
                $this->setResponse(['error'=>'input is not valid'], 400);
            }
        }

        parent::routeRequest();
    }

    function processSamples($samples) {
        if (count($samples) < 2) {
            $this->setResponse(['error'=>'not enough samples'], 400);
            return;
        }

        $samples = array_unique($samples);
        if (count($samples) < 2) {
            $this->setResponse(['error'=>'not enough unique samples'], 400);
            return;
        }

        $circle1 = $this->modelSignalAsCircle($samples[0]);
        $circle2 = $this->modelSignalAsCircle($samples[1]);

        if (!$circle1->doIntersect($circle2)) {
            $this->setResponse(['error'=>'Unable to trace the position'], 204);
            return;
        }

        // TODO: calculate intersection points of two circles
    }

    function modelSignalAsCircle($signal) {
        return new Circle($signal['x'], $signal['y'], $signal['distance']);
    }
}

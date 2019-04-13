<?php
namespace App;

require_once 'App/Api.php';
require 'App/Circle.php';

class AligentTest extends Api {
    /**
     * Responds to POST /
     * Respond codes:
     * 200: if one or two possible source points are found
     * 400: if input data is not valid
     * 204: if source couldn't be located
     */
    function routeRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/') {
            $input = $this->getInput();
            if ($input['samples']) {
                $samples = $input['samples'];

                if (count($samples) < 2) {
                    $this->setResponse(['error'=>'not enough samples'], 400);
                    return;
                }

                $valid = true;
                for ($i=0; $i<count($samples); $i++) {
                    $valid = $valid && is_numeric($samples[$i]['x']) &&
                             is_numeric($samples[$i]['y']) &&
                             is_numeric($samples[$i]['distance']);
                    if (!$valid) break;
                }
                if (!$valid) {
                    $this->setResponse(['error'=>'invalid sample data detected'], 400);
                    return;
                }

                $result = $this->processSamples($samples);
                $this->setResponse( $result, 200 );
                return;
            } else {
                $this->setResponse(['error'=>'input is not valid'], 400);
            }
        }

        parent::routeRequest();
    }

    /**
     * finds source point(s) using two unique signals
     * @param array
     * @return array
     */
    function processSamples($samples) {
        $sources = [];

        $circle1 = $this->modelSignalAsCircle($samples[0]);
        $circle2 = $this->modelSignalAsCircle($samples[1]);

        if(!$circle1->isEqual($circle2)) {
            $intersections = $circle1->calcIntersections($circle2);

            foreach($intersections as $intersection) {
                $sources[] = $intersection->asArray();
            }
        }

        return [
            'samples' => $samples,
            'sources' => $sources
        ];
    }

    function modelSignalAsCircle($signal) {
        return new Circle($signal['x'], $signal['y'], $signal['distance']);
    }
}

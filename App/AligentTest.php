<?php
namespace App;

require_once 'App/Api.php';

class AligentTest extends Api {
    function routeRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->getInput();
            if ($input['samples']) {
                // TODO: calculate intersection points from signals
                $this->sendResponse( $input, 200 );

                return;
            } else {
                $this->sendResponse(['error'=>'input is not valid'], 400);
            }
        }

        parent::routeRequest();
    }
}

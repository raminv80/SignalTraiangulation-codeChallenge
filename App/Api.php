<?php
namespace App;
class Api {
    function __construct() {
        $this->setupCORS();
    }

    function bootstrap() {
        $this->routeRequest();
    }

    /**
     * To be overridden in child
     */
    function routeRequest() {
        $this->setResponse(['error'=> 'resource not found'], 404);
    }

    /**
     * Allow access to the API from everywhere
     */
    private function setupCORS() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET,POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /**
     * reads json from POST body
     * @return mixed
     */
    function getInput() {
        $inputJSON = file_get_contents('php://input'); // get post body
        $input = json_decode($inputJSON, TRUE); //convert JSON into array
        return $input;
    }

    function setResponse($data, $httpCode=200) {
        http_response_code($httpCode);
        echo json_encode($data);
    }

}

<?php
use chriskacerguis\RestServer\RestController;

require_once(APPPATH . "libraries\RestController.php");

class RestAPI extends RestController
{

  function __construct()
  {
    // Construct the parent class     
    parent::__construct();
  }

  function item_get()
  {

    $data = 'Index Working';
    $this->response($data, 200);
  }
}

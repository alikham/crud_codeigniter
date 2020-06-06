<?php

use chriskacerguis\RestServer\RestController;

require_once(APPPATH . "libraries\RestController.php"); //IMPORTANT
require_once(APPPATH . "libraries\Format.php"); //IMPORTANT   

class RestAPI extends RestController
{

  function __construct()
  {
    // Construct the parent class     
    parent::__construct();
    $this->load->model('CrudModel');
    $this->crudModel = new CrudModel;
  }

  function item_get($id = 0)
  {
    $id ? $data = $this->crudModel->find_item($id) : $data = $this->crudModel->get_crud();

    $this->response($data, 200);
  }

  // Creating item through post
  // The request should contain form-data with title and description value
  function item_post()
  {
    $response = $this->crudModel->insert_item();

    $this->response($response, 200);
  }

  // Update item with id through put method
  // request body should consist of raw json data
  // Check the crudModel for handling of the PUT data

  function item_put($id = 0)
  {
    if ($id) {
      
      $data = $this->crudModel->update_item($id);
      $this->response($data, 200);
    } else {

      $this->response('Error: Id should be passed', 500);
    }
  }

  function item_delete($id = 0)
  {
    if ($id) {

      $data = $this->crudModel->delete_item($id);
      $this->response($data, 200);
    } else {

      $this->response('Error: Id should be passed for deleting the item', 500);
    }
  }
}

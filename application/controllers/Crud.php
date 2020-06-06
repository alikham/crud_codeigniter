<?php

defined('BASEPATH') or exit('No direct access allowed yes');

class Crud extends CI_Controller
{

  public $crud;

  public function __construct()
  {
    parent::__construct();


    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('CrudModel');


    $this->crudModel = new CrudModel;
  }


  /**
   * Display Data this method.
   *
   * @return Response
   */
  public function index()
  {
    $data['data'] = $this->crudModel->get_crud();


    $this->load->view('theme/header');
    $this->load->view('theme/list', $data);
    $this->load->view('theme/footer');
  }


  /**
   * Show Details this method.
   *
   * @return Response
   */
  public function show($id)
  {
    $item = $this->crudModel->find_item($id);


    $this->load->view('theme/header');
    $this->load->view('theme/show', array('item' => $item));
    $this->load->view('theme/footer');
  }


  /**
   * Create from display on this method.
   *
   * @return Response
   */
  public function create()
  {
    $this->load->view('theme/header');
    $this->load->view('theme/create');
    $this->load->view('theme/footer');
  }


  /**
   * Store Data from this method.
   *
   * @return Response
   */
  public function store()
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');


    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('errors', validation_errors());
      redirect(base_url('theme/create'));
    } else {
      $this->crudModel->insert_item();
      redirect(base_url('crud'));
    }
  }


  /**
   * Edit Data from this method.
   *
   * @return Response
   */
  public function edit($id)
  {
    $item = $this->crudModel->find_item($id);


    $this->load->view('theme/header');
    $this->load->view('theme/edit', array('item' => $item));
    $this->load->view('theme/footer');
  }


  /**
   * Update Data from this method.
   *
   * @return Response
   */
  public function update($id)
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');


    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('errors', validation_errors());
      redirect(base_url('crud/edit/' . $id));
    } else {
      $this->crudModel->update_item($id);
      redirect(base_url('crud'));
    }
  }


  /**
   * Delete Data from this method.
   *
   * @return Response
   */
  public function delete($id)
  {
    $item = $this->crudModel->delete_item($id);
    redirect(base_url('crud'));
  }
}

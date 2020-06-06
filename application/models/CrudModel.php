<?php

class CrudModel extends CI_Model
{

  public function get_crud()
  {
    if (!empty($this->input->get("search"))) {
      $this->db->like('title', $this->input->get("search"));
      $this->db->or_like('description', $this->input->get("search"));
    }
    $query = $this->db->get("items");
    return $query->result();
  }


  public function insert_item()
  {
    $data = array(
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description')
    );
    return $this->db->insert('items', $data);
  }


  public function update_item($id)
  {

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $request = json_decode($stream_clean, true);

    $data = array(
      'title' => $this->input->post('title')? $this->input->post('title'): $request['title'],
      'description' => $this->input->post('description')?$this->input->post('description'):$request['description']
    );


    if ($id == 0) {
      return $this->db->insert('items', $data);
    } else {
      $this->db->where('id', $id);
      return $this->db->update('items', $data);
    }
  }


  public function find_item($id)
  {
    return $this->db->get_where('items', array('id' => $id))->row();
  }


  public function delete_item($id)
  {
    return $this->db->delete('items', array('id' => $id));
  }
}

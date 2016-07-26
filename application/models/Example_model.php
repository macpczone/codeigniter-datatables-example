<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example_model extends CI_Model
{

    public $table = 'people';
    public $id = 'id';
    public $order = 'DESC';
    public $certstore;

    function __construct()
    {
        parent::__construct();
		$this->certstore = $this->config->item('ca_data_dir');
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $row = $this->get_by_id($id);
        unlink($this->certstore . $row->filename);
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function deletearray($idarray)
    {
    	$n = 0;
 		foreach ($idarray as $id) {
	        $this->delete($id);
	        $n++;
	    }
	    return $n;
    }

}


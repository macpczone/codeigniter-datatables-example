<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('example_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'messages' => $this->_message_get(),
			'title' => 'Welcome to the Codeigniter Datatables Example page'
        );

        $this->load->view('example_list_ajax', $data);
    }

    public function read($id) 
    {
        $row = $this->example_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'firstname' => $row->firstname,
		'lastname' => $row->lastname,
		'address' => $row->address,
		'area' => $row->area,
		'postcode' => $row->postcode,
		'age' => $row->age,
		'created' => $row->created,
		'updated' => $row->updated,
		'deleted' => $row->deleted,
	    );
            $this->load->view('example_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('example'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('example/create_action'),
		'id' => NULL,
	    'firstname' => set_value('firstname'),
	    'lastname' => set_value('lastname'),
	    'address' => set_value('address'),
	    'area' => set_value('area'),
	    'postcode' => set_value('postcode'),
	    'age' => set_value('age'),
	);
        $this->load->view('example_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'firstname' => $this->input->post('firstname',TRUE),
		'lastname' => $this->input->post('lastname',TRUE),
		'address' => $this->input->post('address',TRUE),
		'area' => $this->input->post('area',TRUE),
		'postcode' => $this->input->post('postcode',TRUE),
		'age' => $this->input->post('age',TRUE),
	    );

            $this->example_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('example'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->example_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('example/update_action'),
		'id' => set_value('id', $row->id),
		'firstname' => set_value('firstname', $row->firstname),
		'lastname' => set_value('lastname', $row->lastname),
		'address' => set_value('address', $row->address),
		'area' => set_value('area', $row->area),
		'postcode' => set_value('postcode', $row->postcode),
		'age' => set_value('age', $row->age),
	    );
            $this->load->view('example_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('example'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'firstname' => $this->input->post('firstname',TRUE),
		'lastname' => $this->input->post('lastname',TRUE),
		'address' => $this->input->post('address',TRUE),
		'area' => $this->input->post('area',TRUE),
		'postcode' => $this->input->post('postcode',TRUE),
		'age' => $this->input->post('age',TRUE),
	    );

            $this->example_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('example'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->example_model->get_by_id($id);

        if ($row) {
            $this->example_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('example'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('example'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('firstname', ' ', 'trim|required');
	$this->form_validation->set_rules('lastname', ' ', 'trim|required');
	$this->form_validation->set_rules('address', ' ', 'trim|required');
	$this->form_validation->set_rules('area', ' ', 'trim|required');
	$this->form_validation->set_rules('postcode', ' ', 'trim|required');
	$this->form_validation->set_rules('age', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function deletechecks()
    {
    	$idarray = $this->input->post('id',TRUE);
/*    	echo '<pre>';
		var_dump($idarray);
		echo '</pre>';
		exit;*/
        $n = $this->certificates_model->deletearray($idarray);
        $this->_message_set($n . ' Records Have Been Successfully Deleted');
        redirect(site_url('certificates'));
    }

    public function _message_get()
    {
		if(!empty($_SESSION['messages'])) {
			$messages = $_SESSION['messages'];
			$_SESSION['messages'] = '';
			return $messages;
		}
		return '';

    }

    public function _message_set($messages)
    {
			$_SESSION['messages'] = $messages ;
    }

	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'example_dt', 'rowIdCol' => 'id'));
		
		$jsonArray = $this -> datatable -> datatableJson(array(
                'datetaken' => 'date',
                'id' => 'action1',
            ));
		$this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
		
	}
	
};


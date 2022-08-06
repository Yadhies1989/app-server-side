<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Latihan extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Serverside_model');
    }
    public function index()
    {
        $this->load->view('v_latihan');
    }

    public function viewajax()
	{
		$results = $this->db->query('select * from karyawan limit 10')->result();

		$data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->nama_depan;
			$row[] = $result->alamat;
            $row[] = $result->no_hp;
            
            $data[] = $row;
        }

        // var_dump($no);
        // die;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside_model->count_all_data(),
            "recordsFiltered" => $this->Serverside_model->count_filtered_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));							
	}
}

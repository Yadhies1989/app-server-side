<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serverside extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serverside_model');
    }
    public function index()
    {
        $data['title'] = "Serverside Project";
        $this->load->view('v_server-side', $data);
    }

    public function getData()
    {
        $results = $this->Serverside_model->getDataTabel();

        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->nama_depan;
            $row[] = $result->nama_belakang;
            $row[] = $result->alamat;
            $row[] = $result->no_hp;
            $row[] = '
            <a href="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->id . "', 'edit'" . ')">Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id . "', 'delete'" . ')">Hapus</a>
            ';

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

    public function add()
    {
        $this->_validation();
        $data = [
            'nama_depan' => htmlspecialchars($this->input->post('nama_depan')),
            'nama_belakang' => htmlspecialchars($this->input->post('nama_belakang')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp'))
        ];

        if ($this->Serverside_model->created($data) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function byid($id)
    {
        $data = $this->Serverside_model->getdataById($id);

        $this->output->set_content_type('application/json')->set_output(json_encode($data));

        // var_dump($data);
        // die;
    }

    public function update()
    {
        $this->_validation();
        $data = [
            'nama_depan' => htmlspecialchars($this->input->post('nama_depan')),
            'nama_belakang' => htmlspecialchars($this->input->post('nama_belakang')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'no_hp' => htmlspecialchars($this->input->post('no_hp'))
        ];

        if ($this->Serverside_model->update(array('id' => $this->input->post('id')), $data) >= 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id)
    {
        if ($this->Serverside_model->delete($id) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    private function _validation()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('nama_depan') == '') {
            $data['inputerror'][] = 'nama_depan';
            $data['error_string'][] = 'Nama Depan Wajib Diisi';
            $data['status'] = false;
        }

        if ($this->input->post('nama_belakang') == '') {
            $data['inputerror'][] = 'nama_belakang';
            $data['error_string'][] = 'Nama Belakang Wajib Diisi';
            $data['status'] = false;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'ALamat Wajib Diisi';
            $data['status'] = false;
        }

        if ($this->input->post('no_hp') == '') {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'Nomor HP Wajib Diisi';
            $data['status'] = false;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }
}

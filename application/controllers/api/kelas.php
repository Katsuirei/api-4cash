<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kelas extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kelas', 'm_k');
    }

    public function index_get()
    {
        $id = $this->get('id_kelas');
        if ($id === null){
            $kelas = $this->m_k->getKelas();
        } else{
            $kelas = $this->m_k->getKelas($id);
        }
        
        if ($kelas){
            $this->response([
                'status' => TRUE,
                'data' => $kelas
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'id not found!'
            ], REST_Controller::HTTP_NOT_FOUND);  
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id_kelas');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_k->deleteKelas($id) > 0) {
                // ok
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else{
                //  id not found
                $this->response([
                    'status' => FALSE,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama_kelas' => $this->post('nama_kelas')
        ];

        if( $this->m_k->createKelas($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Kelas has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put()
    {
        $id = $this->put('id_kelas');
        $data = [
            'nama_kelas' => $this->put('nama_kelas')
        ];

        if( $this->m_k->updateKelas($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Kelas has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }


}
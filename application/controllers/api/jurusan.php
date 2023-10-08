<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jurusan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_jurusan', 'm_j');
    }

    public function index_get()
    {
        $id = $this->get('id_jurusan');
        if ($id === null){
            $jurusan = $this->m_j->getJurusan();
        } else{
            $jurusan = $this->m_j->getJurusan($id);
        }
        
        if ($jurusan){
            $this->response([
                'status' => TRUE,
                'data' => $jurusan
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
        $id = $this->delete('id_jurusan');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_j->deleteJurusan($id) > 0) {
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
            'nama_jurusan' => $this->post('nama_jurusan')
        ];

        if( $this->m_j->createJurusan($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Jurusan has been created.'
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
        $id = $this->put('id_jurusan');
        $data = [
            'nama_jurusan' => $this->put('nama_jurusan')
        ];

        if( $this->m_j->updateJurusan($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Jurusan has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }


}
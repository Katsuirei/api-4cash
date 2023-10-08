<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jen_pem extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_jenpem', 'm_jp');
    }

    public function index_get()
    {
        $id = $this->get('id_jp');
        if ($id === null){
            $jenpem = $this->m_jp->getJenpem();
        } else{
            $jenpem = $this->m_jp->getJenpem($id);
        }
        
        if ($jenpem){
            $this->response([
                'status' => TRUE,
                'data' => $jenpem
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
        $id = $this->delete('id_jp');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_jp->deleteJenpem($id) > 0) {
                // ok
                $this->response([
                    'status' => TRUE,
                    'id_jp' => $id,
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
            'nama_pembayaran' => $this->post('nama_pembayaran'),
            'jenis_pembayaran' => $this->post('jenis_pembayaran'),
            'harga' => $this->post('harga')
        ];

        if( $this->m_jp->createJenpem($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Jenis Pembayaran has been created.'
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
        $id = $this->put('id_jp');
        $data = [
            'nama_pembayaran' => $this->put('nama_pembayaran'),
            'jenis_pembayaran' => $this->put('jenis_pembayaran'),
            'harga' => $this->put('harga')
        ];

        if( $this->m_jp->updateJenpem($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Jenis Pembayaran has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}


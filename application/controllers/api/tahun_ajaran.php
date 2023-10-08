
<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Tahun_ajaran extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ta', 'm_ta');
    }

    public function index_get()
    {
        $id = $this->get('id_ta');
        if ($id === null){
            $ta = $this->m_ta->getTa();
        } else{
            $ta = $this->m_ta->getTa($id);
        }
        
        if ($ta){
            $this->response([
                'status' => TRUE,
                'data' => $ta
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
        $id = $this->delete('id_ta');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_ta->deleteTa($id) > 0) {
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
            'tahun_mulai' => $this->post('tahun_mulai'),
            'tahun_selesai' => $this->post('tahun_selesai')
        ];

        if( $this->m_ta->createTa($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Tahun Ajaran has been created.'
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
        $id = $this->put('id_ta');
        $data = [
            'tahun_mulai' => $this->put('tahun_mulai'),
            'tahun_selesai' => $this->put('tahun_selesai')
        ];

        if( $this->m_ta->updateTa($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Tahun Ajaran has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}
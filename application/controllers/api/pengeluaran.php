
<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pengeluaran extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengeluaran', 'm_keluar');
    }

    public function index_get()
    {
        $id = $this->get('id_pengeluaran');
        if ($id === null){
            $pengeluaran = $this->m_keluar->getPengeluaran();
        } else{
            $pengeluaran = $this->m_keluar->getPengeluaran($id);
        }
        
        if ($pengeluaran){
            $this->response([
                'status' => TRUE,
                'data' => $pengeluaran
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
        $id = $this->delete('id_pengeluaran');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_keluar->deletePengeluaran($id) > 0) {
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
            'jenis_pengeluaran' => $this->post('jenis_pengeluaran'),
            'tanggal' => $this->post('tanggal'),
            'nominal' => $this->post('nominal'),
            'keterangan' => $this->post('keterangan')
        ];

        if( $this->m_keluar->createPengeluaran($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Pengeluaran has been created.'
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
        $id = $this->put('id_pengeluaran');
        $data = [
            'jenis_pengeluaran' => $this->put('jenis_pengeluaran'),
            'tanggal' => $this->put('tanggal'),
            'nominal' => $this->put('nominal'),
            'keterangan' => $this->put('keterangan')
        ];

        if( $this->m_keluar->updatePengeluaran($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Pengeluaran has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}
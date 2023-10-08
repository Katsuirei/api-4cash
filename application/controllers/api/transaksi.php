
<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaksi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi', 'm_tran');
    }

    public function index_get()
    {
        $id = $this->get('id_transaksi');
        if ($id === null){
            $transaksi = $this->m_tran->getTransaksi();
        } else{
            $transaksi = $this->m_tran->getTransaksi($id);
        }
        
        if ($transaksi){
            $this->response([
                'status' => TRUE,
                'data' => $transaksi
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
        $id = $this->delete('id_transaksi');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_tran->deleteTransaksi($id) > 0) {
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
            'tanggal' => $this->post('tanggal'),
            'siswa_id' => $this->post('siswa_id'),
            'operator_id' => $this->post('operator_id'),
            'jenis_pembayaranid' => $this->post('jenis_pembayaranid'),
            'jumlah' => $this->post('jumlah'),
            'keterangan' => $this->post('keterangan')
        ];

        if( $this->m_tran->createTransaksi($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Transaksi has been created.'
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
        $id = $this->put('id_transaksi');
        $data = [
            'tanggal' => $this->put('tanggal'),
            'siswa_id' => $this->put('siswa_id'),
            'operator_id' => $this->put('operator_id'),
            'jenis_pembayaranid' => $this->put('jenis_pembayaranid'),
            'jumlah' => $this->put('jumlah'),
            'keterangan' => $this->put('keterangan')
        ];

        if( $this->m_tran->updateTransaksi($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Transaksi has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}
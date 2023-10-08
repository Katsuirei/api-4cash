
<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Siswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_siswa', 'm_s');
    }

    public function index_get()
    {
        $id = $this->get('id_siswa');
        if ($id === null){
            $siswa = $this->m_s->getSiswa();
        } else{
            $siswa = $this->m_s->getSiswa($id);
        }
        
        if ($siswa){
            $this->response([
                'status' => TRUE,
                'data' => $siswa
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
        $id = $this->delete('id_siswa');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_s->deleteSiswa($id) > 0) {
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
            'nama_siswa' => $this->post('nama_siswa'),
            'nis' => $this->post('nis'),
            'nama_ortu' => $this->post('nama_ortu'),
            'no_hpsiswa' => $this->post('no_hpsiswa'),
            'no_hportu' => $this->post('no_hportu'),
            'alamat' => $this->post('alamat'),
            'status_siswa' => $this->post('status_siswa')
            // 'kelas_id' => $this->post('kelas_id'),
            // 'jurusan_id' => $this->post('jurusan_id'),
            // 'tahun_ajaranid' => $this->post('tahun_ajaranid')
        ];

        if( $this->m_s->createSiswa($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new Siswa has been created.'
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
        $id = $this->put('id_siswa');
        $data = [
            'nama_siswa' => $this->put('nama_siswa'),
            'nis' => $this->put('nis'),
            'nama_ortu' => $this->put('nama_ortu'),
            'no_hpsiswa' => $this->put('no_hpsiswa'),
            'no_hportu' => $this->put('no_hportu'),
            'alamat' => $this->put('alamat'),
            'status_siswa' => $this->put('status_siswa'),
            'kelas_id' => $this->put('kelas_id'),
            'jurusan_id' => $this->put('jurusan_id'),
            'tahun_ajaranid' => $this->put('tahun_ajaranid')
        ];

        if( $this->m_s->updateSiswa($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data Siswa has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}
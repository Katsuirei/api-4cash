
<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user', 'm_u');
    }

    public function index_get()
    {
        $id = $this->get('id_user');
        if ($id === null){
            $user = $this->m_u->getUser();
        } else{
            $user = $this->m_u->getUser($id);
        }
        
        if ($user){
            $this->response([
                'status' => TRUE,
                'data' => $user
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
        $id = $this->delete('id_user');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } else{
            if ($this->m_u->deleteUser($id) > 0) {
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
            'nama' => $this->post('nama'),
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'no_hp' => $this->post('no_hp'),
            'role' => $this->post('role')
        ];

        if( $this->m_u->createUser($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'new User has been created.'
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
        $id = $this->put('id_user');
        $data = [
            'nama' => $this->put('nama'),
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'no_hp' => $this->put('no_hp'),
            'role' => $this->put('role')
        ];

        if( $this->m_u->updateUser($data, $id) > 0)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'data User has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
 
    }

}
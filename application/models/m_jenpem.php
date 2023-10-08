<?php 

class M_jenpem extends CI_Model{

    public function getJenpem($id = null)
    {
        if( $id === null) {
        return $this->db->get('jenis_pembayaran')->result_array();  
        } else{
        return $this->db->get_where('jenis_pembayaran', ['id_jp' => $id])->result_array();  
        }
    }

    public function deleteJenpem($id)
    {
        $this->db->delete('jenis_pembayaran', ['id_jp' => $id]);
        return $this->db->affected_rows();
    }

    public function createJenpem($data)
    {
        $this->db->insert('jenis_pembayaran', $data);
        return $this->db->affected_rows();
    }

    public function updateJenpem($data, $id)
    {
        $this->db->update('jenis_pembayaran', $data, ['id_jp' => $id]);
        return $this->db->affected_rows();
    }
}
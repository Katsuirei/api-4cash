<?php 

class M_kelas extends CI_Model{

    public function getKelas($id = null)
    {
        if( $id === null) {
        return $this->db->get('kelas')->result_array();  
        } else{
        return $this->db->get_where('kelas', ['id_kelas' => $id])->result_array();  
        }
    }

    public function deleteKelas($id)
    {
        $this->db->delete('kelas', ['id_kelas' => $id]);
        return $this->db->affected_rows();
    }

    public function createKelas($data)
    {
        $this->db->insert('kelas', $data);
        return $this->db->affected_rows();
    }

    public function updateKelas($data, $id)
    {
        $this->db->update('kelas', $data, ['id_kelas' => $id]);
        return $this->db->affected_rows();
    }
}
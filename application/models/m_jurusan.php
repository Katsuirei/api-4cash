<?php 

class M_jurusan extends CI_Model{

    public function getJurusan($id = null)
    {
        if( $id === null) {
        return $this->db->get('jurusan')->result_array();  
        } else{
        return $this->db->get_where('jurusan', ['id_jurusan' => $id])->result_array();  
        }
    }

    public function deleteJurusan($id)
    {
        $this->db->delete('jurusan', ['id_jurusan' => $id]);
        return $this->db->affected_rows();
    }

    public function createJurusan($data)
    {
        $this->db->insert('jurusan', $data);
        return $this->db->affected_rows();
    }

    public function updateJurusan($data, $id)
    {
        $this->db->update('jurusan', $data, ['id_jurusan' => $id]);
        return $this->db->affected_rows();
    }
}
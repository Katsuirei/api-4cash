<?php 

class M_siswa extends CI_Model{

    public function getSiswa($id = null)
    {
        if( $id === null) {
        return $this->db->get('siswa')->result_array();  
        } else{
        return $this->db->get_where('siswa', ['id_siswa' => $id])->result_array();  
        }
    }

    public function deleteSiswa($id)
    {
        $this->db->delete('siswa', ['id_siswa' => $id]);
        return $this->db->affected_rows();
    }

    public function createSiswa($data)
    {
        $this->db->insert('siswa', $data);
        return $this->db->affected_rows();
    }

    public function updateSiswa($data, $id)
    {
        $this->db->update('siswa', $data, ['id_siswa' => $id]);
        return $this->db->affected_rows();
    }
}


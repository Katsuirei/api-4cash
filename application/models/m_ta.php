<?php 

class M_ta extends CI_Model{

    public function getTa($id = null)
    {
        if( $id === null) {
        return $this->db->get('tahun_ajaran')->result_array();  
        } else{
        return $this->db->get_where('tahun_ajaran', ['id_ta' => $id])->result_array();  
        }
    }

    public function deleteTa($id)
    {
        $this->db->delete('tahun_ajaran', ['id_ta' => $id]);
        return $this->db->affected_rows();
    }

    public function createTa($data)
    {
        $this->db->insert('tahun_ajaran', $data);
        return $this->db->affected_rows();
    }

    public function updateTa($data, $id)
    {
        $this->db->update('tahun_ajaran', $data, ['id_ta' => $id]);
        return $this->db->affected_rows();
    }
}


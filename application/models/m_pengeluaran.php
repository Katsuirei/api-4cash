<?php 

class M_pengeluaran extends CI_Model{

    public function getPengeluaran($id = null)
    {
        if( $id === null) {
        return $this->db->get('pengeluaran')->result_array();  
        } else{
        return $this->db->get_where('pengeluaran', ['id_pengeluaran' => $id])->result_array();  
        }
    }

    public function deletePengeluaran($id)
    {
        $this->db->delete('pengeluaran', ['id_pengeluaran' => $id]);
        return $this->db->affected_rows();
    }

    public function createPengeluaran($data)
    {
        $this->db->insert('pengeluaran', $data);
        return $this->db->affected_rows();
    }

    public function updatePengeluaran($data, $id)
    {
        $this->db->update('pengeluaran', $data, ['id_pengeluaran' => $id]);
        return $this->db->affected_rows();
    }
}


<?php 

class M_transaksi extends CI_Model{

    public function getTransaksi($id = null)
    {
        if( $id === null) {
        return $this->db->get('transaksi')->result_array();  
        } else{
        return $this->db->get_where('transaksi', ['id_transaksi' => $id])->result_array();  
        }
    }

    public function deleteTransaksi($id)
    {
        $this->db->delete('transaksi', ['id_transaksi' => $id]);
        return $this->db->affected_rows();
    }

    public function createTransaksi($data)
    {
        $this->db->insert('transaksi', $data);
        return $this->db->affected_rows();
    }

    public function updateTransaksi($data, $id)
    {
        $this->db->update('transaksi', $data, ['id_transaksi' => $id]);
        return $this->db->affected_rows();
    }
}


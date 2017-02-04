<?php
class Barang_m extends CI_Model{
 function __construct(){
 	parent::__construct();
 }
 
 // Berfungsi untuk mengambil data pada tabel user yang ada di database kita
public function add_barang($data) {
  $this->db->insert('barang', $data);
}

public function show_all() {
  $q = $this->db->order_by('id_barang','DESC')->join('supplier','supplier.id_supplier=barang.id_supplier'); 
    $q = $this->db->get('barang');
    return $q;
}

public function show_supplier() {
  $q = $this->db->order_by('id_supplier','DESC'); 
    $q = $this->db->get('supplier');
    return $q;
}

function show_sales2(){
 $this->db->select('id_sales, nama');
 
 $query = $this->db->get('sales');
 
 $sales2 = array();
 
 if($query->result()){
 foreach ($query->result() as $sales) {
 $sales2[$sales->id_sales] = $sales->nama;
 }
 return $sales2;
 }else{
 return FALSE;
 }
}

public function get_by_id($id) {
    $q = $this->db->where('id_barang',$id);
    $q = $this->db->get('barang');
    return $q;
}

public function get_by_id2($id)
    {
        $this->db->from('barang');
        $this->db->where('id_barang',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

public function edit_barang($id, $data){
    $this->db->where('id_barang', $id);
    $this->db->update('barang',$data); 
}

public function delete($id){
    $this->db->where('id_barang', $id);
    $this->db->delete('barang');
}

public function change_gambar($where, $data)
    {
        $this->db->update('barang', $data, $where);
        return $this->db->affected_rows();
    }


}
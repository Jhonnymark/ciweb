<?php
class Category_model extends CI_Model{
 
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
 
    /*
        Get all the records from the database
    */

        public function get_all() {
           $query = $this->db->get('category'); // Ensure the table name is correct
           return $query->result_array();
        }
     
    /*
        Store the record in the database
    */
    public function store()
    {    
        $data = [
            'cat_name'        => $this->input->post('cat_name')
        ];
 
        $result = $this->db->insert('category', $data);
        return $result;
    }
 
    /*
        Get an specific record from the database
    */
    public function get($cat_id)
    {
        $category = $this->db->get_where('category', ['cat_id' => $cat_id ])->row();
        return $category;
    }
 
 
    /*
        Update or Modify a record in the database
    */
    public function update($cat_id) 
    {
        $data = [
            'cat_name'        => $this->input->post('cat_name')
        ];
 
        $result = $this->db->where('cat_id',$cat_id)->update('category',$data);
        return $result;
                 
    }
 
    /*
        Destroy or Remove a record in the database
    */
    public function delete($cat_id)
    {
        $category = $this->db->get_where('category', ['cat_id' => $cat_id ])->row();
        $result = $this->db->delete('category', array('cat_id' => $cat_id));
        return $result;
    }
     
}
?>
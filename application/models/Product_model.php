<?php
class Product_model extends CI_Model{
 
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
 
    /*
        Get all the records from the database
    */
    public function get_all()
    {
        $projects = $this->db->get("products")->result();
        return $projects;
    }
 
    /*
        Store the record in the database
    */
    public function store($image)
    {    
        $data = [
            'prod_name'        => $this->input->post('prod_name'),
            'prod_desc' => $this->input->post('prod_desc'),
            'stock' => $this->input->post('stock'),
            'price' => $this->input->post('price'),
            'cat_id' => $this->input->post('cat_id'),
            'image' => $image
        ];
 
        $result = $this->db->insert('products', $data);
        return $result;
    }
 
    /*
        Get an specific record from the database
    */
    public function get($product_id)
    {
        $products = $this->db->get_where('products', ['product_id' => $product_id])->row();
        return $products;
    }
 
 
    /*
        Update or Modify a record in the database
    */
    public function update($product_id,$image) 
    {
        $data = [
            'prod_name'        => $this->input->post('prod_name'),
            'prod_desc' => $this->input->post('prod_desc'),
            'price'        => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'cat_id' => $this->input->post('cat_id'),
            'image' => $image
        ];
 
        $result = $this->db->where('product_id',$product_id)->update('products',$data);
        return $result;
                 
    }
 
    /*
        Destroy or Remove a record in the database
    */
    public function delete($product_id)
    {
        $products = $this->db->get_where('products', ['product_id' => $product_id ])->row();
        $path ='./images/'.$products->image;
        if (file_exists($path)){
            unlink($path);
        }
        $result = $this->db->delete('products', array('product_id' => $product_id));
        return $result;
    }

    public function get_categories() {
        // Fetch categories from the database and return them
        $query = $this->db->get('category');
        return $query->result_array();
    }
    public function get_product($product_id) {
        $query = $this->db->get_where('products', array('product_id' => $product_id));
        return $query->row();
    }

    public function get_products() {
        $query = $this->db->get('products');
        return $query->result();
    }
     
}
?>
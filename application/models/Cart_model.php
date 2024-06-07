<?php
class Cart_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_to_cart($data) {
        // Check if the product is already in the cart
        $this->db->where('product_id', $data['product_id']);
        $this->db->where('user_id', $data['user_id']);
        $query = $this->db->get('cart');

        if ($query->num_rows() > 0) {
            // If the product is already in the cart, update the quantity
            $this->db->set('quantity', 'quantity+'.$data['quantity'], FALSE);
            $this->db->where('product_id', $data['product_id']);
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('cart');
        } else {
            // If the product is not in the cart, insert a new record
            $this->db->insert('cart', $data);
        }
    }
    public function get_cart_items() {
        $this->db->select('products.prod_name, cart.quantity, products.price');
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.product_id');
        $query = $this->db->get();
        return $query->result();
    }

    // Calculate the total price of items in the cart
    public function get_total_price() {
        $this->db->select('SUM(cart.quantity * products.price) as total_price');
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.product_id');
        $query = $this->db->get();
        return $query->row()->total_price;
    }
    public function remove_item($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->delete('cart');
    }

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('Product_model');
        $this->load->library('session');
    }

    public function add() {
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity'); // Retrieve quantity from form input
        $user_id = $this->session->userdata('id'); // Assuming user ID is stored in session
    
        if ($product_id && $quantity && $user_id) {
            $product = $this->Product_model->get_product($product_id);
            
            if ($product) {
                $cart_data = array(
                    'product_id' => $product_id,
                    'user_id'    => $user_id,
                    'quantity'   => $quantity // Include quantity in cart data
                );
                $this->Cart_model->add_to_cart($cart_data);
                $this->session->set_flashdata('success', 'Product added to cart successfully!');
            } else {
                $this->session->set_flashdata('error', 'Product not found!');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid request!');
        }
    
        redirect('customer'); // Redirect to products page or any other page
    }
    public function cart_view() {
        // Retrieve the cart items for the user
        $data['cart'] = $this->cart_model->get_cart_items();
        // Calculate the total price of the items in the cart
        $data['total_price'] = $this->cart_model->get_total_price();
        // Load the cart view and pass the data
        $this->load->view('customer/cart_view', $data);
    }

    public function remove_from_cart($product_id) {
        // Remove an item from the cart
        $this->cart_model->remove_item($product_id);
        // Redirect to the shopping cart page
        redirect('cart_view');
    }

    public function checkout() {
        // Add your checkout logic here
        redirect('cart_view');
    }
    

}

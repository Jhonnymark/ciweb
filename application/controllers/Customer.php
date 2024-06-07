<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

   public function __construct() {
      parent::__construct(); 
      if(!$this->session->userdata('id')) {
         redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('Customer_model', 'customer');
   }

   /*
      Display all records in page
   */
   public function index() {
      $data['products'] = $this->customer->get_all();
      $data['title'] = "Products";    
      $this->load->view('customer/index', $data);
      $this->load->view('layout/footer');
   }

   /*
      Display a record
   */
  public function details($product_id) {
   $data['product'] = $this->customer->get_product($product_id);
   $data['title'] = 'Product Details';
   
   $this->load->view('customer/details', $data);

}

   /*
      Create a record page
   */
  public function add_product() {
   $data['title'] = "Add Products";
   $data['category'] = $this->products->get_categories(); // Assuming you have a method to fetch categories in your Product_model
   $this->load->view('layout/header');
   $this->load->view('products/add_product', $data);
   $this->load->view('layout/footer');     
}

   /*
      Save the submitted record
   */
  public function store() 
   
   {
      $config['upload_path'] = './images/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = 2000;
      $config['max_width'] = 1500;
      $config['max_height'] = 1500;

      $this->load->library('upload', $config);

      $this->form_validation->set_rules('prod_name', 'prod_name', 'required');
      $this->form_validation->set_rules('prod_desc', 'prod_desc', 'required');
      $this->form_validation->set_rules('price', 'price', 'required');
      $this->form_validation->set_rules('stock', 'stock', 'required');
      $this->form_validation->set_rules('cat_id', 'cat_id', 'required');

      if (!$this->form_validation->run()) {
         //$this->session->set_flashdata('errors', validation_errors());
         //redirect(base_url('index.php/project/create'));
         $response = [
            'status' => 'error',
            'errors'=> validation_errors()
         ];
      } else if (!$this->upload->do_upload('image')) {
         //$this->session->set_flashdata('errors', $this->upload->display_errors()); 
         //redirect(base_url('index.php/project/create'));
         $response = [
            'status' => 'error',
            'errors'=> $this->upload->display_errors()
         ];
      } else {
         $file_name = $this->upload->data('file_name');
         $this->products->store($file_name);
         //$this->session->set_flashdata('success', "Saved Successfully!");
         //redirect(base_url('index.php/project'));
         $response = [
            'status' => 'success',
            'message'=> 'Save Successfully!',
            'redirect' => base_url('index.php/products')
         ];
      }
   echo json_encode($response);
   }

   /*
      Edit a record page
   */
   public function edit_product($id) {
      $data['products'] = $this->products->get($id);
      $data['title'] = "Edit Products";
      $this->load->view('layout/header');
      $this->load->view('products/edit_product', $data);
      $this->load->view('layout/footer');     
   }

   /*
      Update the submitted record
   */
   public function update($id) {
      $config['upload_path'] = './images/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = 2000;
      $config['max_width'] = 1500;
      $config['max_height'] = 1500;

      $this->load->library('upload', $config);

      $this->form_validation->set_rules('prod_name', 'prod_name', 'required');
      $this->form_validation->set_rules('prod_desc', 'prod_desc', 'required');
      $this->form_validation->set_rules('price', 'price', 'required');
      $this->form_validation->set_rules('stock', 'stock', 'required');


      if (!$this->form_validation->run()) {
         $this->session->set_flashdata('errors', validation_errors());
         redirect(base_url('index.php/products/edit_product/' . $id));
      } else if (!$this->upload->do_upload('image')) {
         $this->session->set_flashdata('errors', $this->upload->display_errors()); 
         redirect(base_url('index.php/products/edit_product/' . $id));
      } else {
         $file_name = $this->upload->data('file_name');
         $this->products->update($id, $file_name);
         $this->session->set_flashdata('success', "Updated Successfully!");
         redirect(base_url('index.php/products'));
      }
   }

   /*
      Delete a record
   */
   public function delete($id) {
      $item = $this->products->delete($id);
      $this->session->set_flashdata('success', "Deleted Successfully!");
      redirect(base_url('index.php/products'));
   }

   /*
      Logout user
   */
   public function logout() {
      $data = $this->session->all_userdata();
      foreach ($data as $key => $value) {
         $this->session->unset_userdata($key);
      }
      redirect(base_url('index.php/login'));
   }
}


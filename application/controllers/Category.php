<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

   public function __construct() {
      parent::__construct(); 
      if(!$this->session->userdata('id')) {
         redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('Category_model', 'category');
   }

   /*
      Display all records in page
   */
   public function index() {
      $data['category'] = $this->category->get_all();
      $data['title'] = "Category List";
      $this->load->view('layout/header');       
      $this->load->view('category/index', $data);
      $this->load->view('layout/footer');
   }

   /*
      Display a record
   */
   public function show($cat_id) {
      $data['category'] = $this->category->get($cat_id);
      $data['title'] = "Show Project";
      $this->load->view('layout/header');
      $this->load->view('project/show', $data);
      $this->load->view('layout/footer'); 
   }

   /*
      Create a record page
   */
  public function add_category() {
    $data['title'] = "Add Products";
    $data['category'] = $this->category->get_all(); // Fetch all categories
    $this->load->view('layout/header');
    $this->load->view('category/add_category', $data);
    $this->load->view('layout/footer');     
 }
   /*
      Save the submitted record
   */
   public function store() {
      $this->form_validation->set_rules('cat_name', 'cat_name', 'required');

      if (!$this->form_validation->run()) {
         $response = [
            'status' => 'error',
            'errors'=> validation_errors()
         ];
      } else {
         $this->category->store();
         $response = [
            'status' => 'success',
            'message'=> 'Save Successfully!',
            'redirect' => base_url('index.php/category')
         ];
      }
      echo json_encode($response);
   }

   /*
      Edit a record page
   */
  public function edit_category($cat_id) {
    $data['category'] = $this->category->get($cat_id);
    $data['title'] = "Edit Products";
    $data['category'] = $this->category->get_all(); // Fetch all categories
    $this->load->view('layout/header');
    $this->load->view('category/edit_category', $data);
    $this->load->view('layout/footer');     
 }

   /*
      Update the submitted record
   */
   public function update($cat_id) {
      $this->form_validation->set_rules('cat_name', 'cat_name', 'required');

      if (!$this->form_validation->run()) {
         $this->session->set_flashdata('errors', validation_errors());
         redirect(base_url('index.php/category/edit_category/' . $cat_id));
      } else {
         $this->category->update($cat_id);
         $this->session->set_flashdata('success', "Updated Successfully!");
         redirect(base_url('index.php/category'));
      }
   }

   /*
      Delete a record
   */
   public function delete($cat_id) {
      $this->category->delete($cat_id);
      $this->session->set_flashdata('success', "Deleted Successfully!");
      redirect(base_url('index.php/category'));
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
?>

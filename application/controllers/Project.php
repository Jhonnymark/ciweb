<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

   public function __construct() {
      parent::__construct(); 
      if(!$this->session->userdata('id')) {
         redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('Project_model', 'project');
   }

   /*
      Display all records in page
   */
   public function index() {
      $data['projects'] = $this->project->get_all();
      $data['title'] = "CodeIgniter Project Manager";
      $this->load->view('layout/header');       
      $this->load->view('project/index', $data);
      $this->load->view('layout/footer');
   }

   /*
      Display a record
   */
   public function show($id) {
      $data['project'] = $this->project->get($id);
      $data['title'] = "Show Project";
      $this->load->view('layout/header');
      $this->load->view('project/show', $data);
      $this->load->view('layout/footer'); 
   }

   /*
      Create a record page
   */
   public function create() {
      $data['title'] = "Create Project";
      $this->load->view('layout/header');
      $this->load->view('project/create', $data);
      $this->load->view('layout/footer');     
   }

   /*
      Save the submitted record
   */
   public function store() {
      $config['upload_path'] = './images/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = 2000;
      $config['max_width'] = 1500;
      $config['max_height'] = 1500;

      $this->load->library('upload', $config);

      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');

      if (!$this->form_validation->run()) {
         $this->session->set_flashdata('errors', validation_errors());
         redirect(base_url('index.php/project/create'));
      } else if (!$this->upload->do_upload('image')) {
         $this->session->set_flashdata('errors', $this->upload->display_errors()); 
         redirect(base_url('index.php/project/create'));
      } else {
         $file_name = $this->upload->data('file_name');
         $this->project->store($file_name);
         $this->session->set_flashdata('success', "Saved Successfully!");
         redirect(base_url('index.php/project'));
      }
   }

   /*
      Edit a record page
   */
   public function edit($id) {
      $data['project'] = $this->project->get($id);
      $data['title'] = "Edit Project";
      $this->load->view('layout/header');
      $this->load->view('project/edit', $data);
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

      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');

      if (!$this->form_validation->run()) {
         $this->session->set_flashdata('errors', validation_errors());
         redirect(base_url('index.php/project/edit/' . $id));
      } else if (!$this->upload->do_upload('image')) {
         $this->session->set_flashdata('errors', $this->upload->display_errors()); 
         redirect(base_url('index.php/project/edit/' . $id));
      } else {
         $file_name = $this->upload->data('file_name');
         $this->project->update($id, $file_name);
         $this->session->set_flashdata('success', "Updated Successfully!");
         redirect(base_url('index.php/project'));
      }
   }

   /*
      Delete a record
   */
   public function delete($id) {
      $item = $this->project->delete($id);
      $this->session->set_flashdata('success', "Deleted Successfully!");
      redirect(base_url('index.php/project'));
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

<h2 class="text-center mt-5 mb-3"><?php echo $title;?></h2>
<div class="card">
    <div class="card-header">
        <a class="btn btn-outline-info float-right" href="<?php echo base_url('index.phpproject/');?>"> 
            View All Projects
        </a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('errors')) {?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('errors'); ?>
            </div>
        <?php } ?>
 
        <form action="<?php echo base_url('index.php/category/update/' . $category->cat_id);?>" method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="cat_name">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="cat_name"
                    name="cat_name"
                    value="<?php echo $category->cat_name;?>">
            </div>
            <button type="submit" class="btn btn-outline-primary">Save Project</button>
        </form>
       
    </div>
</div>
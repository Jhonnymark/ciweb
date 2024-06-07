<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
<div class="card">
    <div class="card-header">
        <a class="btn btn-outline-info float-right" href="<?php echo base_url('index.php/project');?>"> 
            View All Projects
        </a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('errors')) {?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('errors'); ?>
            </div>
        <?php } ?>
        <form id="projectForm" class="<?php echo base_url('index.php/products/store');?>" method="POST" enctype="multipart/form-data">
        <div id="messages"></div>
        
            <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name">
            </div>
            <div class="form-group">
                <label for="prod_desc">Description</label>
                <textarea class="form-control" id="prod_desc" rows="3" name="prod_desc"></textarea>
            </div>
            <div class="form-group">   
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">   
                <label for="stock">Stocks</label>
                <input type="text" class="form-control" id="stock" name="stock">
            </div>
            <div class="form-group">
                <label for="cat_id">Category</label>
                <select class="form-control" id="cat_id" name="cat_id">
                    <option value="">Select Category</option>
                    <?php if(isset($category) && !empty($category)) { ?>
                        <?php foreach ($category as $category) { ?>
                            <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">No categories available</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Select Image</label>
                <input class="form-control" type="file" name="image" onchange="previewImage(event)"> 
                <img class="img-fluid" id="imagePreview" style="width: 150px; height: 150px; display:none">
            </div>

            <button type="submit" class="btn btn-outline-primary">Save Project</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#projectForm').on('submit', function(e){
        e.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: '<?php echo base_url("index.php/products/store"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                if(response.status =='error') {
                    $('#messages').html('<div class="alert alert-danger">' + response.errors+ '</div>');
                }
                else if(response.status =='success') {
                    $('#messages').html('<div class="alert alert-success">' + response.message+ '</div>');
                    setTimeout(function(){
                        window.location.href = response.redirect;
                    },1000);
                }
            }
        });
    });
});

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('imagePreview');
        output.style.display='block';
        output.src=reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

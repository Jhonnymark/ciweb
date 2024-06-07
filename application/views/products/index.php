<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<!-- JSZip for Excel export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfmake for PDF export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<!-- Buttons JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<style>
    .dt-buttons .dt-button{
        background-color: green;
        color: black;
    }
</style>
<h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
<div class="card">
    <div class="card-header">
        <a class="btn btn-outline-primary" href="<?php echo base_url('index.php/products/add_product/');?>"> 
            Add New Product
        </a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')) {?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
 
        <table id="projectTable" class="table table-bordered">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stocks</th>
                <th>Image</th>
                <th width="240px">Action</th>
            </tr>
        </thead>
            <?php foreach ($products as $product) { ?>      
            <tr>
                <td><?php echo $product->prod_name; ?></td>
                <td><?php echo $product->prod_desc; ?></td> 
                <td><?php echo $product->price; ?></td>
                <td><?php echo $product->stock; ?></td> 
                <td><img src="<?php echo '../images/'.$product->image; ?>" style=" width: 50px; height; 50px;"></td>     
                        
                <td>
                    <a
                        class="btn btn-outline-success"
                        href="<?php echo base_url('index.php/products/edit_product/'.$product->product_id) ?>"> 
                        Edit
                    </a>
                    
                    <a class="btn btn-outline-danger" href="#" onclick="confirmDelete('<?php echo base_url('index.php/products/delete/' . $product->product_id); ?>')">
                        Delete
                 </a>
                 <script>
    $(document).ready(function() {
        // Ensure DataTable is only initialized once
        if (!$.fn.dataTable.isDataTable('#projectTable')) {
            $('#projectTable').DataTable({
                "paging": true,
                "searching": true,
                "pageLength": 15,
                "lenghtMenu":[1,2,3,5,10],
            });
        }
    });



            function confirmDelete(url) {
            if (confirm("Are you sure you want to delete this project?")) {
            window.location.href = url;
                     }
                 }
              </script>

                    
                </td>  
               
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
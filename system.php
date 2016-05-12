<?php
include_once('include/navbar.php');


if (isset($_POST['addCategory'])) {
	$category = new category();
	$category->setName($_POST['categoryName']);
	$category->addCategory();
}
if (isset($_POST['deleteCategory'])) {
	$category = new category();
	$category->setId($_POST['categoryId']);
	$category->delete();

}
if (isset($_POST['editCategory'])) {
	$category = new category();
	$category->setName($_POST['categoryName']);
	$category->setId($_POST['categoryId']);
	$category->update();

}

if (isset($_POST['addSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setCategoryId($_POST['categoryId']);
	$subCategory->addSubCategory();

}
if (isset($_POST['editSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setId($_POST['subCategoryId']);
	$subCategory->update();

}
if (isset($_POST['deleteSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setId($_POST['subCategoryId']);
	$subCategory->delete();

}


?>

<script>
// set active menu bar 
$("#dashboard").removeClass("active");
$("#reports").removeClass("active");
$('#tickets').removeClass("active");
$('#system').addClass("active");


$(document).ready(function($) {
  
  $('#selectCategory').change(function(e) {
    //Grab the chosen value on first select list change
    var selectvalue = $(this).val();
 
    if (selectvalue == "") {
		//Display initial prompt in target select if blank value selected
	        $('#subCategoryDisplay').html("");
    } else {
      //Make AJAX request, using the selected value as the GET
      $.ajax({url: './include/ajax/getSubCategory.php?svalue='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#subCategoryDisplay').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
        }
    });
});

</script> 

<body>
<div id="content">
		<div id="displayCategories" class="panel panel-default">
        		<div class="panel-heading">Category Maintenace</div>
	        	<?php 
	        	if ($_GET['maintenace'] == 'users') {
	        		echo 'user';
	        	}
	        	if ($_GET['maintenace'] == 'system') {
	        		system::displaySettings();
	        	}
	        	if ($_GET['maintenace'] == 'categories') { ?>
		        	<div class="panel-body">
			        	<form class="form-inline" method="POST">
						<div class="form-group">
							<label for="categoryName">Category Name</label>
							<input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="ACME System">
						</div>
						<button type="submit" name="addCategory" class="btn btn-success">Add Category</button>
					</form>
					<form class="form-inline" method="POST">
						<div class="form-group">
							<label for="categoryId">Category</label>
				                        <select class="form-control" id="categoryId" name="categoryId">
				                        	<?php category::displayCategoryOptionList(); ?>
				                        
				                       </select>
						</div>
						<div class="form-group">
							<label for="subCategoryName">Sub Category Name</label>
							<input type="text" class="form-control" name="subCategoryName" id="subCategoryName" placeholder="system issue">
						</div>
						<button type="submit" name="addSubCategory" class="btn btn-success">Add Sub Category</button>
					</form>
				</div>
			</div>
				
	 		<div id="displayCategories" class="panel panel-default">
        			<div class="panel-heading">Categories</div>
		        		<?php category::displayCategoryEditList(); ?>       
	        	</div> 	
	 		
	 		<div id="displaySubCategories" class="panel panel-default">
        			<div class="panel-heading">Sub Categories</div>
        			<div class="panel=body"> 
  
					<select class="form-control" id="selectCategory">
						<?php category::displayCategoryOptionList(); ?>	
					</select>
	

			        	<div id="subCategoryDisplay"></div>
    
			        </div>
        			
        		</div>
       		</div>
       		
       		
        		
       		 <?php } ?>

</div>
</body>
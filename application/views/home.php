<div class="container">
	<h1 class="heading">CI AJAX CRUD</h1> <br>
	<div class="row">
		<div class="col-md-10">
			<h3 class="title">Car Models</h3>
		</div>
		<div class="col-md-2">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#CarModal">
			Add New
			</button>
		</div>
	</div>
	<div class="row divide">
		<div class="col-md-12">
		<table class="table table-striped">
		<thead>
			<tr>
			<th scope="col">ID</th>
			<th scope="col">Name</th>
			<th scope="col">Price</th>
			<th scope="col">Transmission</th>
			<th scope="col">Color</th>
			<th scope="col">Created At</th>
			<th scope="col">Updated At</th>
			<th scope="col" style="text-align:center;">Actions</th>
			</tr>
		</thead>

			<tbody id="allCars">                    
			</tbody>

		</table>
		</div>
	</div>

</div>








<!-- Bootstrap Modal for SAVE DATA -->

<div class="modal fade" id="CarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Car Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="post" id="saveCarInfo">
			<div class="form-group">
				<input type="text" name="name" id="name" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Name">
			</div>
			<div class="form-group">
				<input type="price" name="price" id="price" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Price">
			</div>
			<div class="form-group">
				<select name="transmission" id="transmission" class="form-control">
					<option>Transmission Type</option>
					<option value="Automatic">Automatic</option>
					<option value="Manual">Manual</option>
				</select>		
			</div>
			<div class="form-group">
				<input type="text" name="color" id="color" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Color">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>


<!-- Bootstrap Modal for EDIT DATA -->

<div class="modal fade" id="editCarModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Car Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="post" id="saveCarInfo">
			<div class="form-group">
				<input type="text" name="edit_name" id="edit_name" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Name">
			</div>
			<div class="form-group">
				<input type="price" name="edit_price" id="edit_price" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Price">
			</div>
			<div class="form-group">
				<select name="transmission" name="edit_transmission" id="edit_transmission" class="form-control">
					<option>Transmission Type</option>
					<option value="Automatic">Automatic</option>
					<option value="Manual">Manual</option>
				</select>		
			</div>
			<div class="form-group">
				<input type="text" name="edit_color" id="edit_color" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Color">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="hidden" name="edit_id" id="edit_id" class="form-control">
				<button type="submit" class="btn btn-primary">Update changes</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

$(document).ready(function() {
    listEmployee();
});

$("body").on("submit","#saveCarInfo", function(e) {
	e.preventDefault();
	$.ajax({
		url: '<?php echo base_url('/CarController/storeCar'); ?>',
		type: 'post',
		data: $(this).serializeArray(),
		// dataType: 'json',
		success: function(response) {
			console.log(response);
			$('#CarModal').modal('hide');
			listEmployee();
			Swal.fire({
			  position: 'center',
			  icon: 'success',
			  title: 'Your Car Has Been Saved',
			  showConfirmButton: false,
			  timer: 1500
			});
		}
	})
});




function listEmployee(){
	$.ajax({
		type  : 'ajax',
		url   : '<?php echo base_url('/CarController/allCars'); ?>',
		async : false,
		dataType : 'json',
		success : function(data){
			var html = '';
			var i;
			for(i=0; i<data.length; i++){

				html += '<tr>'+
						'<th scope="row">'+data[i].id+'</th>'+
						'<td id="get_name">'+data[i].name+'</td>'+
						'<td>'+data[i].price+'</td>'+
						'<td>'+data[i].transmission+'</td>'+
						'<td>'+data[i].color+'</td>'+
						'<td>'+data[i].created_at+'</td>'+
						'<td>'+data[i].updated_at+'</td>'+
						'<td align="center">'
							+'<a href="javascript:void(0);" class="btn btn-primary" style="margin:0 10px;" id="openEditCarModal" data-id="'+data[i].id+'" data-name="'+data[i].name+'" data-price="'+data[i].price+'" data-transmission="'+data[i].transmission+'" data-color="'+data[i].color+'">Edit</a>'
							+'<button class="btn btn-danger">Delete</button>'+
							'</td>'+
						'</tr>';
			}
			$('#allCars').html(html);					
		}
	});
}


$("body").on("click","#openEditCarModal", function(data){
	
	var car_id = $(this).attr( "data-id" );
	var	car_name = $(this).attr( "data-name" );
	var	car_price = $(this).attr( "data-price" );
	var car_transmission = $(this).attr( "data-transmission" );
	var car_color = $(this).attr( "data-color" );

	$("#edit_id").val(car_id);
	$("#edit_name").val(car_name);
	$("#edit_price").val(car_price);
	$("#edit_transmission").val(car_transmission);
	$("#edit_color").val(car_color);

	$('#editCarModal').modal('show');

});


</script>

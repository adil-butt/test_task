<!-- DataTables Example -->
<div class="card my-3">
	<div class="card-header">
		All Addresses
	</div>
	<?php $this->load->view('template/success_error_message'); ?>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>Person Name</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($addresses as $address) { ?>
					<tr>
						<td><?php echo $address['person_name'] ?></td>
						<td id="pAddressRow<?php echo $address['address_id'] ?>"><?php echo $address['address'] ?></td>
						<td><button data-id="<?php echo $address['address_id'] ?>" type="button" class="btn btn-outline-secondary editAddress">Edit</button>
							<a href="<?php echo base_url('Admin/delete');?>?delete=delete_address&delete_id=<?php echo $address['address_id'] ?>" class="btn btn-outline-secondary">Delete</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('Admin/addContactPersonAddress') ?>" id="editAddressForm" class="forms-sample">
					<input type="hidden" class="form-control" id="pUpdateAddressId" name="pUpdateAddressId">
					<div class="form-group">
						<label for="pUpdateAddress">Person Address</label>
						<input type="text" class="form-control" id="pUpdateAddress" name="pAddress" placeholder="Person's Address">
					</div>
					<button type="button" id="updatePersonAddressButton" class="btn btn-gradient-primary mr-2">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

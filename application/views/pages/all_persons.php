<!-- DataTables Example -->
<div class="card my-3">
	<div class="card-header">
		All Persons
	</div>
	<?php $this->load->view('template/success_error_message'); ?>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>Person Name</th>
					<th>Company Name</th>
					<th>Default</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($persons as $person) { ?>
					<tr>
						<td id="pNameRow<?php echo $person['person_id'] ?>"><?php echo $person['person_name'] ?></td>
						<td id="pCNameRow<?php echo $person['person_id'] ?>"><?php echo $person['company_name'] ?></td>
						<td id="pDefault<?php echo $person['person_id'] ?>"><?php echo ($person['default_person']=='1')?'Yes':'No';?></td>
						<td><button data-id="<?php echo $person['person_id'] ?>" type="button" class="btn btn-outline-secondary editPerson">Edit</button>
							<a href="<?php echo base_url('Admin/delete');?>?delete=delete_person&delete_id=<?php echo $person['person_id'] ?>" class="btn btn-outline-secondary">Delete</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Edit Person Modal -->
<div class="modal fade" id="editPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Person</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('Admin/addContactPerson') ?>" id="personUpdateForm" class="forms-sample">
					<input type="hidden" class="form-control" id="personId" name="personId" value="<?php echo set_value('personId'); ?>">
					<div class="form-group">
						<label for="pUpdateName">Person Name</label>
						<input type="text" class="form-control" id="pUpdateName" name="pName" placeholder="Person Name">
					</div>
					<div class="form-group">
						<label for="pCompany">Company</label>
						<select class="form-control" id="pUpdateCompany" name="pCompany">
							<?php $companies = $this->CompanyModel->getResult(); ?>
							<?php foreach ($companies as $company): ?>
								<option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" id="makeDefaultUpdate" name="makeDefault"> Make As Default </label>
						</div>
					</div>
					<button id="updatePersonButton" type="button" class="btn btn-gradient-primary mr-2">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

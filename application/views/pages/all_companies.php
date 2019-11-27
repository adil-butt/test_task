
<!-- DataTables Example -->
<div class="card my-3">
	<div class="card-header">
		All Companies
	</div>
	<?php $this->load->view('template/success_error_message'); ?>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>Company Name</th>
					<th>Company Address</th>
					<th>Company Email</th>
					<th>Phone</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($companies as $company) { ?>
					<tr>
						<td id="cNameRow<?php echo $company['id']; ?>"><?php echo $company['company_name'] ?></td>
						<td id="cAddressRow<?php echo $company['id']; ?>"><?php echo $company['company_address'] ?></td>
						<td id="cEmailRow<?php echo $company['id']; ?>"><?php echo $company['company_email'] ?></td>
						<td id="cPhoneRow<?php echo $company['id']; ?>"><?php echo $company['company_phone'] ?></td>
						<td><button data-id="<?php echo $company['id'] ?>" type="button" class="btn btn-outline-secondary editCompany">Edit</button>
							<a href="<?php echo base_url('Admin/delete');?>?delete=delete_company&delete_id=<?php echo $company['id'] ?>" class="btn btn-outline-secondary">Delete</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Edit Company Modal -->
<div class="modal fade" id="editCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Company</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('Admin/addCompany') ?>" id="comUpdateForm" class="forms-sample">
					<input type="hidden" class="form-control" id="companyId" name="companyId" value="<?php echo set_value('companyId'); ?>">
					<div class="form-group">
						<label for="comName">Company Name</label>
						<input type="text" class="form-control" id="comUpdateName" name="comName" placeholder="Company Name">
					</div>
					<div class="form-group">
						<label for="comAddress">Company Address</label>
						<input type="text" class="form-control" id="comUpdateAddress" name="comAddress" placeholder="Company's Address">
					</div>
					<div class="form-group">
						<label for="comPhone">Company Email</label>
						<input type="email" class="form-control" id="comUpdateEmail" name="comEmail" placeholder="Company's Email Address">
					</div>
					<div class="form-group">
						<label for="comPhone">Company Phone</label>
						<input type="text" class="form-control" id="comUpdatePhone" name="comPhone" placeholder="Company's Phone">
					</div>
					<button id="updateCompanyButton" type="button" class="btn btn-gradient-primary mr-2">Update</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

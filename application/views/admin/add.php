<div class="page-header">
	<h3 class="page-title"> Add Company, Contact Person and Address </h3>
</div>
<div class="row">
	<div class="col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<?php $this->load->view('template/success_error_message'); ?>
				<div class="my-3">
					<h4>Select Category</h4>
					<button id="selectCButton" type="button" class="btn btn-primary btn-sm">Company</button>
					<button id="selectCPButton" type="button" class="btn btn-secondary btn-sm">Contact Person</button>
					<button id="selectAButton" type="button" class="btn btn-secondary btn-sm">Address</button>
				</div>
				<h4 id="cardTitle" class="card-title">Add Company</h4>
				<p id="cardDescription" class="card-description"> Add your company below </p>
				<form method="post" action="<?php echo base_url('Admin/addCompany') ?>" id="comForm" class="forms-sample">
					<div class="form-group">
						<label for="comName">Company Name</label>
						<?php echo form_error('comName', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="text" class="form-control" id="comName" name="comName" value="<?php echo set_value('comName'); ?>" placeholder="Company Name">
					</div>
					<div class="form-group">
						<label for="comAddress">Company Address</label>
						<?php echo form_error('comAddress', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="text" class="form-control" id="comAddress" name="comAddress" value="<?php echo set_value('comAddress'); ?>" placeholder="Company's Address">
					</div>
					<div class="form-group">
						<label for="comPhone">Company Email</label>
						<?php echo form_error('comEmail', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="email" class="form-control" id="comEmail" name="comEmail" value="<?php echo set_value('comEmail'); ?>" placeholder="Company's Email Address">
					</div>
					<div class="form-group">
						<label for="comPhone">Company Phone</label>
						<?php echo form_error('comPhone', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="text" class="form-control" id="comPhone" name="comPhone" value="<?php echo set_value('comPhone'); ?>" placeholder="Company's Phone">
					</div>
					<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					<button class="btn btn-light">Cancel</button>
				</form>
				<form method="post" action="<?php echo base_url('Admin/addContactPerson') ?>" id="cPersonForm" class="forms-sample" style="display:none;">
					<div class="form-group">
						<label for="pName">Person Name</label>
						<?php echo form_error('pName', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="text" class="form-control" id="pName" name="pName" placeholder="Person Name">
					</div>
					<div class="form-group">
						<label for="pCompany">Company</label>
						<?php echo form_error('pCompany', '<p class="alert alert-warning" role="alert">'); ?>
						<select class="form-control" id="pCompany" name="pCompany">
							<?php foreach ($companies as $company): ?>
							<option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" name="makeDefault"> Make As Default </label>
						</div>
					</div>
					<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					<button class="btn btn-light">Cancel</button>
				</form>
				<form method="post" action="<?php echo base_url('Admin/addContactPersonAddress') ?>" id="addressForm" class="forms-sample" style="display: none">
					<div class="form-group">
						<label for="pAddName">Person Name</label>
						<?php echo form_error('pAddName', '<p class="alert alert-warning" role="alert">'); ?>
						<select class="form-control" id="pAddName" name="pAddName">
							<?php foreach ($persons as $person): ?>
							<option value="<?php echo $person['id']; ?>"><?php echo $person['person_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="pAddress">Person Address</label>
						<?php echo form_error('pAddress', '<p class="alert alert-warning" role="alert">'); ?>
						<input type="text" class="form-control" id="pAddress" name="pAddress" placeholder="Person's Address">
					</div>
					<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					<button class="btn btn-light">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>

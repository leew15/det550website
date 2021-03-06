<?php echo form_open('cadet/edit/'.$cadet['rin'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="admin" class="col-md-4 control-label">Admin</label>
		<div class="col-md-8">
			<input type="checkbox" name="admin" value="1" <?php echo ($cadet['admin']==1 ? 'checked="checked"' : ''); ?> id='admin' />
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-md-4 control-label">Password</label>
		<div class="col-md-8">
			<input type="text" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $cadet['password']); ?>" class="form-control" id="password" />
		</div>
	</div>
	<div class="form-group">
		<label for="firstName" class="col-md-4 control-label">FirstName</label>
		<div class="col-md-8">
			<input type="text" name="firstName" value="<?php echo ($this->input->post('firstName') ? $this->input->post('firstName') : $cadet['firstName']); ?>" class="form-control" id="firstName" />
		</div>
	</div>
	<div class="form-group">
		<label for="rank" class="col-md-4 control-label">Rank</label>
		<div class="col-md-8">
			<input type="text" name="rank" value="<?php echo ($this->input->post('rank') ? $this->input->post('rank') : $cadet['rank']); ?>" class="form-control" id="rank" />
		</div>
	</div>
	<div class="form-group">
		<label for="primaryEmail" class="col-md-4 control-label">PrimaryEmail</label>
		<div class="col-md-8">
			<input type="text" name="primaryEmail" value="<?php echo ($this->input->post('primaryEmail') ? $this->input->post('primaryEmail') : $cadet['primaryEmail']); ?>" class="form-control" id="primaryEmail" />
		</div>
	</div>
	<div class="form-group">
		<label for="secondaryEmail" class="col-md-4 control-label">SecondaryEmail</label>
		<div class="col-md-8">
			<input type="text" name="secondaryEmail" value="<?php echo ($this->input->post('secondaryEmail') ? $this->input->post('secondaryEmail') : $cadet['secondaryEmail']); ?>" class="form-control" id="secondaryEmail" />
		</div>
	</div>
	<div class="form-group">
		<label for="primaryPhone" class="col-md-4 control-label">PrimaryPhone</label>
		<div class="col-md-8">
			<input type="text" name="primaryPhone" value="<?php echo ($this->input->post('primaryPhone') ? $this->input->post('primaryPhone') : $cadet['primaryPhone']); ?>" class="form-control" id="primaryPhone" />
		</div>
	</div>
	<div class="form-group">
		<label for="secondaryPhone" class="col-md-4 control-label">SecondaryPhone</label>
		<div class="col-md-8">
			<input type="text" name="secondaryPhone" value="<?php echo ($this->input->post('secondaryPhone') ? $this->input->post('secondaryPhone') : $cadet['secondaryPhone']); ?>" class="form-control" id="secondaryPhone" />
		</div>
	</div>
	<div class="form-group">
		<label for="flight" class="col-md-4 control-label">Flight</label>
		<div class="col-md-8">
			<input type="text" name="flight" value="<?php echo ($this->input->post('flight') ? $this->input->post('flight') : $cadet['flight']); ?>" class="form-control" id="flight" />
		</div>
	</div>
	<div class="form-group">
		<label for="position" class="col-md-4 control-label">Position</label>
		<div class="col-md-8">
			<input type="text" name="position" value="<?php echo ($this->input->post('position') ? $this->input->post('position') : $cadet['position']); ?>" class="form-control" id="position" />
		</div>
	</div>
	<div class="form-group">
		<label for="groupMe" class="col-md-4 control-label">GroupMe</label>
		<div class="col-md-8">
			<input type="text" name="groupMe" value="<?php echo ($this->input->post('groupMe') ? $this->input->post('groupMe') : $cadet['groupMe']); ?>" class="form-control" id="groupMe" />
		</div>
	</div>
	<div class="form-group">
		<label for="middleName" class="col-md-4 control-label">MiddleName</label>
		<div class="col-md-8">
			<input type="text" name="middleName" value="<?php echo ($this->input->post('middleName') ? $this->input->post('middleName') : $cadet['middleName']); ?>" class="form-control" id="middleName" />
		</div>
	</div>
	<div class="form-group">
		<label for="lastName" class="col-md-4 control-label">LastName</label>
		<div class="col-md-8">
			<input type="text" name="lastName" value="<?php echo ($this->input->post('lastName') ? $this->input->post('lastName') : $cadet['lastName']); ?>" class="form-control" id="lastName" />
		</div>
	</div>
	<div class="form-group">
		<label for="rfid" class="col-md-4 control-label">Rfid</label>
		<div class="col-md-8">
			<input type="text" name="rfid" value="<?php echo ($this->input->post('rfid') ? $this->input->post('rfid') : $cadet['rfid']); ?>" class="form-control" id="rfid" />
		</div>
	</div>
	<div class="form-group">
		<label for="major" class="col-md-4 control-label">Major</label>
		<div class="col-md-8">
			<input type="text" name="major" value="<?php echo ($this->input->post('major') ? $this->input->post('major') : $cadet['major']); ?>" class="form-control" id="major" />
		</div>
	</div>
	<div class="form-group">
		<label for="bio" class="col-md-4 control-label">Bio</label>
		<div class="col-md-8">
			<textarea name="bio" class="form-control" id="bio"><?php echo ($this->input->post('bio') ? $this->input->post('bio') : $cadet['bio']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="AFGoals" class="col-md-4 control-label">AFGoals</label>
		<div class="col-md-8">
			<textarea name="AFGoals" class="form-control" id="AFGoals"><?php echo ($this->input->post('AFGoals') ? $this->input->post('AFGoals') : $cadet['AFGoals']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="awards" class="col-md-4 control-label">Awards</label>
		<div class="col-md-8">
			<textarea name="awards" class="form-control" id="awards"><?php echo ($this->input->post('awards') ? $this->input->post('awards') : $cadet['awards']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="PGoals" class="col-md-4 control-label">PGoals</label>
		<div class="col-md-8">
			<textarea name="PGoals" class="form-control" id="PGoals"><?php echo ($this->input->post('PGoals') ? $this->input->post('PGoals') : $cadet['PGoals']); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>
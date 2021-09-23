<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document" style="margin: 10% auto;max-width: 900px;">
	    <div class="modal-content" id="app">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Users</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Nama User<span style="color:red"> *</span></label>
								<input type="text" id="nama_user" name="nama_user" class="form-control" maxlength="200" />
							</div>

							<div class="form-group">
								<label>Email<span style="color:red"> *</span></label>
								<input type="email" id="email" name="email" class="form-control" maxlength="200" />
							</div>	
							<div class="form-group">
								<label>Password</label>
								<input type="password" id="password" name="password" class="form-control" />
							</div>	
							<div class="form-group">
								<label>Department<span style="color:red"> *</span></label>
								<select name="department" id="department" class="form-control">
									<option value="HR">HR</option>
									<option value="Operational">Operational</option>
									<option value="Finance">Finance</option>
									<option value="Kurir">Kurir</option>
			                      <?php 
			                      foreach($group as $row)
			                      { 
			                      	echo '<option value="'.$row->id.'">'.$row->group.'</option>';
			                      }
			                      ?>
			                    </select>
							</div>	
							<div class="form-group">
								<label>Regional<span style="color:red"> *</span></label>
								<select name="cabang" id="cabang" class="form-control">
									<option value="JAKARTA">JAKARTA</option>
									<option value="SURABAYA">SURABAYA</option>
			                    </select>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
									<option value="Pria">Pria</option>
									<option value="Wanita">Wanita</option>
			                    </select>
							</div>	
							<div class="form-group">
								<label>Aktif</label><br>
								<input type="checkbox" id="status" name="status" class="js-single" checked />
							</div>
						</div>
						
					</div>
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Form Aplikasi</label></h4>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
				
					<div class="form-group">
						<label>App Code</label>
						<input type="text" id="app_code" name="app_code" class="form-control" maxlength="200"  />
					</div>	
					<div class="form-group">
						<label>Base URL</label>
						<input type="text" id="base_url" name="base_url" class="form-control"   />
					</div>	
					<div class="form-group">
						<label>Tabel User</label>
						<input type="text" id="tabel_user" name="tabel_user" class="form-control" maxlength="200" />
					</div>
					<div class="form-group">
						<label>Key Tabel</label>
						<input type="text" id="key_tbl" name="key_tbl" class="form-control" />
					</div>
					<div class="form-group">
						<label>Field Password</label>
						<input type="text" id="field_password" name="field_password" class="form-control" />
					</div>								
					<div class="form-group">
						<label>Driver</label>
						<input type="text" id="driver" name="driver" class="form-control" />
					</div>	
					<div class="form-group">
						<label>Encrypt Type</label>
						<input type="text" id="encrypt_type" name="encrypt_type" class="form-control" />
					</div>
					<input type="hidden" id="txtCode" name="txtCode">	
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

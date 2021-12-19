<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Supplier</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label style="font-weight: bold;">Supplier Code<span style="color:red"> *</span></label>
						<input type="text" id="vendor_code" name="vendor_code" class="form-control" />
					</div>	
					<div class="form-group">
						<label style="font-weight: bold;">Supplier Name<span style="color:red"> *</span></label>
						<input type="text" id="vendor_name" name="vendor_name" class="form-control"  />
					</div>	
			
					<div class="form-group">
						<label style="font-weight: bold;">Phone</label>
						<input type="text" id="phone" name="phone" class="form-control" value="" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Contact</label>
						<input type="text" id="contact" name="contact" class="form-control" value="" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Alamat</label>
						<textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="" style="height: 100px;" ></textarea>
					</div>				
					<input type="hidden" name="id_vendor" id="id_vendor" value="">
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
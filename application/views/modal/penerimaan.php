<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Penerimaan</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label style="font-weight: bold;">No penerimaan</label>
						<input type="text" id="no_penerimaan" name="no_penerimaan" class="form-control" maxlength="200" readonly />
					</div>	
					<div class="form-group">
						<label style="font-weight: bold;">Tanggal</label>
						<input type="text" id="tanggal" name="tanggal" class="form-control" readonly />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Deskripsi</label>
						<textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="" style="height: 100px;" ></textarea>
					</div>	
					<div class="form-group">
						<label style="font-weight: bold;">Status</label>
						<input type="text" id="status" name="status" class="form-control"  readonly />
					</div>			
					<input type="hidden" name="id_penerimaan" id="id_penerimaan" value="">
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
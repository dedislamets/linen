<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Ruangan</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label>Nama Ruangan<span style="color:red"> *</span></label>
						<input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control" maxlength="200" />
					</div>	
					<div class="form-group">
						<label>Total Bed</label>
						<input type="text" id="total_bed" name="total_bed" class="form-control" value="0" />
					</div>	
					<div class="form-group" style="display: none;">
	                    <label style="font-weight: bold;">Ruangan</label>
	                    <select id="finfeksius" name="finfeksius" class="form-control" >
                        	<option value="Infeksius">Infeksius</option>
                        	<option value="Non Infeksius">Non Infeksius</option>
                      	</select>
	                  </div>
									
					<input type="hidden" name="id_ruangan" id="id_ruangan" value="">
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
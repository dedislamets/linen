<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Jenis Item</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label style="font-weight: bold;">Nama Item<span style="color:red"> *</span></label>
						<input type="text" id="jenis" name="jenis" class="form-control" maxlength="200" />
					</div>	
					<div class="form-group">
	                    <label style="font-weight: bold;">Jenis</label>
	                    <select id="fmedis" name="fmedis" class="form-control" >
                        	<option value="Medis">Medis</option>
                        	<option value="Non Medis">Non Medis</option>
                      	</select>
	                  </div>
					<div class="form-group">
						<label style="font-weight: bold;">Harga</label>
						<input type="text" id="harga" name="harga" class="form-control text-right" value="0" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Berat</label>
						<input type="number" id="berat" name="berat" class="form-control" value="0" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Spesifikasi</label>
						<textarea name="spesifikasi" id="spesifikasi" rows="4" class="form-control" placeholder="" style="height: 100px;" ></textarea>
					</div>				
					<input type="hidden" name="id_jenis" id="id_jenis" value="">
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
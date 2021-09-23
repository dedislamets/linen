<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header" style="background-color: #404E67;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Barang</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label>Nama Barang<span style="color:red"> *</span></label>
						<input type="text" id="nama_barang" name="nama_barang" class="form-control" maxlength="200" />
					</div>	
					
					<div class="form-group">
						<label>Jenis</label>
						<select id="jenis" name="jenis" class="form-control">
		                   <option value="Gadget">Gadget</option>
		                   <option value="Electronik">Electronik</option>
		                   <option value="Makanan">Makanan</option>
		                   <option value="pecah belah">Pecah Belah</option>
		                   <option value="Cairan">Cairan</option>
		                   <option value="lain-lain">Lain-lain</option>
		                </select>
					</div>	
					<div class="form-group">
						<label>Berat Barang</label>
						<input type="text" id="berat_barang" name="berat_barang" class="form-control" />
					</div>		
					<div class="form-group">
						<label>Satuan</label>
						<select id="satuan" name="satuan" class="form-control">
							<option value="Pcs">Pcs</option>
		                   <option value="Kg">Kg</option>
		                   <option value="M">Meter</option>
		                   <option value="Ton">Ton</option>
		                   
		                </select>
					</div>						
					<input type="hidden" name="id_barang" id="id_barang" value="">
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
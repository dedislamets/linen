<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Jemput</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label style="font-weight: bold;">No transaksi</label>
						<input type="text" id="no_request" name="no_request" class="form-control" maxlength="200" readonly />
					</div>	
					<div class="form-group">
						<label style="font-weight: bold;">Tanggal</label>
						<input type="text" id="tanggal" name="tanggal" class="form-control" readonly />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Ruangan</label>
						<select name="ruangan" id="ruangan" class="form-control" readonly>
				          <?php 
				            foreach($ruangan as $row)
				            { 
				              echo '<option value="'.$row->ruangan.'">'.$row->ruangan.'</option>';
				            }
				            ?>
				          </select>
					</div>	
					<div class="form-group">
						<label style="font-weight: bold;">Requestor</label>
						<input type="text" id="requestor" name="requestor" class="form-control"  readonly />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">PIC Jemput</label>
						<input type="text" id="pic_jemput" name="pic_jemput" class="form-control" required  />
					</div>			
					<input type="hidden" name="id_request" id="id_request" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Selesai Jemput</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>
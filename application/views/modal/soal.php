<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color:#fff !important"><label id="lbl-title"></label> <label> Komponen</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label style="font-weight: bold;">Komponen<span style="color:red"> *</span></label>
						<textarea name="soal" id="soal" rows="4" class="form-control" placeholder="" style="height: 100px;" ></textarea>
					</div>	
				
					<div class="form-group">
						<label style="font-weight: bold;">Bobot</label>
						<input type="number" id="bobot" name="bobot" class="form-control" value="0" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Nilai Max</label>
						<input type="number" id="nilai_max" name="nilai_max" class="form-control" value="0" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Skor Max</label>
						<input type="number" id="skor_max" name="skor_max" class="form-control" value="0" />
					</div>
					<div class="form-group">
						<label style="font-weight: bold;">Keterangan</label>
						<textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="" style="height: 100px;" ></textarea>
					</div>	
					<div class="form-group">
						<label>Ada Sub</label><br>
						<input type="checkbox" id="punya_sub" name="punya_sub" />
					</div>
					<div id="info-sub">
						<div class="form-group">
							<label>Parent</label>
							<select name="parent_id" id="parent_id" class="form-control">
								<option value="0">-- Silahkan Pilih--</option>
		                      <?php 
		                      foreach($parent as $row)
		                      { 
		                      	echo '<option value="'.$row->id.'">'.$row->id . ' - ' .$row->soal.'</option>';
		                      }
		                      ?>
		                    </select>
						</div>
						<div class="form-group">
							<label>Title Sub</label>
							<select name="title_sub" id="title_sub" class="form-control">
								<option value="">-- Silahkan Pilih--</option>
		                      	<?php 
		                      	foreach($title_sub as $row)
		                      	{ 
		                      		echo '<option value="'.$row->title_sub.'">'.$row->title_sub.'</option>';
		                      	}
		                      	?>
		                    </select>
						</div>	
						<div class="form-group">
							<label>Atau Title Baru</label>
							<input type="text" id="title_sub_baru" name="title_sub_baru" class="form-control" value="" />
						</div>		
					</div>	
					<input type="hidden" name="id_judul" id="id_judul" value="">
					<input type="hidden" name="id_soal_detail" id="id_soal_detail" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
			            <button type="button" id="btnDelete" class="btn btn-danger" >Hapus</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>
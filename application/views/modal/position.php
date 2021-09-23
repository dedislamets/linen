<div class="hidden">
	<form id="Form" name ="Form" class="grab form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="parentID">Parent<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<select id="parentID" name="parentID" class="form-control">
                    <?php 
                    foreach($org as $row_org)
                    { 
                      echo '<option value="'.$row_org->Recnum.'">'.$row_org->PositionName.'- '.$row_org->PositionId .'</option>';
                    }
                    ?>
                </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="jenis">Type <span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<select id="jenis" name="jenis" class="form-control" disabled>
                    <option value="1">Structural</option>
					<option value="2">Functional</option>
                </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="code">Position Code<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<input type="text" id="code" name="code" placeholder="" class="form-control" value="" maxlength="30" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="OrgName">Position Name<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<input type="text" id="OrgName" name="OrgName" class="form-control" maxlength="300" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Sort">Sort</label>
			<div class="col-sm-2">
				<input type="number" id="Sort" name="Sort" class="form-control" />
			</div>
			<label class="col-sm-4 control-label no-padding-right" for="Extention">Standart Employe. Required</label>
			<div class="col-sm-2">
				<input type="text" id="EmpReq" name="EmpReq" class="form-control dec" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Sort">Effective Date<span style="color:red"> *</span></label>
			<div class="col-sm-4 no-padding-right">
				<div class="input-group">
					<input class="form-control date-picker" id="dateRangeStart" name="dateRangeStart" type="text" data-date-format="dd-mm-yyyy" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
				</div>
			</div>
			<label class="col-sm-1 control-label ">S.d</label>
			<div class="col-sm-4">
				<div class="input-group">
					<input class="form-control date-picker" id="dateRangeEnd" name="dateRangeEnd" type="text" data-date-format="dd-mm-yyyy" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Official">Active</label>
			<div class="col-sm-4" style="padding-top: 9px;">
				<label>
					<input id="isActive" name="isActive" class="ace ace-switch" type="checkbox" checked />
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

	</form>
</div>
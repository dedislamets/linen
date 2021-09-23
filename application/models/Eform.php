<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eform extends CI_Model
{
	public function combobox($name,$id_name,$query,$value="")
    {
    	$row_data = $this->db->query($query)->result();
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="'.$id_name.'" name="'.$id_name.'" >';
                     foreach($row_data as $row)
                        { 
                          if($value == $row->Id ){
                            $text .='<option value="'.$row->Id.'" selected>'.$row->Name.'</option>';
                          }else{
                            $text .='<option value="'.$row->Id.'">'.$row->Name.'</option>';
                          }
                          
                        }
        $text .='    </select>
                  </div>
                </div>';
        return $text;
    }
    public function Multiline($name,$id_name,$value="")
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<textarea class="form-control" id="'.$id_name.'" name="'.$id_name.'" placeholder="">'.$value.'</textarea>
                  </div>
                </div>';
        return $text;
    }
    public function Date($name,$id_name,$value="")
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<div class="input-group">
	                  <input id="'.$id_name.'" name="'.$id_name.'" type="text" value="'.$value.'" class="form-control date-picker" />
	                  <span class="input-group-addon">
	                    <i class="fa fa-clock-o bigger-110"></i>
	                  </span>
	                </div>
                  </div>
                </div>';
        return $text;
    }
    public function Time($name,$id_name,$value="")
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<div class="input-group bootstrap-timepicker">
                      <input id="'.$id_name.'" name="'.$id_name.'" value="'.$value.'" type="text" class="form-control waktu" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>';
        return $text;
    }
    public function Text($name,$id_name,$value="")
    {
      $text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                    <input type="text" id="'.$id_name.'" name="'.$id_name.'" value="'.$value.'" class="form-control" />
                  </div>
                </div>';
        return $text;
    }
    public function number($name,$id_name,$value="0")
    {
      $text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                    <input type="text" style="text-align:right" id="'.$id_name.'" name="'.$id_name.'" value="'.$value.'" class="form-control number" />
                  </div>
                </div>';
        return $text;
    }
    public function numberInt($name,$id_name,$value="0")
    {
      $text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                    <input type="number" id="'.$id_name.'" name="'.$id_name.'" value="'.$value.'" class="form-control" />
                  </div>
                </div>';
        return $text;
    }
    public function Uploadfile($name,$id_name)
    {
    	$text = '<div class="form-group">
	    			<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
	    			<div class="col-sm-9">
						<input type="file" id="'.$id_name.'" name="'.$id_name.'">
					</div>
				</div>';
		return $text;
    }
}
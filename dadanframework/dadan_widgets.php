<?php
/**
* 
Dadann Framework :3

*/
class dadan_widgets
{
	public static function dropdown($item)
	{
		//jika array value ada
		if(isset($item['data'])){

			$list = null;
			foreach ($item['data'] as $key => $value) {
				if($value[$item['key']] == $item['defaultValue']){
					$selected = "selected = 'selected'";
				} else{
					$selected = null;
				}
				$list .= "<option value=".$value[$item['key']]." ".$selected." >".$value[$item['value']]."</option>";
			}
			return "
				<select class='".$item['class']."'' name=".$item['name'].">
				  ".$list."
				</select>
			";
		}
	}
}
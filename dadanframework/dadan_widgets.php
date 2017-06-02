<?php
/**
* 
Dadann Framework :3

*/
class dadan_widgets
{
	function dropdown($item)
	{
		//jika array value ada
		if(isset($item['data'])){

			$list = null;
			foreach ($item['data'] as $key => $value) {
				$list .= "<option value=".$value[$item['key']].">".$value[$item['value']]."</option>";
			}
			return "
				<select class='".$item['class']."'' name=".$item['name'].">
				  ".$list."
				</select>
			";
		}
	}
}
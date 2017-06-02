<?php
/**
* 
Dadann Framework :3
*/
class dadan_components
{
	
	function baseUrl()
	{
		return "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}

	function redirect($url)
	{
		echo "
			<script type='text/javascript'>
				window.location = '".self::getUrl($url)."';
			</script>
		";
	}

	function getUrl($url,$params=null)
	{
		$model = [];
		$url = explode('/', $url);
		$model = $url[0];
		$action = $url[1];

		$params_glue = null;
		if($params !==null){
			foreach ($params as $key => $value) {
				$params_glue .= '&'.$key.'='.$value;
			}
		}

		return 'index.php?&model='.$model.'&action='.$action.$params_glue;
	}
}
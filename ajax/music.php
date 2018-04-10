<?php

$data   = file_get_contents('../settings/music.json');
$decode = json_decode($data, true);

if($decode['enabled'] == true)
{
	function URL2Embed($data)
	{
	    return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"1\" height=\"1\" style=\"display: none;\" src=\"//www.youtube.com/embed/$2?autoplay=1\"></iframe>", $data);
	}

	function GrabVideoName($url)
	{
		parse_str(parse_url($url, PHP_URL_QUERY ), $id );
		
		@$data = file_get_contents("http://youtube.com/get_video_info?video_id=" . $id['v']);
		parse_str($data, $name);

		if(!empty($name['title']) && isset($name['title']))
		{
			return $name['title'];
		}
		else
		{
			return 'Unknown Song Name!';
		}
	}

	echo URL2Embed($decode['song1']) . '<i class="fa fa-volume-up" aria-hidden="true"></i> <div class="music-text"><marquee width="200" direction="left">' . GrabVideoName($decode['song1']) . '</marquee></div>';
}


?>
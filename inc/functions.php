<?php

function convertSteamID($steamid64)
{
	$authserver = bcsub($steamid64, '76561197960265728') & 1;
	$authid     = (bcsub($steamid64, '76561197960265728') - $authserver) / 2;
	
	return "STEAM_0:$authserver:$authid";
}



function GrabSteamID()
{
	if(isset($_GET['steamid']))
	{
		if((int)$_GET['steamid'] && strlen($_GET['steamid']) == 17)
		{
			global $SETTINGS;

			$data   = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . @$SETTINGS['API_KEY'] . '&steamids=' . $_GET['steamid']);
			$decode = json_decode($data, true);

			echo convertSteamID($_GET['steamid']);
		}
		else
		{
			echo "<span class='red'>Not Found</span>";
		}
	}
	else
	{
		echo "<span class='red'>Not Found</span>";
	}
}



function GrabSteamAvatar()
{
	if(isset($_GET['steamid']))
	{
		if((int)$_GET['steamid'] && strlen($_GET['steamid']) == 17)
		{
			global $SETTINGS;

			$data   = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . @$SETTINGS['API_KEY'] . '&steamids=' . $_GET['steamid']);
			$decode = json_decode($data, true);

			echo $decode['response']['players'][0]['avatarfull'];
		}
		else
		{
			echo "img/avatar.png";
		}
	}
	else
	{
		echo "img/avatar.png";
	}
}



function GrabSteamName()
{
	if(isset($_GET['steamid']))
	{
		if((int)$_GET['steamid'] && strlen($_GET['steamid']) == 17)
		{
			global $SETTINGS;

			$data   = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . @$SETTINGS['API_KEY'] . '&steamids=' . $_GET['steamid']);
			$decode = json_decode($data, true);

			echo $decode['response']['players'][0]['personaname'];
		}
		else
		{
			echo "<span class='red'>Not Found</span>";
		}
	}
	else
	{
		echo "<span class='red'>Not Found</span>";
	}
}



function GrabMoney()
{
	if(isset($_GET['steamid']))
	{
		if((int)$_GET['steamid'])
		{
			global $con;

			$steamid = $_GET['steamid'];

			// Add UniqueID Method if needed: util.CRC("gm_" .. string.upper(util.SteamIDFrom64(sid64)) .. "_gm")
			// "gm_" . strtoupper($steamid) . "_gm"

			$data = $con->prepare('SELECT COUNT(*) FROM darkrp_player WHERE uid = :steamid');
			$data->execute(array(
				':steamid' => $steamid
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con->prepare('SELECT * FROM darkrp_player WHERE uid = :steamid');
				$data->execute(array(
					':steamid' => $steamid
				));
			
				$result = $data->fetchAll(PDO::FETCH_ASSOC);

				foreach($result as $row)
				{
					echo $row['wallet'];
				}
			}
			else
			{
				echo "<span class='red'>Not Found</span>";
			}
		}
		else
		{
			echo "<span class='red'>Not Found</span>";
		}
	}
	else
	{
		echo "<span class='red'>Not Found</span>";
	}
}



function Login()
{
	if(isset($_POST['login']))
	{
		if(!empty($_POST['password']))
		{
			$password = $_POST['password'];

			$filename = file_get_contents('settings/general.json');

			$decode = json_decode($filename, true);

			if($password == $decode['password'])
			{
				$_SESSION['password'] = $password;
				header('Location: manage.php');
				exit();
			}
			else
			{
				echo '<div class="response">
						Wrong Password!
					</div>';
			}
		}
		else
		{
			echo '<div class="response">
					Field cannot be empty!
				</div>';
		}
	}
}



function GeneralSettings()
{
	if(isset($_POST['save-general']))
	{
		$filename = 'settings/general.json';

		$data = array(
			'api_key'     => @$_POST['apikey'],
			'password'    => $_POST['password'],
			'server_name' => $_POST['name'],
			'rule1'       => $_POST['rule1'],
			'rule2'       => $_POST['rule2'],
			'rule3'       => $_POST['rule3'],
			'rule4'       => $_POST['rule4'],
			'rule5'       => $_POST['rule5'],
			'rule6'       => $_POST['rule6']
		);
		
		if(!file_exists($filename))
		{
			$fp = fopen($filename, 'w');
			$fw = fwrite($fp, '');
			fclose($fp);

			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
		else
		{
			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
	}
}



function CustomSettings()
{
	if(isset($_POST['save-custom']))
	{
		$filename = 'settings/custom.json';

		$data = array(
			'bgimg'          => $_POST['bgimg'],
			'bgcolor'        => $_POST['bgcolor'],
			'logocolor'      => $_POST['logo-color'],
			'rulestextcolor' => $_POST['rules-text-color'],
			'rulesnumcolor'  => $_POST['rules-num-color'],
			'rulesnumcolor2' => $_POST['rules-num-color2'],
			'steamidcolor'   => $_POST['steamid-color'],
			'steamnamecolor' => $_POST['steamname-color'],
			'moneycolor'     => $_POST['darkrpwallet-color'],
			'mapcolor'       => $_POST['mapname-color'],
			'gamemodecolor'  => $_POST['gamemode-color'],
			'playerscolor'   => $_POST['players-color'],
			'progresscolor'  => $_POST['progressbar-color']
		);

		if(!file_exists($filename))
		{
			$fp = fopen($filename, 'w');
			$fw = fwrite($fp, '');
			fclose($fp);

			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
		else
		{
			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
	}
}



function DarkRPSettings()
{
	if(isset($_POST['save-darkrp']))
	{
		$filename = 'settings/darkrp.json';

		if(isset($_POST['enabled']))
		{
			$enabled = true;
		}
		else
		{
			$enabled = false;
		}

		$data = array(
			'enabled' => $enabled,
			'dbhost'  => $_POST['dbhost'],
			'dbuser'  => $_POST['dbuser'],
			'dbpass'  => $_POST['dbpass'],
			'dbname'  => $_POST['dbname'],
			'charset' => $_POST['charset']
		);

		if(!file_exists($filename))
		{
			$fp = fopen($filename, 'w');
			$fw = fwrite($fp, '');
			fclose($fp);

			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
		else
		{
			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
	}
}



function MusicSettings()
{
	if(isset($_POST['save-music']))
	{
		$filename = 'settings/music.json';

		if(isset($_POST['enabled']))
		{
			$enabled = true;
		}
		else
		{
			$enabled = false;
		}

		$data = array(
			'enabled' => $enabled,
			'song1'   => $_POST['song1']
		);

		if(!file_exists($filename))
		{
			$fp = fopen($filename, 'w');
			$fw = fwrite($fp, '');
			fclose($fp);

			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
		else
		{
			$encode = json_encode($data, true);
			file_put_contents($filename, $encode);
			echo '<meta http-equiv="refresh" content="0">';
		}
	}
}



function Pages()
{	
	if(!isset($_GET['page']))
	{
		if(file_exists('settings/general.json'))
		{
			$file        = file_get_contents('settings/general.json');
			$decode      = json_decode($file, true);

			$apikey      = $decode['api_key'];
			$password    = $decode['password'];
			$server_name = $decode['server_name'];
			$rule1       = $decode['rule1'];
			$rule2       = $decode['rule2'];
			$rule3       = $decode['rule3'];
			$rule4       = $decode['rule4'];
			$rule5       = $decode['rule5'];
			$rule6       = $decode['rule6'];
		}

		echo '<div class="content-box column small-12">
				<div class="content-box-content column small-12">
					<form method="POST">
						<div class="splitter-title">
							General
						</div>

						<hr>
						
						<div class="content-box-line column small-12">
							<label>Steam API Key</label>
							<input type="text" value="' . @$apikey . '" name="apikey" />
						</div>

						<div class="content-box-line column small-12 medium-6">
							<label>Choose a new password</label>
							<input type="password" value="' . @$password . '" name="password" />
						</div>

						<div class="content-box-line column small-12 medium-6">
							<label>Server Name</label>
							<input type="text" name="name" value="' . @$server_name . '" />
						</div>

						<div class="splitter-title">
							Rules
						</div>

						<hr>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 1</label>
							<input type="text" name="rule1" value="' . @$rule1 . '" />
						</div>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 4</label>
							<input type="text" name="rule4" value="' . @$rule4 . '" />
						</div>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 2</label>
							<input type="text" name="rule2" value="' . @$rule2 . '" />
						</div>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 5</label>
							<input type="text" name="rule5" value="' . @$rule5 . '" />
						</div>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 3</label>
							<input type="text" name="rule3" value="' . @$rule3 . '" />
						</div>

						<div class="content-box-line column small-12 medium-6 left">
							<label>Rule 6</label>
							<input type="text" name="rule6" value="' . @$rule6 . '" />
						</div>

						<div class="content-box-line column small-12">
							<input type="submit" class="button small" name="save-general" value="Save" />
						</div>
					</form>
				</div>
			</div>';
	}
	else
	{
		$page = $_GET['page'];
		
		if($page == 'customization')
		{
			if(file_exists('settings/custom.json'))
			{
				$file        = file_get_contents('settings/custom.json');
				$decode      = json_decode($file, true);

				$bg_img           = $decode['bgimg'];
				$bg_color         = $decode['bgcolor'];
				$logo_color       = $decode['logocolor'];
				$rules_text_color = $decode['rulestextcolor'];
				$rules_num_color  = $decode['rulesnumcolor'];
				$rules_num_color2 = $decode['rulesnumcolor2'];
				$steamid_color    = $decode['steamidcolor'];
				$steamname_color  = $decode['steamnamecolor'];
				$money_color      = $decode['moneycolor'];
				$map_color        = $decode['mapcolor'];
				$mode_color       = $decode['gamemodecolor'];
				$slot_color       = $decode['playerscolor'];
				$progress_color   = $decode['progresscolor'];
			}

			echo '<div class="content-box column small-12">
					<div class="content-box-content column small-12">
						<form method="POST">
							<div class="splitter-title">
								Background Options
							</div>

							<hr>

							<div class="content-box-line column small-12 medium-6">
								<label>Background Image</label>
								<input type="text" value="' . @$bg_img . '" name="bgimg" />
							</div>

							<div class="content-box-line column small-12 medium-6">
								<label>Background Color</label>
								<input type="text" class="jscolor" value="' . @$bg_color . '" name="bgcolor" />
							</div>

							<div class="splitter-title">
								Foreground Options
							</div>

							<hr>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Logo Color</label>
								<input type="text" class="jscolor" name="logo-color" value="' . @$logo_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Progressbar Color</label>
								<input type="text" class="jscolor" name="progressbar-color" value="' . @$progress_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>SteamID Color</label>
								<input type="text" class="jscolor" name="steamid-color" value="' . @$steamid_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Steam Name Color</label>
								<input type="text" class="jscolor" name="steamname-color" value="' . @$steamname_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>DarkRP Wallet Color</label>
								<input type="text" class="jscolor" name="darkrpwallet-color" value="' . @$money_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Mapname Color</label>
								<input type="text" class="jscolor" name="mapname-color" value="' . @$map_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Gamemode Color</label>
								<input type="text" class="jscolor" name="gamemode-color" value="' . @$mode_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Player Slots Color</label>
								<input type="text" class="jscolor" name="players-color" value="' . @$slot_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-3 left">
								<label>Rules Number Color 1</label>
								<input type="text" class="jscolor" name="rules-num-color" value="' . @$rules_num_color . '" />
							</div>

							<div class="content-box-line column small-12 medium-3 left">
								<label>Rules Number Color 2</label>
								<input type="text" class="jscolor" name="rules-num-color2" value="' . @$rules_num_color2 . '" />
							</div>

							<div class="content-box-line column small-12 medium-6 left">
								<label>Rules Text Color</label>
								<input type="text" class="jscolor" name="rules-text-color" value="' . @$rules_text_color . '" />
							</div>

							<div class="content-box-line column small-12">
								<input type="submit" class="button small" name="save-custom" value="Save" />
							</div>
						</form>
					</div>
				</div>';
		}
		elseif($page == 'darkrp')
		{
			$enb = '';

			if(file_exists('settings/darkrp.json'))
			{
				$file    = file_get_contents('settings/darkrp.json');
				$decode  = json_decode($file, true);

				$enabled = $decode['enabled'];
				$dbhost  = $decode['dbhost'];
				$dbuser  = $decode['dbuser'];
				$dbpass  = $decode['dbpass'];
				$dbname  = $decode['dbname'];
				$charset = $decode['charset'];

				if($enabled == true)
				{
					$enb = 'checked';
				}
				else
				{
					$enb = '';
				}
			}

			echo '<div class="content-box column small-12">
					<div class="content-box-content column small-12">
						<form method="POST">
							<div class="splitter-title">
								Database Options
							</div>

							<hr>

							<div class="content-box-line column small-12 medium-12">
								<label>Enable DarkRP Features</label>
								<input type="checkbox" ' . @$enb . ' name="enabled" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>DB Hostname</label>
								<input type="text" value="' . @$dbhost . '" name="dbhost" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>DB Username</label>
								<input type="text" value="' . @$dbuser . '" name="dbuser" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>DB Password</label>
								<input type="password" value="' . @$dbpass . '" name="dbpass" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>DB Name</label>
								<input type="text" value="' . @$dbname . '" name="dbname" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>DB Charset</label>
								<input type="text" value="' . @$charset . '" name="charset" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<input type="submit" class="button small" name="save-darkrp" value="Save" />
							</div>
						</form>
					</div>
				</div>';
		}
		elseif($page == 'music')
		{
			if(file_exists('settings/music.json'))
			{
				$file    = file_get_contents('settings/music.json');
				$decode  = json_decode($file, true);

				$enabled = $decode['enabled'];
				$song1   = $decode['song1'];

				if($enabled == true)
				{
					$enb = 'checked';
				}
				else
				{
					$enb = '';
				}
			}

			echo '<div class="content-box column small-12">
					<div class="content-box-content column small-12">
						<form method="POST">
							<div class="splitter-title">
								Music Options
							</div>

							<hr>

							<div class="content-box-line column small-12 medium-12">
								<label>Enable Music Features</label>
								<input type="checkbox" ' . @$enb . ' name="enabled" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<label>Music URL</label>
								<input type="text" value="' . @$song1 . '" name="song1" placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX" />
							</div>

							<div class="content-box-line column small-12 medium-12">
								<input type="submit" class="button small" name="save-music" value="Save" />
							</div>
						</form>
					</div>
				</div>';
		}
		else
		{
			echo 'error';
		}
	}
}



function PlaySong()
{
	$data   = file_get_contents('settings/music.json');
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
}


































?>
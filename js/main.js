var FilesNeeded = 0;
var TotalFiles = 0;
var DownloadFile = false;

var diffrence = 0;
var percentage = 0;

function DownloadingFile( fileName )
{
	document.getElementById("FileName").innerHTML = fileName;
}

function SetFilesNeeded( needed, total )
{
	FilesNeeded = needed;			
	Progressbar();
}

function SetFilesTotal( total )
{
	TotalFiles = total;
	Progressbar();
}

function DownloadingFile( filename )
{
	if ( DownloadFile )
	{
		FilesNeeded = FilesNeeded - 1;
		Progressbar();
	}
	document.getElementById( "download-file" ).innerHTML = filename;
	DownloadStatus = false;
	setTimeout( "DownloadStatus = true;", 1000 );
	DownloadFile = true;
}

function SetStatusChanged( status )
{
	if ( DownloadFile )
	{
		FilesNeeded = FilesNeeded - 1;
		DownloadFile = false;
		Progressbar();
	}
	document.getElementById( "download-file" ).innerHTML = status;
	DownloadStatus = false;
	setTimeout( "DownloadStatus = true;", 1000 );
}

function Progressbar()
{
	diffrence = Math.round(TotalFiles - FilesNeeded);
	percentage = Math.round(diffrence / TotalFiles * 100);
		
	if(TotalFiles < 1)
	{
		document.getElementById( "percentage-num" ).innerHTML = "100%";
		document.getElementById( "progress" ).innerHTML = "<div id='bar-width' style='width: 100%;'></div>";
	}

	document.getElementById( "percentage-num" ).innerHTML = percentage + "%";
	document.getElementById( "progress" ).innerHTML = "<div id='bar-width' style='width: " + percentage + "%;'></div>";
}

Progressbar();

function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode )
{
	//document.getElementById("Server").innerHTML = servername; // Maybe i will use this in the future
	document.getElementById("Gamemode").innerHTML = gamemode;
	document.getElementById("Players").innerHTML = maxplayers;
	document.getElementById("Map").innerHTML = mapname;
}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Advanced Uploader Example With Additional POST Variables and Server Data Return</title>

<style type="text/css">
/*margin and padding on body element
  can introduce errors in determining
  element position and are not recommended;
  we turn them off as a foundation for YUI
  CSS treatments. */
body {
	margin:0;
	padding:0;
}
</style>

<link rel="stylesheet" type="text/css" href="../../build/fonts/fonts-min.css" />
<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/uploader/uploader-min.js"></script>

<!--there is no custom header content for this example-->

</head>

<body class="yui-skin-sam">


<h1>Advanced Uploader Example With Additional POST Variables and Server Data Return</h1>

<div class="exampleIntro">
	<p>This example demonstrates how the <a href="http://developer.yahoo.com/yui/uploader/">YUI Uploader Control</a> can be rendered as a transparent layer on top of your own UI and how custom variables can be added to the upload's POST request. In this example, the server-side script also echoes the POST variables accompanying the upload; we retrieve the data returned by the server and display it to the user.</p>

<p><strong>Note:</strong> The YUI Uploader Control requires Flash Player 9.0.45 or higher. The latest version of Flash Player is available at the <a href="http://www.adobe.com/go/getflashplayer">Adobe Flash Player Download Center</a>.</p>

<p><strong>Note:</strong> The YUI Uploader Control requires the <code>uploader.swf</code> Flash file that is distributed as part of the YUI package, in the <code>uploader/assets</code> folder. Copy <code>uploader.swf</code> to your server and set the <code>YAHOO.Uploader.SWFURL</code> variable to its full path.</p>

<p><strong>Note:</strong> This example uses a server-side script to accept file uploads. The script used does not open or store the file data sent to it. It also does not store the accompanying POST variables, but it does echo them in the response relayed back to the sender of the request. When trying out the example, do not send any sensitive or private data. Do not exceed a file size of 10 MB.</p>

</div>

<!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

<style>
#selectFilesLink a, #uploadFilesLink a, #clearFilesLink a {
	color: #0000CC;
	background-color: #FFFFFF;
}

#selectFilesLink a:visited, #uploadFilesLink a:visited, #clearFilesLink a:visited {
	color: #0000CC;
	background-color: #FFFFFF;
}

#uploadFilesLink a:hover, #clearFilesLink a:hover {
	color: #FFFFFF;
	background-color: #000000;
}
</style>

<div id="uiElements" style="display:inline;">
		<div id="postVars">
		Set custom values for a couple POST vars:<br/>
		var1: <input type="text" id="var1Value" value="var1 default value" /><br/>
		var2: <input type="text" id="var2Value" value="var2 default value" /><br/><br/>
		</div>
		<div id="uploaderContainer">
			<div id="uploaderOverlay" style="position:absolute; z-index:2"></div>
			<div id="selectFilesLink" style="z-index:1"><a id="selectLink" href="#">Select File</a></div>
		</div>
		<div id="uploadFilesLink"><a id="uploadLink" onClick="upload(); return false;" href="#">Upload File</a></div><br/>
		<div id="selectedFileDisplay">
		Progress: <input type="text" cols="50" id="progressReport" value="" readonly /><br/><br/>
		</div>
		<div id="returnedDataDisplay">
		Data returned by the server:<br/>
		<textarea id="serverData" rows="5" cols="50"></textarea>
		</div>
</div>


<script type="text/javascript">

YAHOO.util.Event.onDOMReady(function () {
var uiLayer = YAHOO.util.Dom.getRegion('selectLink');
var overlay = YAHOO.util.Dom.get('uploaderOverlay');
YAHOO.util.Dom.setStyle(overlay, 'width', uiLayer.right-uiLayer.left + "px");
YAHOO.util.Dom.setStyle(overlay, 'height', uiLayer.bottom-uiLayer.top + "px");
});

	// Custom URL for the uploader swf file (same folder).
	YAHOO.widget.Uploader.SWFURL = "../grafix/uploader.swf";

    // Instantiate the uploader and write it to its placeholder div.
	var uploader = new YAHOO.widget.Uploader( "uploaderOverlay" );

	// Add event listeners to various events on the uploader.
	// Methods on the uploader should only be called once the
	// contentReady event has fired.

	uploader.addListener('contentReady', handleContentReady);
	uploader.addListener('fileSelect', onFileSelect)
	uploader.addListener('uploadStart', onUploadStart);
	uploader.addListener('uploadProgress', onUploadProgress);
	uploader.addListener('uploadCancel', onUploadCancel);
	uploader.addListener('uploadComplete', onUploadComplete);
	uploader.addListener('uploadCompleteData', onUploadResponse);
	uploader.addListener('uploadError', onUploadError);
    uploader.addListener('rollOver', handleRollOver);
    uploader.addListener('rollOut', handleRollOut);
    uploader.addListener('click', handleClick);

    // Variable for holding the selected file id.
	var fileID;

	// When the mouse rolls over the uploader, this function
	// is called in response to the rollOver event.
	// It changes the appearance of the UI element below the Flash overlay.
	function handleRollOver () {
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#FFFFFF");
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#000000");
	}

	// On rollOut event, this function is called, which changes the appearance of the
	// UI element below the Flash layer back to its original state.
	function handleRollOut () {
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#0000CC");
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#FFFFFF");
	}

	// When the Flash layer is clicked, the "Browse" dialog is invoked.
	// The click event handler allows you to do something else if you need to.
	function handleClick () {
	}

	// When contentReady event is fired, you can call methods on the uploader.
	function handleContentReady () {
	    // Allows the uploader to send log messages to trace, as well as to YAHOO.log
		uploader.setAllowLogging(true);

		// Disallows multiple file selection in "Browse" dialog.
		uploader.setAllowMultipleFiles(false);

		// New set of file filters.
		var ff = new Array({description:"Images", extensions:"*.jpg;*.png;*.gif"},
		                   {description:"Videos", extensions:"*.avi;*.mov;*.mpg"});

		// Apply new set of file filters to the uploader.
		uploader.setFileFilters(ff);
	}

	// Actually uploads the files. Since we are only allowing one file
	// to be selected, we use the upload function, in conjunction with the id
	// of the selected file (returned by the fileSelect event). We are also including
	// the text of the variables specified by the user in the input UI.

	function upload() {
	if (fileID != null) {
		uploader.upload(fileID, "http://localhost/lackybet/myadmin/includes/upload_simple.php",
		                "POST",
		                {var1:document.getElementById("var1Value").value,
						 var2:document.getElementById("var2Value").value});
	}
	}

	// Fired when the user selects files in the "Browse" dialog
	// and clicks "Ok". Here, we set the value of the progress
	// report textfield to reflect the fact that a file has been
	// selected.

	function onFileSelect(event) {
		for (var file in event.fileList) {
		    if(YAHOO.lang.hasOwnProperty(event.fileList, file)) {
				fileID = event.fileList[file].id;
			}
		}

		this.progressReport = document.getElementById("progressReport");
		this.progressReport.value = "Selected " + event.fileList[fileID].name;
	}


    // When the upload starts, we inform the user about it via
	// the progress report textfield.
	function onUploadStart(event) {
		this.progressReport.value = "Starting upload...";
	}

	// As upload progresses, we report back to the user via the
	// progress report textfield.
	function onUploadProgress(event) {
		prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
		this.progressReport.value = prog + "% uploaded...";
	}

	// Report back to the user that the upload has completed.
	function onUploadComplete(event) {
		this.progressReport.value = "Upload complete.";
	}

	// Report back to the user if there has been an error.
	function onUploadError(event) {
		this.progressReport.value = "Upload error.";
	}

	// Do something if an upload is canceled.
	function onUploadCancel(event) {

	}

	// When the data is received back from the server, display it to the user
	// in the server data text area.
	function onUploadResponse(event) {
		this.serverData = document.getElementById("serverData");
		this.serverData.value = event.data;
	}
</script>



<!--END SOURCE CODE FOR EXAMPLE =============================== -->

</body>
</html>

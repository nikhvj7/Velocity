<script src="webcam.js"></script>
<div id="my_camera" style="width:320px; height:240px;"></div>
<div id="my_result"></div>
<script language="JavaScript">
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
        });
    }
</script>
<a href="javascript:void(take_snapshot())">Take Snapshot</a>
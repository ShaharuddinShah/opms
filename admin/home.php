<head>
	<script defer src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>
</head>

<!--dashboard-->
<h1>Welcome to <?php echo $_settings->info('name') ?> - Admin Panel</h1>
<hr class="border-info">

<?php
function duration($dur = 0){
    if($dur == 0){
        return "00:00";
    }
    $hours = floor($dur / (60 * 60));
    $min = floor($dur / (60)) - ($hours*60);
    $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
    return $dur;
}
?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-tasks"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">New Projects</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `project_list` where delete_flag=0 and `status` = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-tasks"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">In-Progress Projects</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `project_list` where delete_flag=0 and `status` = 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-tasks"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Closed Projects</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `project_list` where delete_flag=0 and `status` = 2 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-user-tie"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Members</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `member_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-file-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Reports</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `report_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

</div>
<hr>
<div id="cometchat"></div>
	<script>
	window.addEventListener('DOMContentLoaded', (event) => {
		CometChatWidget.init({
			"appID": "2162230fd11856ba",
			"appRegion": "us",
			"authKey": "ebf7b4666cc07f1ffd6284909d44979e39e81ea5"
		}).then(response => {
			console.log("Initialization completed successfully");
			//You can now call login function.
			CometChatWidget.login({
				"uid": "superhero1"
			}).then(response => {
				CometChatWidget.launch({
					"widgetID": "bc4b167e-4e51-4451-90cc-961cbe12ef82",
					"target": "#cometchat",
					"roundedCorners": "true",
					"height": "500px",
					"width": "800px",
					"defaultID": 'superhero1', //default UID (user) or GUID (group) to show,
					"defaultType": 'user' //user or group
				});
			}, error => {
				console.log("User login failed with error:", error);
				//Check the reason for error and take appropriate action.
			});
		}, error => {
			console.log("Initialization failed with error:", error);
			//Check the reason for error and take appropriate action.
		});
	});
	</script>

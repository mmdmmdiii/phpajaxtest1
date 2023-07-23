<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// AjaxNewsTicker v1.05
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : SNTQK-105
// URL : http://www.phpkobo.com/ajax-news-ticker
//
// This software is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2 of the
// License.
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	CEnv::useLib("app");
	$lca = CEnv::locale("install/page.personal");
	$req = _req();

	//-- get inital timezone string
	$tz = ini_get("date.timezone");
	if ( !empty($tz) ) {
		$tz = str_replace(" ","_",$tz);
	} else {
		$tz = $lca["init:time_zone"];
	}

	//-- set up field values
	$rs["first_name"] = "";
	$rs["last_name"] = "";
	$rs["email"] = "";
	$rs["time_zone"] = $tz;
?>
<div class="psect">
<input type="hidden" name="page-key" value="personal"/>

	<div class="psect-body">
		<div class="ctar-form">

			<div class="task-title">
			<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			<?php echo $lca["page:title"]; ?>
			</div>

			<p class="task-inst text-info">
				<?php echo $lca["text:inst"]; ?>
			</p>

			<div class="ctar-falert"></div>

			<div class="row">
<?php CObject::obStart(); ?>
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:first_name"]; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="first_name"
							value="<?php echo _hsc( $rs["first_name"] ); ?>"
							placeholder="<?php echo $lca["plh:first_name"]; ?>"
						/>
					</div>
				</div>
<?php $code_first_name = CObject::obEnd(); ?>
<?php CObject::obStart(); ?>
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:last_name"]; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="last_name"
							value="<?php echo _hsc( $rs["last_name"] ); ?>"
							placeholder="<?php echo $lca["plh:last_name"]; ?>"
						/>
					</div>
				</div>
<?php $code_last_name = CObject::obEnd(); ?>
<?php 
	$cfg = CEnv::locale("app/format");
	$str = $cfg["tpl:name"];
	$str = str_replace("%first_name%",$code_first_name,$str);
	$str = str_replace("%last_name%",$code_last_name,$str);
	echo $str;
?>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:email"]; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="email"
							value="<?php echo _hsc( $rs["email"] ); ?>"
							placeholder="<?php echo $lca["plh:email"]; ?>"
						/>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:time_zone"]; ?>
							<?php echo $req; ?></label>
						<select class="form-control _ffe_" name="time_zone">
						<?php CHtmlMacro::printOptions(
							CEnv::locale("util/time-zone"),
							"time-zone", $rs["time_zone"]); ?>
						</select>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php include("tpl.navi.inc.php"); ?>
</div>

<script>
$(document).ready(function(){
	$(".ctar-form")
		.find("input[name='first_name']")
		.select();
});
</script>
<?php // ?>
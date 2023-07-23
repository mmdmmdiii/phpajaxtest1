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
$lca = CEnv::locale("nticker/ntickerrec.settings");
$req = _req();

$url_mod = $this->urlMod();

$rs = array_merge($rs,CJson::decode($rs["idata"]));

?>
<div class="ppart">
	<div class="ppart-heading">
		<div class="ppart-title"><?php echo $lca["ppart:title:settings"]; ?></div>
		<div class="btn-save inpsave pull-right" tabindex="0"></div>
		<div class="clear:both"></div>
	</div>
	<div class="ppart-body">
		<form class="form-settings">
			<div class="psect">
				<div class="psect-body">
					<div class="ctar-falert"></div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label><?php echo $lca["label:title"]; ?> 
									<?php echo $req; ?></label>
								<input type="text"
									class="form-control _ffe_"
									name="title"
									value="<?php echo _hsc( $rs["title"] ); ?>"
									placeholder="<?php echo $lca["plh:title"]; ?>"
									maxlength="100"
								/>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<textarea type='text'
									style="display:none;height:100px;"
									class="form-control inpnnews _ffe_"
									name="news"
								><?php echo _hsc(CJson::encode($rs["news"])); ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="psect">
				<div class="psect-heading">
					<div class="psect-title"><?php echo $lca["text:speed"]; ?></div>
				</div>
				<div class="psect-body">
					<style>.fig-speed {margin-bottom:8px;position:relative;left:-5px;}</style>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:t_movein"]; ?> 
									<?php echo $req; ?>
									<?php CPopHelp::show($lca["help:t_movein"]); ?>
								</label>
								<div class="fig-speed"><img src="<?php echo $url_mod; ?>img/fig-movein.png"/></div>
								<div class="input-group" style='max-width:130px;'>
									<input type="text" class="form-control inpint _ffe_"
										data-step="100"
										name="t_movein"
										value="<?php echo $rs["t_movein"]; ?>" />
									<span class="input-group-addon"><?php echo $lca["label:milli-sec"]; ?></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:t_pause"]; ?> 
									<?php echo $req; ?>
									<?php CPopHelp::show($lca["help:t_pause"]); ?>
								</label>
								<div class="fig-speed"><img src="<?php echo $url_mod; ?>img/fig-pause.png"/></div>
								<div class="input-group" style='max-width:130px;'>
									<input type="text" class="form-control inpint _ffe_"
										data-step="100"
										name="t_pause"
										value="<?php echo $rs["t_pause"]; ?>" />
									<span class="input-group-addon"><?php echo $lca["label:milli-sec"]; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:speed_moveout"]; ?> 
									<?php echo $req; ?>
									<?php CPopHelp::show($lca["help:speed_moveout"]); ?>
								</label>
								<div class="fig-speed"><img src="<?php echo $url_mod; ?>img/fig-moveout.png"/></div>
								<div class="input-group" style='max-width:140px;'>
									<input type="text" class="form-control inpint _ffe_"
										data-step="10"
										name="speed_moveout"
										value="<?php echo $rs["speed_moveout"]; ?>" />
									<span class="input-group-addon"><?php echo $lca["label:px-per-sec"]; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="psect">
				<div class="psect-heading">
					<div class="psect-title"><?php echo $lca["text:color"]; ?></div>
				</div>
				<div class="psect-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:fc_news"]; ?></label>
								<div class="input-group" style="max-width:240px;">
									<input type="text" class="form-control inpcolor _ffe_"
										name="fc_news"
										value="<?php echo $rs["fc_news"]; ?>"
										placeholder="<?php echo $lca["plh:color"]; ?>"
									/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:bc_news"]; ?></label>
								<div class="input-group" style="max-width:240px;">
									<input type="text" class="form-control inpcolor _ffe_"
										name="bc_news"
										value="<?php echo $rs["bc_news"]; ?>"
										placeholder="<?php echo $lca["plh:color"]; ?>"
									/>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:fc_btn"]; ?></label>
								<div class="input-group" style="max-width:240px;">
									<input type="text" class="form-control inpcolor _ffe_"
										name="fc_btn"
										value="<?php echo $rs["fc_btn"]; ?>"
										placeholder="<?php echo $lca["plh:color"]; ?>"
									/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo $lca["label:bc_btn"]; ?></label>
								<div class="input-group" style="max-width:240px;">
									<input type="text" class="form-control inpcolor _ffe_"
										name="bc_btn"
										value="<?php echo $rs["bc_btn"]; ?>"
										placeholder="<?php echo $lca["plh:color"]; ?>"
									/>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group" style="max-width:240px;">
								<label><?php echo $lca["label:rc_ctar"]; ?></label>
								<div class="input-group">
									<input type="text" class="form-control inpcolor _ffe_"
										name="rc_ctar"
										value="<?php echo $rs["rc_ctar"]; ?>"
										placeholder="<?php echo $lca["plh:color"]; ?>"
									/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							&nbsp;
						</div>
					</div>
				</div>
			</div>

			<div class="psect">
				<div class="psect-heading">
					<div class="psect-title"><?php echo $lca["text:notes"]; ?></div>
				</div>
				<div class="psect-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<textarea class="form-control _ffe_"
									name="notes"
									rows="3"
									data-maxchar="200"
									placeholder="<?php echo $lca["plh:notes"]; ?>"
								><?php echo _hsc($rs["notes"]); ?></textarea>
								<div class="note-cnt-ctar">
									<span class="notes-cnt"></span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>
									<input type="checkbox"
										name="pinidx"
										class="inpcb _ffe_"
										<?php CHtmlMacro::printChecked(
											$rs["pinidx"]); ?>>
									<span class="checkbox-caption">
										<?php echo $lca["label:pinidx"]; ?>
									</span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<hr style="visibility:hidden;" />

<?php CPopHelp::init(); ?>

<?php //CDebug::printJson($rs); ?>
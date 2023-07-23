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

class CInstCode_scripttag extends CInstCode {

	protected function getCodeTpl() {
		$url = $this->urlScriptTag();
		$txt=<<<_EOM_
[span class='code-hl']<script type="text/javascript" src="{$url}"></script>[/span]
_EOM_;
		return $txt;
	}


	protected function getHtmlTpl() {
		$code = $this->getCodeTpl();
		if ( CDetect::isMobile() ) {
			$meta = '<meta charset="utf-8">' . "\r\n" .
				'<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\r\n" .
				'<meta name="viewport" content="width=device-width, initial-scale=1">';
		} else {
			$meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		}

		$txt=<<<_EOM_
<!DOCTYPE html>
<html>
<head>
{$meta}
</head>
<body>

{$code}

</body>
</html>
_EOM_;
		return $txt;
	}

}

?>
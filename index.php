<?php
$code = null;

if (isset($_POST['code']) && !empty($_POST['code'])) {
	$file = '/var/www/tmp/' . uniqid();
	file_put_contents($file, $_POST['code']);

	$command = 'sh run.sh ' . $file;
	$output = shell_exec($command);
	$strError = @file_get_contents($file . '.err');

	$code = $_POST['code'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Run Clever Code</title>
<style type="text/css" media="screen">
#editor { 
	position: absolute;
	top: 0;
	right: 0;
	bottom: 230px;
	left: 0;
}

pre {
	overflow: scroll;
}

body {
	font-family: Verdana, Arial;
}

.error {
	coler: red;
}

</style>
</head>
<body>

<div id="editor">/**
 * Clever programming language
 * Copyright (c) Clever Team
 *
 * This file is distributed under the MIT license. See LICENSE for details.
 *
 * Project page: www.clever-lang.org
 */

import std.*;

function fibonacci(max) {
    var map = {'1':1, '2':1};

    var fib = function (n) {
        if (map.exists(n.toString())) {
        	return map[n.toString()];
        }
    
    	map[n.toString()] = fib(n - 1) + fib(n - 2);
    	return map[n.toString()];
    };

    fib(max);

    return map;
}

var printer = function (x, y) {
    io:println(String.format('F(\1) = \2', x, y));
};

fibonacci(9).each(printer);
</div>
<div style="position: absolute; bottom:200px; width:100%; text-align:center">
<form action="index.php" method="post" id="form">
	<input type="hidden" name="code" id="codeInput" />
	<input type="button" value="Run Clever Code!" onclick="return submitCode();" />
</form>
</div>

<?php 
if (!is_null($code)):
?>
<div style="position: absolute; bottom:0">
<?php
	if (!empty($errorStr)):
?>
<h2 class="headerError">Compiler Output</h2>
<pre class="error"><?= $str ?></pre>
<?php
	else:
?>
<h2>Run Output</h2>
<pre><?= $output ?></pre>
<?php
	endif;
?>
</div>
<?php
endif;
?>
<script src="/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/javascript");
editor.getSession().setUseWorker(false);
<?php 
if (!is_null($code)): 
?>
editor.getSession.setValue('<?=str_replace("\n", "\\\n", addslashes($code))?>');
<?php endif; ?>
function submitCode() {
	var editor = ace.edit("editor");  
	document.getElementById("codeInput").value = editor.getSession().getValue();
	document.getElementById('form').submit();
	return true;
}
</script>
</body>
</html>

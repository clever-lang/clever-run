<!DOCTYPE html>
<html lang="en">
<head>
<title>Run Clever Code</title>
<style type="text/css" media="screen">
#editor { 
	position: absolute;
	top: 0;
	right: 0;
	bottom: 30px;
	left: 0;
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
<div style="position: absolute; bottom:0; width:100%; text-align:center;">
<form action="run.php" method="post" id="form">
	<input type="hidden" name="code" id="codeInput" />
	<input type="button" value="Run Clever Code!" onclick="return submitCode();" />
</form>
</div>

<script src="/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/javascript");
editor.getSession().setUseWorker(false);

function submitCode() {
	var editor = ace.edit("editor");  
	document.getElementById("codeInput").value = editor.getSession().getValue();
	document.getElementById('form').submit();
	return true;
}
</script>
</body>
</html>

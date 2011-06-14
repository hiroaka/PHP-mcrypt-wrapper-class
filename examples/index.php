<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Crypt Class Examples</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" type="image/x-icon" href="http://www.grgr.us/image?d=16&t=gr" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1>Crypt Class Examples</h1>
	</div>
	<div id="content">
	<?php

	require('../Crypt.php');
	$key = 'Blah BLah blahdskdflk';
	$stats = null;
	try{
		$c = new Crypt(array('key' => $key, 'mode' => 'ecb', 'algorithm' => 'blowfish'));
		if($c){
			if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
				if(isset($_POST['encrypt']) && $_POST['encrypt']){
					$encrypted = $c->encrypt($_POST['encrypt']);
					$stats = 'Encrypted';
				}
				if(isset($_POST['decrypt']) && $_POST['decrypt']){
					$decrypted = $c->decrypt($_POST['decrypt']);
					$stats = 'Decrypted';
				}
		 	  	$stats .= ' using '.$c->getMode().' '.$c->getAlgorithm();
			}
			$c->close();
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	?>
		<h2>Example</h2>
		<div class="section">
			<form method="post">
				<?php
				echo ($stats) ? '<p class="stats">'.$stats.'</p>' : '';
				?>
				<div class="element">
					<label for="encrypt">Encrypt</label><input type="text" id="encrypt" name="encrypt"/>
					<?php echo (isset($encrypted) && $encrypted) ? '<p>'.$encrypted.'</p>' : '';?>
				</div>
				<div class="element">
					<label for="decrypt">Decrypt</label><input type="text" id="decrypt" name="decrypt"/>
					<?php echo (isset($decrypted) && $decrypted) ? '<p>'.$decrypted.'</p>' : '';?>
				</div>
				<div class="submit">
					<input type="submit" value="Go"/>
				</div>
			</form>
		</div>
		
		<h2>Simple Usage</h2>
		<div class="section">
			<pre><span class="sys">require(</span><span class="str">'../Crypt.php'</span><span class="sys">)</span>	;</pre>
			<pre><span class="var">$options</span> = <span class="cons">array</span><span class="cons">(</span>
	<span class="str">'key'</span>       <span class="cons">=></span> <span class="str">'herp derp gerp lerp'</span>,
	<span class="str">'mode'</span>      <span class="cons">=></span> <span class="str">'ecb'</span>,
	<span class="str">'algorithm'</span> <span class="cons">=></span> <span class="str">'blowfish'</span>,
	<span class="str">'base64'</span>    <span class="cons">=></span> <span class="const">true</span> <span class="comm"># default</span>
<span class="cons">)</span>;</pre>
			<pre><span class="var">$crypt</span> = <span class="sys">new</span> <span class="func">Crypt</span>(<span class="var">$options</span>);</pre>
			<pre><span class="var">$data</span> = <span class="var">$crypt</span>-><span class="func">encrypt</span>(<span class="str">'TOP SECRET blah blah blah'</span>);</pre>
			<pre><span class="sys">echo</span> <span class="var">$data</span>; <span class="comm"># 13Tt9Omi1uDsWlraXzuHUW6i2O1cySZ6U5dOO7FatCI= </span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">decrypt</span>(<span class="var">$data</span>); <span class="comm"># TOP SECRET blah blah blah</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getMode</span>(); <span class="comm"># ecb</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getAlgorithm</span>(); <span class="comm"># blowfish</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getBase64Encoding</span>(); <span class="comm"># 1</span></pre>
			<pre><span class="var">$crypt</span>-><span class="func">close</span>(); <span class="comm"># Close</span></pre>
		</div>

		<h2><a name="options">Options</a></h2>
		<div class="section">
			<?php echo Crypt::listOptions();?>
		</div>
		
		<h2>Static Methods</h2>
		<div class="section">
			<ul>
				<li>
					<span class="func"><em>int</em> Crypt::extensionLoaded()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>bool</em>
						<pre><span class="const">true</span> if mcrypt extension is loaded</pre>
						<pre><span class="const">false</span> if mcrypt extension is not loaded</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>array</em> Crypt::listOptions()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre>Outputs a <a class="doc" href="#options">list of options</a> for the constructor</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>array</em> Crypt::modes()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>array</em>
						<pre><span class="const">array</span> of modes supported by php/mcrypt</pre>
						<pre>same as output from $class->listModes() &amp mcrypt_list_modes()</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>array</em> Crypt::algorithms()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>array</em>
						<pre><span class="const">array</span> of algorithms supported by php/mcrypt</pre>
						<pre>same as output from $class->listAlgorithms() &amp mcrypt_list_algorithms()</pre>
					</span>
				</li>
			</ul>
		</div>
		
		<h2>Methods</h2>
		<div class="section">
			<ul>
				<li>
					<span class="func"><em>bool</em> __construct(<em>array</em> <span class="params">$params</span>)</span>
					<span class="ref"><strong>Input</strong> <em>array</em>
						<pre><span class="key">key</span>        =&gt; <em>string</em> - <span class="required">(required)</span> <strong>no default</strong> <span class="notes">resized to fit appropriate key size</span></pre>
						<pre><span class="key">mode</span>       =&gt; <em>must be a result of mcrypt_list_modes()</em> - <span class="optional">(optional)</span> <strong>default: first result from mcrypt_list_modes()</strong></pre>
						<pre><span class="key">algorithm</span>  =&gt; <em>must be a result of mcrypt_list_algorithms()</em> - <span class="optional">(optional)</span> <strong>default: first result from mcrypt_list_algorithms()</strong></pre>
						<pre><span class="key">base64</span>     =&gt; <em>true|false</em> <span class="notes">sets encoding of input/output to base 64</span> - <span class="optional">(optional)</span> <strong>default: true</strong></pre>
					</span>
					<span class="ref"><strong>Output</strong> <em>bool</em>
						<pre><span class="const">true</span> on success of mcrypt_generic_init()</pre>
						<pre><span class="const">false</span> on fail of mcrypt_generic_init()</pre>
						<pre><span class="const">die</span> on no extension, modes, algorithms loaded or on lack of <strong>key</strong> param</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> encrypt(<em>string</em> <span class="params">$data</span>)</span>
					<span class="ref"><strong>Input</strong> <em>string</em>
						<pre>plain text</pre>
					</span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">encrypted string</span> if <strong>base64</strong> is <span class="const">false</span></pre>
						<pre><span class="const">base64_encoded encrypted string</span> if <strong>base64</strong> is <span class="const">true</span></pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> decrypt(<em>string</em> <span class="params">$data</span>)</span>
					<span class="ref"><strong>Input</strong> <em>string</em>
						<pre><span class="const">encrypted string</span> if <strong>base64</strong> is <span class="const">false</span></pre>
						<pre><span class="const">base64_encoded encrypted string</span> if <strong>base64</strong> is <span class="const">true</span></pre>
					</span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">plain text</span></pre>
					</span>
				</li>
				<li>
					<span class="func"><em>void</em> close()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>None</em></span>
				</li>
				<li>
					<span class="func"><em>array</em> listModes()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>array</em>
						<pre><span class="const">array</span> of modes supported by php/mcrypt</pre>
						<pre>same as output from Crypt::modes() &amp mcrypt_list_modes()</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> getMode()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">string</span> current mode</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> setMode(<em>string</em> <span class="params">$mode</span>)</span>
					<span class="ref"><strong>Input</strong> <em>string</em></span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">string</span> current mode. If setting failed it keeps &amp; returns previous setting.</pre>
						<pre>Setting must be inside of array provided by $class->listModes() or Crypt::modes()</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>array</em> listAlgorithms()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>array</em>
						<pre><span class="const">array</span> of algorithms supported by php/mcrypt</pre>
						<pre>same as output from Crypt::algorithms() &amp mcrypt_list_algorithms()</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> getAlgorithm()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">string</span> current algorithm</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>string</em> setAlgorithm(<em>string</em> <span class="params">$algorithm</span>)</span>
					<span class="ref"><strong>Input</strong> <em>string</em></span>
					<span class="ref"><strong>Output</strong> <em>string</em>
						<pre><span class="const">string</span> current algorithm. If setting failed it keeps &amp; returns previous setting.</pre>
						<pre>Setting must be inside of array provided by $class->listAlgorithms() or Crypt::algorithms()</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>bool</em> getBase64Encoding()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
				</li>
				<li>
					<span class="func"><em>bool</em> setBase64Encoding(<em>bool</em> <span class="params">$bool</span>)</span>
					<span class="ref"><strong>Input</strong> </span>
					<span class="ref"><strong>Output</strong> <em>bool</em>
						<pre><span class="const">bool</span> current <strong>base64</strong> setting (default === true)</pre>
					</span>
				</li>
				<li>
					<span class="func"><em>int</em> listKeySize()</span>
					<span class="ref"><strong>Input</strong> <em>None</em></span>
					<span class="ref"><strong>Output</strong> <em>int</em>
						<pre><span class="const">int</span> key size for mode/algorithm combination</pre>
					</span>
				</li>
			</ul>
		</div>
		
	</div>
	<p id="footer">&copy; 2011 <a href="http://www.grgrssll.com">grgrssll.com</a> Seattle USA</p>
</div>	
<style>
/* reset */
html, body, div, span, object, iframe,h1, h2, h3, h4, h5, h6, p, blockquote, pre,abbr, address, cite, code,del, dfn, em, img, ins, kbd, q, samp,small, strong, sub, sup, var,b, i,dl, dt, dd, ol, ul, li,fieldset, form, label, legend,table, caption, tbody, tfoot, thead, tr, th, td,article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary,time, mark, audio, vide {margin: 0;padding: 0;border: 0;outline: 0;text-decoration: none;font-style: normal;font-weight: normal;font-size: 100%;vertical-align: baseline;background: transparent;font-family:Helvetica, Arial, sans-serif;
color:#222;}
input,select{font-family:Helvetica, Arial, sans-serif;}
body, html{width:100%;height:100%;background:#fcfcfc;}
article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary { 
display:block;}
nav ul{list-style:none;}
body {line-height: 1; font-size: 10px; font-family: Helvetica,Arial,sans-serif;}
ol,ul {list-style: none;}
blockquote,q {quotes: none;}
blockquote:before,blockquote:after,q:before,q:after {content: ''; content: none;}
<strong>Input</strong>focus {outline: 1px #f20 solid;background-color: #ddd;border:0;}
#info <strong>Input</strong>focus{outline:0;background:#fff;}
ins {text-decoration: none; background-color: yellow;}
del {text-decoration: line-through;}
table {border-collapse: collapse; border-spacing: 0;}
a,a:link,a:visited,a:hover,a:active,a:focus{cursor:pointer;text-decoration:none;}
/* styles */
#wrapper{margin: 0 auto;position:relative;width:1000px;padding:20px;}
h1{font-size:24px;margin-bottom:12px;}
h2{font-size:20px;color:#555;margin-bottom:10px;}
p{font-size:16px;line-height:20px;margin-bottom:10px;color:#555;}
#header{margin-bottom:20px;}
#content{padding:20px 0;border-top:1px #ddd solid;}
#footer{position:absolute;bottom:0;right:10px;font-size:12px;margin:0;}
#footer a{color:#555;}
#footer a:hover{color:#0d0;}
li span,.code, pre, pre span{font-family:Droid Sans Mono, monospace;color:#777;font-size:13px;line-height:20px;}
li span{}
li span.func{font-weight:bold;display:block;}
li span.params{color:#06f;font-weight:inherit;}
li span.ref{padding:4px;border:1px #ddd solid;background:#f7f7f7;margin:4px 0;display:block;}
li span.ref strong{color:inherit;}
li{padding:4px;border:1px #ddd solid;margin:0 0 8px 0;}
.sys{color:#920;}
.var{color:#06f;}
.str{color:#d20;}
.func{color:black;}
.cons{color:#092;}
.comm{font-style:italic;color:#777;}
.const{color:#111;}
.section{margin-bottom:20px;width:980px;overflow:auto;padding:10px;background:#f3f3f3;}
.element{overflow:hidden;margin-bottom:10px;padding:1px 0;}
.element label{width:70px;display:block;color:#777;font-size:16px;float:left;margin-top:5px;}
.element input{display:block;color:#777;background:#fff;font-size:14px;font-family:droid sans mono, monospace;float:left;border:1px #ccc solid;padding:4px;width:400px;}
.element p{margin:0 0 10px 10px;color:#092;padding:2px 4px;border:1px #ccc solid;background:#f7f7f7;font-size:12px;font-family:droid sans mono, monospace;float:left;}
.submit input{border:1px #bbb solid;color:#555;text-shadow:#eee 1px 1px 1px;font-family:helvetica, arial, sans-serif;font-size:14px;display:block;-border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;cursor:pointer;padding:4px 8px 2px 8px;background:#ccc;background: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));background: -moz-linear-gradient(top,  #eee,  #ccc); }
.submit <strong>Input</strong>hover{color:#111;background:#777;background: -webkit-gradient(linear, left top, left bottom, from(#ccc), to(#eee));background: -moz-linear-gradient(top,  #ccc,  #eee); }
.key{color:#000;}
.section em{font-style:italic;color:#038;}
.required{color:red;}
.optional{color:green;}
.section strong{color:#038;font-weight:bold;}
.notes{color:#444;}
a.doc, a.doc:visited{text-decoration:underline;color:#06f;}
.code{color:#111;font-weight:bold;}
</style>
</body>
</html>

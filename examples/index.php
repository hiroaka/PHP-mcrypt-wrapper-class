<?php

require('../Crypt.php');
$key = 'Blah BLah blahdskdflk';
$c = new Crypt(array('key' => $key, 'mode' => 'ecb', 'algorithm' => 'blowfish'));
$stats = null;
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Title</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" type="image/x-icon" href="http://www.grgr.us/image?d=16&t=gr" />
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
input:focus {outline: 1px #f20 solid;background-color: #ddd;border:0;}
#info input:focus{outline:0;background:#fff;}
ins {text-decoration: none; background-color: yellow;}
del {text-decoration: line-through;}
table {border-collapse: collapse; border-spacing: 0;}
a,a:link,a:visited,a:hover,a:active,a:focus{cursor:pointer;text-decoration:none;}
/* styles */
#wrapper{
margin: 0 auto;
position:relative;
width:1000px;
padding:20px;
}
h1{
font-size:24px;
margin-bottom:12px;
}
h2{
font-size:20px;
color:#555;
margin-bottom:10px;
}
h2 a{
color:#777;
}
h2 a:hover{
color:#0d0;
}
li{
font-size:18px;
margin-bottom:8px;
}
p{
font-size:16px;
line-height:20px;
margin-bottom:10px;
color:#555;
}
li p{
color:#777;
font-size:14px;
margin-bottom:0px;
margin-left:4px;
display:inline
}
li a{
color:#06f;
}
li a:hover{
color:#d20;
}
#header{
margin-bottom:20px;
}
#content{
padding:20px 0;
border-top:1px #ddd solid;
}
#footer{
position:absolute;
bottom:0;
right:10px;
font-size:12px;
margin:0;
}
#footer a{
color:#555;
}
#footer a:hover{
color:#0d0;
}
pre,
pre span{
font-family:Droid Sans Mono, monospace;
color:#777;
font-size:14px;
line-height:20px;
}
.sys{
color:#920;
}
.var{
color:#06f;
}
.str{
color:#d20;
}
.func{
color:black;
}
.cons{
color:#092;
}
.comm{
font-style:italic;
color:#777;
}
.const{
color:#111;
}
.section{
margin-bottom:20px;
width:980px;
overflow:auto;
padding:10px;
background:#f3f3f3;
}

.element{
overflow:hidden;
margin-bottom:10px;
padding:1px 0;
}
.element label{
width:70px;
display:block;
color:#777;
font-size:16px;
float:left;
margin-top:5px;
}
.element input{
display:block;
color:#777;
background:#fff;
font-size:14px;
font-family:droid sans mono, monospace;
float:left;
border:1px #ccc solid;
padding:4px;
width:400px;
}
.element p{
margin:0 0 10px 10px;
color:#092;
padding:2px 4px;
border:1px #ccc solid;
background:#f7f7f7;
font-size:12px;
font-family:droid sans mono, monospace;
float:left;
}
.submit input{
border:1px #bbb solid;
color:#555;
text-shadow:#eee 1px 1px 1px;
font-family:helvetica, arial, sans-serif;
font-size:14px;
display:block;
-border-radius:3px;
-webkit-border-radius:3px;
-moz-border-radius:3px;
cursor:pointer;
padding:4px 8px 2px 8px;
background:#ccc;
background: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
background: -moz-linear-gradient(top,  #eee,  #ccc); 
}
.submit input:hover{
color:#111;
background:#777;
background: -webkit-gradient(linear, left top, left bottom, from(#ccc), to(#eee));
background: -moz-linear-gradient(top,  #ccc,  #eee); 
}
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1>Crypt Class Examples</h1>
	</div>
	<div id="content">
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
			<pre><span class="var">$crypt</span> = <span class="sys">new</span> <span class="func">Crypt</span>(<span class="cons">array</span><span class="cons">(</span><span class="str">'key'</span> <span class="cons">=></span> <span class="str">'herp derp gerp lerp'</span><span class="cons">)</span>);</pre>
			<pre><span class="var">$data</span> = <span class="var">$crypt</span>-><span class="func">encrypt</span>(<span class="str">'TOP SECRET blah blah blah'</span>);</pre>
			<pre><span class="sys">echo</span> <span class="var">$data</span>; <span class="comm"># /kPFdNSmMr8CnmT0BcRyz+7HFWLaWL2VS0GElBHQKtM=</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">decrypt</span>(<span class="var">$data</span>); <span class="comm"># TOP SECRET blah blah blah</span></pre>
		</div>
		<h2>Advanced Usage</h2>
		<div class="section">
			<pre><span class="sys">require(</span><span class="str">'../Crypt.php'</span><span class="sys">)</span>;</pre>
			<pre><span class="var">$options</span> = <span class="cons">array</span><span class="cons">(</span>
	<span class="str">'key'</span>       <span class="cons">=></span> <span class="str">'herp derp gerp lerp'</span>,
	<span class="str">'mode'</span>      <span class="cons">=></span> <span class="str">'ofb'</span>,
	<span class="str">'algorithm'</span> <span class="cons">=></span> <span class="str">'blowfish'</span>,
	<span class="str">'base64'</span>    <span class="cons">=></span> <span class="const">false</span>,
<span class="cons">)</span>;</pre>
			<pre><span class="var">$crypt</span> = <span class="sys">new</span> <span class="func">Crypt</span>(<span class="var">$options</span>);</pre>
			<pre><span class="sys">print_r(</span><span class="var">$crypt</span>-><span class="func">listModes</span>()<span class="sys">)</span>; <span class="comm"># Array ( [0] => cbc [1] => cfb [2] => ctr [3] => ecb... </span></pre>
			<pre><span class="sys">print_r(</span><span class="var">$crypt</span>-><span class="func">listAlgorithms</span>()<span class="sys">)</span>; <span class="comm"># Array ( [0] => cast-128 [1] => gost [2] => rijndael-128 [3] => twofish... </span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getMode</span>(); <span class="comm"># ofb</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getAlgorithm</span>(); <span class="comm"># blowfish</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">setMode</span>(<span class="str">'not valid mode'</span>); <span class="comm"># ofb</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">setMode</span>(<span class="str">'cfb'</span>); <span class="comm"># cfb</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">setAlgorithm</span>(<span class="str">'not valid algorithm'</span>); <span class="comm"># blowfish</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">setAlgorithm</span>(<span class="str">'rijndael-256'</span>); <span class="comm"># rijndael-256</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">getBase64Encoding</span>(); <span class="comm"># 0</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">encrypt</span>(<span class="str">'TOP SECRET blah blah blah'</span>); <span class="comm"># ����㪲�&�gٙd� ��1����#4 H=</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">setBase64Encoding</span>(<span class="const">true</span>); <span class="comm"># 1</span></pre>
			<pre><span class="sys">echo</span> <span class="var">$crypt</span>-><span class="func">encrypt</span>(<span class="str">'TOP SECRET blah blah blah'</span>); <span class="comm"># yyoQXZa5OvgRbZqJHxhbwaavF+ePqiELaB3SloKp48A=</span></pre>
			</span></pre>
		</div>
	</div>
	<p id="footer">&copy; 2011 <a href="http://www.grgrssll.com">grgrssll.com</a> Seattle USA</p>
</div>	

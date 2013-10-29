<?php 
$secode='888'; //安全码
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>welcome !! </title>
    <link rel="stylesheet" href="images/test.css" />
    <!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body onload="javascript:document.getElementById('gt_go').focus();">
    <header>
       <form name="MyForm" defaultbutton="submit_bt" method="post">
	    <div class="centerabc"><input style="height:22px;" type="text" name="gt_go" id="gt_go" /><input name="sub_go" class="subm abc" type="submit" value="搜索" /></div>
	   </form>
    </header>
    
<?php if($_POST['gt_go']==$secode){ ?>
    
    
    <div id="pl_1">
	
        <nav id="filter"><input class="sbtn abc" onclick="javascript:conn(0);" id="ck_but" type="button" value="测速" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nav>
       <div style="margin-top:50px"> <section id="container">
         <ul id="stage">	  
             
		     <li data-tags='會員線路' class="center" id='l_1_1'><br /><a href='http://127.0.0.1' target="_blank"><h3>會員線路1</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='會員線路' class="center" id='l_1_2'><br /><a href='http://127.0.0.1' target="_blank"><h3>會員線路2</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='會員線路' class="center" id='l_1_3'><br /><a href='http://127.0.0.1' target="_blank"><h3>會員線路3</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='會員線路' class="center" id='l_1_4'><br /><a href='http://127.0.0.1' target="_blank"><h3>會員線路4</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='代理線路' class="center" id='l_0_1'><br /><a href='http://127.0.0.1' target="_blank"><h3>代理線路1</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='代理線路' class="center" id='l_0_2'><br /><a href='http://127.0.0.1' target="_blank"><h3>代理線路2</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='代理線路' class="center" id='l_0_3'><br /><a href='http://127.0.0.1' target="_blank"><h3>代理線路3</h3></a><br /><div class="right"></div></li>
		       
		     <li data-tags='代理線路' class="center" id='l_0_4'><br /><a href='http://127.0.0.1' target="_blank"><h3>代理線路4</h3></a><br /><div class="right"></div></li>
		     
	     </ul>
     </section></div>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.quicksand.js"></script>
<div id="dis_div" style="display: none"><img id="l_1_1_g" name="0"
	src="style/test.gif" /> <img id="l_1_2_g" name="1"
	src="style/test(1).gif" /> <img id="l_1_3_g" name="2"
	src="style/test(2).gif" /> <img id="l_1_4_g" name="3"
	src="style/test(3).gif" /></div>
<script type="text/javascript">
var link = $('#stage')[0].getElementsByTagName('li');

var count = 0;
var btn = $('#ck_but')[0];
var speed = $('#dis_div')[0];
var imgs = [],timeout = null;    
var imgLoad = function (){
	btn.setAttribute('disabled','disabled',false);
	var c=0;
	for(c = 0; c < link.length; c++){
		var s = {};
		s.img = document.createElement('img');
		s.url = $('#'+link[c].id+' a')[0].href.replace(/:\d{3,}/,'');
		s.url=s.url.substr(0,s.url.length-1);
		s.y = 1133;
		s.p = '/test.gif?';
		s.c = 0;
		s.n = 0;
		s.t = 0;
		s.l = link[c].id;
		s.img.onerror = getError;
		s.img.onload =  getLoad;s.img.id = link[c].id+'_g';s.img.name=c;
		s.lt = [];s.r = false;imgs[c] = s;
	}
	c=0;
	for(c in imgs){
		$.get("load.php", {array:imgs[c].url,i:c}, function (data, textStatus){
			try{
				var y=data.split(',');
				imgs[y[1]].y=data.split(',')[0];
			}catch(e){
			}
		});
	}
	btn.removeAttribute('disabled');
}
var clear = function(c){
	clearTimeout(timeout);
	timeout = null;if (!c) {
	for (var i = link.length - 1; i >= 0; i--) {
	if($('#'+link[i].id+' span').length>0){
	$('#'+link[i].id+' span')[0].className = '';
	$('#'+link[i].id+' span')[0].innerHTML = '';}};};
}
var conn = function (c){
	clear(c);
btn.setAttribute('disabled','disabled',false);
if(link[c]){
	var st,x;
	for(x in imgs){
		if(imgs[x].l==link[c].id){
			st=imgs[x].img.name;
		}
	}
if($("#"+link[c].id+ " span").length>0){$("#"+link[c].id+ " span")[0].innerHTML = "連接中"; 
$("#"+link[c].id+ " span")[0].className = "black"; 
imgs[st].img.src = imgs[st].url+':'+imgs[st].y+imgs[st].p+(Math.random()+'').replace('0.','');imgs[st].c=c;}
else{var span = document.createElement("span");span.id =link[c].id+'_g_s';
span.className='black';span.innerHTML = "連接中";$('#'+link[c].id+ ' div')[0].appendChild(span);
imgs[st].img.src = imgs[st].url+':'+imgs[st].y+imgs[st].p+(Math.random()+'').replace('0.',''); imgs[st].c=c;;
speed.appendChild(imgs[st].img);}imgs[st].t = new Date().getTime();imgs[st].r = false;
timeout = setTimeout(function() {getError.call(imgs[st].img,c);}, 5000);
}else{btn.removeAttribute('disabled');};}
function getError(c){var st;if(typeof(c)!='number'){c=imgs[this.name].c;st=this.name;} 
else{st= $('#'+link[c].id+"_g")[0].name;}if($('#'+imgs[st].img.id+'_s')[0]){
if (!imgs[st].r){imgs[st].n = 0;imgs[st].r = true;
if($('#'+imgs[st].img.id+'_s')[0].innerHTML == '連接中'){
$('#'+imgs[st].img.id+'_s')[0].className='br_green white';
$('#'+imgs[st].img.id+'_s')[0].innerHTML = '流暢';}};
setTimeout(function(){conn(c+1);},500);}}
function getLoad(){var st=this.name==''?event.srcElement.name:this.name;
var end = new Date().getTime(),clink = imgs[st],
td = clink.n?end - imgs[st].t:end - imgs[st].t, total = 0;
imgs[st].lt.push(td);imgs[st].n += 1;if(imgs[st].r){return;}
if(imgs[st].n < 2 ){setTimeout(function(){conn(imgs[st].c);},500);
}else{for(var c = 0; c < 2; c ++){total += clink.lt[c];}
var time=(total/2).toFixed(2);if(time<=2000){
$('#'+imgs[st].img.id+'_s')[0].className='br_green white';
$('#'+imgs[st].img.id+'_s')[0].innerHTML = '流暢';}
else if(time>2000){
$('#'+imgs[st].img.id+'_s')[0].className='br_ye white';
$('#'+imgs[st].img.id+'_s')[0].innerHTML = '繁忙';}
else{
$('#'+imgs[st].img.id+'_s')[0].className='br_reg white';
$('#'+imgs[st].img.id+'_s')[0].innerHTML = '超時';}
count -= 1;imgs[st].n = 0;imgs[st].lt.length = 0;imgs[st].r = true;
setTimeout(function(){conn(imgs[st].c+1);},500);}}
imgLoad();

document.getElementById("a").onclick=function(){
	var objs=(document.getElementsByTagName("ul"));
	objs[1].setAttribute("id","hidden");
	objs[0].setAttribute("id","stage");
	objs[1].className="hidden";
	objs[0].className="";
	link = $('#stage')[0].getElementsByTagName('li');
	this.className="active";
	document.getElementById("b").className="";
	imgLoad();
};
document.getElementById("b").onclick=function(){
	var objs=(document.getElementsByTagName("ul"));
	objs[0].setAttribute("id","hidden");
	objs[0].className="hidden";
	objs[1].className="";
	objs[1].setAttribute("id","stage");
	link = $('#stage')[0].getElementsByTagName('li');
	this.className="active";
	document.getElementById("a").className="";
	imgLoad();
};

</script></div>
<?php }?>
</body>
</html>
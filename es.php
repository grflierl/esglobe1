<!doctype html>
<?php
$qs=explode(";",$_SERVER["QUERY_STRING"]);
   $url=$qs[0];
   $onlineflag=0;
   if(strpos($url,".html")>0 || strpos($url,".php")>0){
   $d=implode("/",explode("/",$url,-1));
   if(strlen($d)==0)$d=".";
   } else {
     $d=$url;
   }
//   echo "---",$d,"---\n";
?>
<html >
    <head>
    <style>
body {
    background-image: url("stars.jpg");
    background-repeat: no-repeat;
    }
div.rhs {
    position: absolute;
    top: 0px;
    left: 1050px;
    border: 0px;
    background-color: rgba(200,200,200,0.8);
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #444;
}

li {
    float: left;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: #777;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #eee;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #ccc}

.dropdown:hover .dropdown-content {
    display: block;
}

</style>

<!-- Javascript modules --->
<script src="p5.min.js"></script>
<script src="p5.dom.min.js"></script>
<!--<script src="<?php echo $d?>/menu.js"></script> -->
<script>
var args={
//  sz:950,
//  w:450,
//  scalefac:1.06,
  <?php
  if(count($qs) > 1)
  for ($n=1;$n<count($qs);$n++){
      $arg=explode("=",$qs[$n],2);
      echo $arg[0] . ':"' . $arg[1] . '",' ."\n";
      if($arg[0]=="online")$onlineflag=1;
  };
  ?>
};

function setmenu(menus){
  menustr="";
  for(k in menus){
    typ=menus[k];
    v=typ[1];
    typ=typ[0];
    switch(typ){
    case "home":
	s="<a href='<?php echo $url?>' target='pages'>"+k+"</a>\n";
	break;
    case "title":
	s="<a><b> -- "+k+" -- </b></a>\n";
	break;
    case "show":
	s="<a href='javascript:sph.show(\""+v+"\")'>"+k+"</a>\n";
	break;
    case "link":
	if(v.indexOf("/") >= 0){
	    s="<a href='"+v+"' target='pages'>"+k+"</a>\n";
	} else {
	    s="<a href='<?php echo $d?>/"+v+"' target='pages'>"+k+"</a>\n";
	};
	break;
    case "js":
	s="<a href='javascript:"+v+"'>"+k+"</a>\n";
	break;
    case "raw":
	s="<a "+v+">"+k+"</a>\n";
	break;
    };
    menustr+=s;
  };
  document.getElementById("menu").innerHTML=menustr;
}

function getsph(loc){
  bn=loc.pathname;
  if(bn.endsWith("/"))
    sph.baseurl=bn;
  else {
    i=bn.lastIndexOf('/');
    sph.baseurl=bn.substr(0,i)+"/";
  };
  return sph;
  }

function init(){
  console.log(sph);
//  savedmenu=menu;
//  makemenu(menu);
}
</script>

<script src="sph-es.js"></script>
</head>

<!-- main body -->
<body onload='init()'>
<script>
  var sph = window.sph;
//  sph.baseurl="/esglobe/307/graphics/"
</script>
<!--
<img src="cmd.jpg"
     style='position:absolute;left:1000px;top:10px;width:48px;height:216px'
     usemap='#ctlmap'/>
<map name='ctlmap'>
  <area shape='rect' coords='0,0,47,35' href='javascript:sph.orient(0,0)'>
  <area shape='rect' coords='0,36,47,71' href='javascript:sph.rot(0.005)'>
  <area shape='rect' coords='0,72,47,110' href='javascript:sph.rot(-0.005)'>
  <area shape='rect' coords='0,111,47,152' href='javascript:sph.pause()'>
  <area shape='rect' coords='0,153,47,215' href='javascript:sph.stop()'>
</map>
-->
<img src="cmd2.jpg"
     style='position:absolute;left:1000px;top:10px;width:48px;height:208px'
     usemap='#ctlmap'/>
<map name='ctlmap'>
  <area shape='rect' coords='0,8,47,39' href='javascript:sph.orient(0,0)'>
  <area shape='rect' coords='0,48,47,79' href='javascript:sph.rot(0.005)'>
  <area shape='rect' coords='0,88,47,119' href='javascript:sph.rot(-0.005)'>
  <area shape='rect' coords='0,128,47,159' href='javascript:sph.pause()'>
  <area shape='rect' coords='0,168,47,199' href='javascript:sph.stop()'>
</map>

<div class='rhs'>
 <ul>
<li class="dropdown" style="float:left">
<a href="javascript:void(0)" class="dropbtn">MENU</a>
<div class="dropdown-content" style="left:0">
<span id='menu'></span>
</div>
</li>
<!--
<li><a href='javascript:sph.orient(0,0)'>Recenter</a></li>
<li><a href='javascript:sph.rot(0.005)'><img src='ccw2.png'/></a></li>
<li><a href='javascript:sph.rot(-0.005)'><img src='cw2.png'/></a></li>
<li><a href='javascript:sph.pause()'>Pause/resume</a></li>
<li><a href='javascript:sph.stop()'>Stop movie</a></li>
-->
 </ul>
<iframe id='ifr' name="pages" src="http:<?php echo $url?>" height=900px width=800px>
</iframe>
</div>
<span id="overlay"><span>
</body>
</html>

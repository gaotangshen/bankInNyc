<style type="text/css">
#fy_fy a{
    display:block;
    width:15px;
    height:15px;
    border:#333 solid 1px;
    background-color:#CCCCCC;
    margin-right:3px;
    text-decoration:none;
    float:left;
    text-align:center;
    line-height:15px;
    color:#FFFFFF;
}    
#fy_fy a:link {
    background-color:#CCCCCC;
    color:#000000;
}
#fy_fy a:visited {
    background-color:#CCCCCC;
    color:#333333;
}
#fy_fy a:hover{
    background-color:#FFFF99;
}
#fy_fy a:active{
    background-color:#000000;
    color:#FFFF00;
}
</style>
//调用
<div id="fy_content" style="min-height:600px;">
很好用的JS分页代码
</div>
//js
<div id="fy_fy" style="float:right;width:auto;text-align:right; cursor:head; "></div>                    
<script type="text/javascript" language="javascript">
temp_strs=document.getElementById("fy_content").innerHTML;
temp_strs=temp_strs.split("#p#");
var pages=temp_strs.length;
fy_strs=""
if (pages>1){
    document.getElementById("fy_content").innerHTML=temp_strs[0];
  for(i=1;i<=pages;i++){
       fy_strs=fy_strs+"<a href='#' onclick='writes("+i+")' >"+i+"</a>"   //分页代码
  }
}
document.getElementById("fy_fy").innerHTML=fy_strs;
function writes(num){
    document.getElementById("fy_content").innerHTML=temp_strs[num-1];
}
</script>
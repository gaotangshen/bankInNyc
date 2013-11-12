<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk32" />
<title>户外--AA--wwww.7csky.cn</title>
</head>

<body>

<script>
function ShowPager(currShowPage){
 var showDBtxt=document.getElementById("showDBtxt");
 var shoePager=document.getElementById("shoePager");
 var showCurrtxt=document.getElementById("showCurrtxt");
 var showTxts=showDBtxt.innerHTML.split("д");//分页
 try{
  currShowPage=parseInt(currShowPage);//当前页
  if(currShowPage<0) currShowPage=0;
  if(currShowPage>=showTxts.length) currShowPage=showTxts.length-1;
 }
 catch(err){
  //err.description
  currShowPage=0
 }
 //显示分页
 if(showTxts.length>1){
  var pagerText="<a href='javascript:ShowPager("+(currShowPage-1)+");void(0);'>前一页</a>当前第"+(currShowPage+1)+"页共"+showTxts.length+"页<a href='javascript:ShowPager("+(currShowPage+1)+");void(0);'>后一页</a>";
  shoePager.innerHTML=pagerText;
 }


//显示当前页
 for(var showi=0; showi<showTxts.length;showi++){
  if(showi==currShowPage){
   showCurrtxt.innerHTML=showTxts[showi];
   break;
  }
 }
}
</script>
<table>
<tr>
 <td>
    <div id="showCurrtxt" name="showCurrtxt"></div>
    <br />
    <br />
    <div id="shoePager" name="shoePager"></div>
    <div id="showDBtxt" name="showDBtxt" style="visibility:hidden; display:none">
      <p><span style="color:#FF0000">徒步昆明，挑战自我，激情飞扬!
        也许你也需要这样的一个机会来感受户外，
        也许你也需要这样的一个机会来考验自己，
        也许它将会成为你迄今为止徒步走过最长的路；
        让这些在你脑海中出现过几十、几百遍的“也许”，今天就成为现实!
        来吧，参加遨云AA户外活动!与我们相互扶持，感受痛苦，体会快乐!
        留下我们的汗水和足迹；
        留下值得我们一辈子感概的美好回忆；
        伴随一生的友情，挑战自我的信念!前路充满挑战，但一路上有你；</span> </p>
      д<p>来吧，朋友！
        加入“遨云AA户外活动”；
        让我们一起去体验生活，品尝人生的苦与乐!
        注：
        "遨云AA网"是一群计算机软件从业人员自发组织的非赢利性的网站。
        我们不向会员收取任何会员费；</p>д
      <p>http://7csly.cn</p>
    </div>
    </td>
</tr>
</table>

<script>
ShowPager(0);
</script>

</body>
</html>
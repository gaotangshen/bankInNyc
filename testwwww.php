<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk32" />
<title>����--AA--wwww.7csky.cn</title>
</head>

<body>

<script>
function ShowPager(currShowPage){
 var showDBtxt=document.getElementById("showDBtxt");
 var shoePager=document.getElementById("shoePager");
 var showCurrtxt=document.getElementById("showCurrtxt");
 var showTxts=showDBtxt.innerHTML.split("��");//��ҳ
 try{
  currShowPage=parseInt(currShowPage);//��ǰҳ
  if(currShowPage<0) currShowPage=0;
  if(currShowPage>=showTxts.length) currShowPage=showTxts.length-1;
 }
 catch(err){
  //err.description
  currShowPage=0
 }
 //��ʾ��ҳ
 if(showTxts.length>1){
  var pagerText="<a href='javascript:ShowPager("+(currShowPage-1)+");void(0);'>ǰһҳ</a>��ǰ��"+(currShowPage+1)+"ҳ��"+showTxts.length+"ҳ<a href='javascript:ShowPager("+(currShowPage+1)+");void(0);'>��һҳ</a>";
  shoePager.innerHTML=pagerText;
 }


//��ʾ��ǰҳ
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
      <p><span style="color:#FF0000">ͽ����������ս���ң��������!
        Ҳ����Ҳ��Ҫ������һ�����������ܻ��⣬
        Ҳ����Ҳ��Ҫ������һ�������������Լ���
        Ҳ���������Ϊ������Ϊֹͽ���߹����·��
        ����Щ�����Ժ��г��ֹ���ʮ�����ٱ�ġ�Ҳ��������ͳ�Ϊ��ʵ!
        ���ɣ��μ�����AA����!�������໥���֣�����ʹ�࣬������!
        �������ǵĺ�ˮ���㼣��
        ����ֵ������һ���Ӹиŵ����û��䣻
        ����һ�������飬��ս���ҵ�����!ǰ·������ս����һ·�����㣻</span> </p>
      ��<p>���ɣ����ѣ�
        ���롰����AA��������
        ������һ��ȥ�������Ʒ�������Ŀ�����!
        ע��
        "����AA��"��һȺ����������ҵ��Ա�Է���֯�ķ�Ӯ���Ե���վ��
        ���ǲ����Ա��ȡ�κλ�Ա�ѣ�</p>��
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
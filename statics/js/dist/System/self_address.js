var pickerCity=function(n,t){$.ajax({url:"/System/getCity?v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{province_id:n},success:function(n){1==n.status&&t&&t(n.data)}})},pickerArea=function(n,t){$.ajax({url:"/System/getArea?v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{city_id:n},success:function(n){1==n.status&&t&&t(n.data)}})};$(function(){$(".j-self").click(function(){var n=$("#tpl_self").html(),t=$(n);t.find(".s_province").change(function(){var n=t.find(".s_province").val(),e='<option value="0">请选择</option>';pickerCity(n,function(n){$.each(n,function(n,t){e+="<option value='"+t.city_id+"'>"+t.city_name+"</option>"}),$(".s_city").empty().append(e)})}),t.find(".s_city").change(function(){var n=t.find(".s_city").val(),e='<option value="0">请选择</option>';pickerArea(n,function(n){$.each(n,function(n,t){e+="<option value='"+t.area_id+"'>"+t.area_name+"</option>"}),$(".s_area").empty().append(e)})}),$.jBox.show({width:500,title:"添加自提地址",content:t,btnOK:{onBtnClick:function(n){var e=t.find("input[name='name']"),o=t.find("input[name='mobile']"),a=t.find("input[name ='phone']"),i=t.find("select[name='province_id']"),d=t.find("select[name='city_id']"),r=t.find("select[name='area_id']"),c=t.find("textarea[name='address']"),s=t.find("input[name='shop_name']"),l=e.val(),p=o.val(),u=a.val(),m=s.val(),h=i.val(),v=d.val(),f=r.val(),_=c.val(),y=/^1[34578]{1}\d{9}$/;return""==l?void HYD.FormShowError(e,"联系人姓名不能为空"):""==p?void HYD.FormShowError(o,"手机号不能为空"):y.test(p)?0==h?void HYD.FormShowError(i,"请选择省份"):0==v?void HYD.FormShowError(d,"请选择城市"):""==_?void HYD.FormShowError(c,"请填写详细地址"):($.jBox.close(n),void $.ajax({url:"/System/addSelfAddress?v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{name:l,mobile:p,phone:u,province_id:h,city_id:v,area_id:f,address:_,shop_name:m},beforeSend:function(){$.jBox.showloading()},success:function(n){1==n.status?(HYD.hint("success","恭喜您，添加成功！"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，添加失败："+n.msg),$.jBox.hideloading()}})):void HYD.FormShowError(o,"手机号格式错误")}}})}),$(".j-edit").click(function(){var n=$(this),t=n.data("id"),e=n.data("province"),o=n.data("city"),a=n.data("area"),i={mobile:n.data("mobile")||"",phone:n.data("phone")||"",address:n.data("address"),name:n.data("name"),shop_name:n.data("shopname"),province:e,city:o,area:a};pickerCity(e,function(n){var t='<option value="0">请选择</option>';$.each(n,function(n,e){t+=e.city_id==o?"<option value='"+e.city_id+"' selected>"+e.city_name+"</option>":"<option value='"+e.city_id+"'>"+e.city_name+"</option>"}),$(".s_city").empty().append(t)}),pickerArea(o,function(n){var t='<option value="0">请选择</option>';$.each(n,function(n,e){t+=e.area_id==a?"<option value='"+e.area_id+"' selected>"+e.area_name+"</option>":"<option value='"+e.area_id+"'>"+e.area_name+"</option>"}),$(".s_area").empty().append(t)});var d=_.template($("#tpl_self_edit").html(),i),r=$(d);return r.find(".s_province").change(function(){var n=r.find(".s_province").val(),t='<option value="0">请选择</option>';pickerCity(n,function(n){$.each(n,function(n,e){t+="<option value='"+e.city_id+"'>"+e.city_name+"</option>"}),$(".s_city").empty().append(t)})}),r.find(".s_city").change(function(){var n=r.find(".s_city").val(),t='<option value="0">请选择</option>';pickerArea(n,function(n){$.each(n,function(n,e){t+="<option value='"+e.area_id+"'>"+e.area_name+"</option>"}),$(".s_area").empty().append(t)})}),$.jBox.show({width:500,title:"自提地址",content:r,btnOK:{onBtnClick:function(n){var e=r.find("input[name='name']"),o=r.find("input[name='mobile']"),a=r.find("input[name ='phone']"),i=r.find("select[name='province_id']"),d=r.find("select[name='city_id']"),c=r.find("select[name='area_id']"),s=r.find("textarea[name='address']"),l=r.find("input[name='shop_name']"),p=e.val(),u=o.val(),m=a.val(),h=l.val(),v=i.val(),f=d.val(),_=c.val(),y=s.val(),j=/^1[34578]{1}\d{9}$/;return""==p?void HYD.FormShowError(e,"联系人姓名不能为空"):""==u?void HYD.FormShowError(o,"手机号不能为空"):j.test(u)?0==v?void HYD.FormShowError(i,"请选择省份"):0==f?void HYD.FormShowError(d,"请选择城市"):""==y?void HYD.FormShowError(s,"请填写详细地址"):($.jBox.close(n),void $.ajax({url:"/System/editSelfAddress?v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{self_address_id:t,name:p,mobile:u,phone:m,province_id:v,city_id:f,area_id:_,address:y,shop_name:h},beforeSend:function(){$.jBox.showloading()},success:function(n){1==n.status?(HYD.hint("success","恭喜您，编辑成功！"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","对不起，编辑失败："+n.msg),$.jBox.hideloading()}})):void HYD.FormShowError(o,"手机号格式错误")}}}),!1}),$(".j-del").click(function(){var n=$(this).data("id");return $.jBox.show({title:"提示",content:_.template($("#tpl_jbox_simple").html(),{content:"删除后将不可恢复，是否继续？"}),btnOK:{onBtnClick:function(t){$.jBox.close(t),$.ajax({url:"?con=freight&act=del_address&v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{id:n},beforeSend:function(){$.jBox.showloading()},success:function(n){1==n.status?(HYD.hint("success","恭喜，删除成功！"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","抱歉，删除失败："+n.msg),$.jBox.hideloading()}})}}}),!1}),$(".btn_table_delAll").click(function(){var n=[],t=$(".table-ckbs:checked");return t.each(function(){n.push($(this).data("id"))}),n.length?($.jBox.show({title:"提示",content:_.template($("#tpl_jbox_simple").html(),{content:"删除后将不可恢复，是否继续？"}),btnOK:{onBtnClick:function(t){$.jBox.close(t),$.ajax({url:"?con=freight&act=del_address&v="+Math.round(100*Math.random()),type:"post",dataType:"json",data:{id:n},beforeSend:function(){$.jBox.showloading()},success:function(n){1==n.status?(HYD.hint("success","恭喜，批量删除成功！"),setTimeout(function(){window.location.reload()},1e3)):HYD.hint("danger","抱歉，批量删除失败："+n.msg),$.jBox.hideloading()}})}}}),!1):void HYD.hint("warning","对不起，请选择要关闭的订单！")})});

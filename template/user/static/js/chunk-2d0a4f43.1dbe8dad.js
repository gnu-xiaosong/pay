(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0a4f43"],{"0948":function(t,e,a){"use strict";a.r(e);var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("el-card",{attrs:{shadow:"never"}},[a("div",{attrs:{slot:"header"},slot:"header"},[t._v("商户密钥设置")]),a("div",{staticStyle:{"min-height":"60vh",width:"70%"}},[a("el-form",{ref:"form",attrs:{size:"small",model:t.form,"label-width":"100px"}},[a("el-form-item",{attrs:{label:"商户id:"}},[t._v(" "+t._s(t.form.id)+" ")]),a("el-form-item",{attrs:{label:"商户密钥:"}},[t._v(" "+t._s(t.form.key)+" "),a("el-button",{attrs:{type:"success"},on:{click:function(e){return t.generateRdStr()}}},[t._v("重新生成")])],1),a("el-form-item",{attrs:{label:"支付接口:"}},[t._v(" "+t._s(t.pay_api)+" ")]),a("el-form-item",{attrs:{label:"监听地址:"}},[t._v(" "+t._s(t.pay_url)+" ")]),a("el-form-item",[a("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.onSubmit()}}},[t._v("保存设置")])],1)],1)],1)])],1)},s=[],n={data:function(){return{form:{},pay_api:"",pay_url:"",system:{}}},methods:{generateRdStr:function(){for(var t="",e="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",a=0;a<32;a++)t+=e.charAt(Math.floor(Math.random()*e.length));this.form.key=t},onSubmit:function(){var t=this;this.$axios({method:"post",url:"/setUser",headers:{"content-type":"application/json"},data:this.form}).then((function(e){console.log(e.data),t.$message.success(e.data.msg)})).catch((function(t){console.log(t)}))},getSystem:function(){var t=this;this.$axios.get("/getSystem").then((function(e){200==e.data.code?t.system=e.data.data:t.$notify.error({title:"发生错误",message:"请退出重新登陆！"})}))},getUser:function(){var t=this,e=sessionStorage.getItem("token");this.$axios.get("/getUser?token="+e).then((function(e){200==e.data.code?t.form=e.data.data:t.$notify.error({title:"token值发生错误",message:"请退出重新登陆！"})}))}},mounted:function(){this.getUser(),this.getSystem(),this.pay_api="http://"+window.location.host+"/public/index.php/pay",this.pay_url="http://"+window.location.host+"/pay/corn.php"}},r=n,i=a("2877"),l=Object(i["a"])(r,o,s,!1,null,null,null);e["default"]=l.exports}}]);
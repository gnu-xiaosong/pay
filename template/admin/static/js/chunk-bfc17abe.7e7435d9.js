(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-bfc17abe","chunk-63c942a0","chunk-b94b259a","chunk-2d22bf54"],{"02641":function(t,e,n){"use strict";n.r(e);var a=n("f7ec"),o=n("f9ee"),i=n("f0d8"),r=n("0b44"),s=n("3a54"),l=n("eaf8").default.pxtorem,u=o.layout.navTabsHeight,c=o.layout.headerHeight,d=o.layout.layoutTransition,f=o.layout.collapsedWidth,h=o.layout.menuWidth,m=l(f),y=l(h),p=l(u),v=l(c),b=l(u+c),g={components:{fullMenu:a.default,VHeader:r.default,VFooter:i.default,commonHeader:s.default},data:function(){return{layout:o.layout,scrollTop:0,flag:!0,o:null,timer:null}},computed:{marginLeft:function(){return"xs"===this.layout.breakPoint||"sm"===this.layout.breakPoint?0:this.layout.isCollapse?m:y},layoutFixed:function(){return"flow"===this.layout.layoutMode?null:{"margin-left":this.marginLeft,transition:d}},headerFixed:function(){return"flow"===this.layout.layoutMode?null:{position:"fixed",left:this.marginLeft,right:0,top:0,zIndex:99,transition:d}},contentFixed:function(){return"flow"===this.layout.layoutMode?this.layout.isNavTabs?{marginTop:p}:{marginTop:"16px"}:this.layout.isNavTabs?{marginTop:b}:{marginTop:v}}},mounted:function(){this.o=document.querySelector(".ant-layout-sider")},methods:{callBack:function(){this.flag=!0,this.o&&this.o.removeEventListener("transitionend",this.callBack)},handleClick:function(){var t=this;this.o&&this.o.addEventListener("transitionend",this.callBack),this.flag&&(o.layout.isCollapse=!o.layout.isCollapse,this.flag=!1),this.timer=setTimeout(function(){t.flag=!0},200)}},destroyed:function(){this.o&&this.o.removeEventListener("transitionend",this.callBack),clearTimeout(this.timer),this.timer=null}},k=(n("e219"),n("2877")),x=Object(k.a)(g,function(){var t=this.$createElement,e=this._self._c||t;return e("a-layout",{staticStyle:{"min-height":"100vh"},attrs:{id:"components-layout-demo-side"}},[e("full-menu"),e("a-layout",{style:this.layoutFixed},[e("a-layout-header",{staticStyle:{padding:"0"},style:this.headerFixed},[e("v-header",[e("a-icon",{staticClass:"trigger",style:{cursor:this.flag?"pointer":"not-allowed"},attrs:{type:this.layout.isCollapse?"menu-unfold":"menu-fold"},on:{click:this.handleClick}}),e("common-header")],1)],1),e("a-layout-content",{staticClass:"layout1-content",staticStyle:{margin:"0 16px"},style:this.contentFixed},[e("div",[this._t("default")],2)]),e("v-footer")],1)],1)},[],!1,null,null,null);e.default=x.exports},"0b44":function(t,e,n){"use strict";n.r(e);var a=n("4493"),o=n("680a"),i={components:{navTabs:a.default},data:function(){return{layout:o.layout,scrollTop:0}},mounted:function(){}},r=(n("f206"),n("2877")),s=Object(r.a)(i,function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"layout1-header"},[e("div",{staticClass:"layout1-header-inner"},[this._t("default")],2),this.layout.isNavTabs?e("nav-tabs"):this._e()],1)},[],!1,null,null,null);e.default=s.exports},2480:function(t,e,n){},"3a54":function(t,e,n){"use strict";n.r(e);var a={data:function(){return{screen:!1}},methods:{toggleScreen:function(){if(this.screen)document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen?document.webkitCancelFullScreen():document.msExitFullscreen?document.msExitFullscreen():this.$message.error({content:"请升级浏览器，不然我是不会理你的！",duration:3}),this.screen=!1;else{var t=document.documentElement;t.requestFullscreen?t.requestFullscreen():t.mozRequestFullScreen?t.mozRequestFullScreen():t.webkitRequestFullScreen?t.webkitRequestFullScreen():t.msRequestFullscreen?t.msRequestFullscreen():this.$message.error({content:"除了让你升级浏览器对方没什么好说的！",duration:3}),this.screen=!0}}}},o=(n("90b6"),n("2877")),i=Object(o.a)(a,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"fr header-right"},[n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:"点击新增一个订单"}},[n("a-icon",{attrs:{type:"search"}})],1),n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:"查看今日订单"}},[n("a-iconfont",{attrs:{type:"icon-commodity"}})],1),n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:"查看今日营业额"}},[n("a-iconfont",{attrs:{type:"icon-financial_fill"}})],1),n("v-button",{attrs:{tip:"预约消息"}},[n("a-iconfont",{attrs:{type:"icon-wangwang"}})],1),n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:"代办事项"}},[n("a-iconfont",{attrs:{type:"icon-time"}})],1),n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:t.screen?"退出全屏":"全屏"},on:{click:t.toggleScreen}},[n("a-iconfont",{attrs:{type:t.screen?"icon-smallscreen":"icon-send"}})],1),n("v-button",{staticClass:"hidden-xs-only",attrs:{tip:"锁屏"},on:{click:function(e){return t.$router.push("/lock")}}},[n("a-iconfont",{attrs:{type:"icon-lock"}})],1),n("a-divider",{attrs:{type:"vertical"}}),n("a-dropdown",[n("a",{staticClass:"ant-dropdown-link",attrs:{href:"#"}},[n("a-badge",{attrs:{count:99}},[n("a-avatar",{attrs:{src:"https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png"}})],1),t._v("admin\n      "),n("a-icon",{attrs:{type:"down"}})],1),n("a-menu",{attrs:{slot:"overlay"},slot:"overlay"},[n("a-menu-item",{key:"-1"},[n("a",{attrs:{rel:"noopener noreferrer",href:"javascript:;"},on:{click:function(e){return t.$router.push("/userinfo")}}},[t._v("个人中心")])]),n("a-menu-item",{key:"0"},[n("a",{attrs:{rel:"noopener noreferrer",href:"javascript:;"},on:{click:function(e){return t.$router.push("/todo")}}},[t._v("代办事项")])]),n("a-menu-item",{key:"1"},[n("a",{attrs:{rel:"noopener noreferrer",href:"javascript:;"},on:{click:function(e){return t.$router.push("/handler-over")}}},[t._v("交班下班")])]),n("a-menu-divider"),n("a-menu-item",{key:"2"},[n("a",{attrs:{rel:"noopener noreferrer",href:"javascript:;"},on:{click:function(e){return t.$router.replace("/login")}}},[t._v("退出登录")])]),n("a-menu-divider"),n("a-menu-item",{key:"3",attrs:{disabled:""}},[t._v("切换店铺")])],1)],1),n("a-divider",{attrs:{type:"vertical"}})],1)},[],!1,null,"808669f2",null);e.default=i.exports},"90b6":function(t,e,n){"use strict";var a=n("d12d");n.n(a).a},"9f12":function(t,e,n){},d12d:function(t,e,n){},e219:function(t,e,n){"use strict";var a=n("2480");n.n(a).a},f0d8:function(t,e,n){"use strict";n.r(e);var a=n("2877"),o=Object(a.a)({},function(){var t=this.$createElement;return(this._self._c||t)("a-layout-footer",{staticStyle:{"text-align":"center"}},[this._v("\n    云支付 ©2021 Created by  小松科技\n  ")])},[],!1,null,null,null);e.default=o.exports},f206:function(t,e,n){"use strict";var a=n("9f12");n.n(a).a}}]);
(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-2d0e26b9"],{"7f2f":function(n,e,i){"use strict";i.r(e),e.default="# 路由配置相关说明\n```js\n;[\n  {\n    path: '/', // 页面跳转路径必须唯一\n    name: 'home', // 页面的name值，与view下的每个.vue的name一一对应用于缓存等场景\n    redirect: '/index',\n    component: Home, // 一级菜单的组件均为Home\n    meta: {\n      title: '现场管理'// 用于菜单的名字，面包屑和选项卡\n    },\n    children: [\n      {\n        path: '/index',\n        name: 'index',\n        component: loading('views/live/workspace.vue'),\n        meta: {\n          auth: true,//表示是否需要登录才能访问的页面\n          title: '工作台',\n          icon: '' // 菜单的icon\n        }\n      }\n    ]\n  },\n  {\n    path: '/login',\n    name: 'login',\n    component: loading('views/auth/login.vue'),\n    meta: {\n      title: '登录页',\n      hide: true // 是否展示在菜单中\n    }\n  }\n]\n```\n"}}]);
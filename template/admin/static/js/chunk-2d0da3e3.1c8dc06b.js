(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-2d0da3e3"],{"6b89":function(e,a,t){"use strict";t.r(a),t("0d6d");var r={labelCol:{span:4},wrapperCol:{span:8}},n={labelCol:{span:4},wrapperCol:{span:8,offset:4}},o={data:function(){return{formItemLayout:Object.freeze(r),formTailLayout:Object.freeze(n),result:{}}},computed:{form:function(){return this.$form.createForm(this)}},methods:{handleChangeTel:function(e){this.form.setFieldsValue({phone:e})},handleChangeCard:function(e){this.form.setFieldsValue({card:e})},check:function(){var e=this;this.form.validateFields(function(a,t){e.form.setFieldsValue("phone"),a||(e.result=t)})}}},s=t("2877"),l=Object(s.a)(o,function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("v-card",[t("a-alert",{attrs:{message:"输入内容格式化",description:"示例中展示了the-mask结合antd的表单一起使用",type:"info",showIcon:""}}),t("div",[t("a-form",{attrs:{form:e.form}},[t("a-form-item",{attrs:{"label-col":e.formItemLayout.labelCol,"wrapper-col":e.formItemLayout.wrapperCol,label:"手机号"}},[t("the-mask",{directives:[{name:"decorator",rawName:"v-decorator",value:["phone",{initialValue:"",rules:[{required:!0,message:"Input something!"}]}],expression:"[\n                'phone',\n                {\n                  'initialValue':'',\n                  rules: [{\n                    required: true,\n                    message: 'Input something!',\n                  }],\n                }\n              ]"}],staticClass:"v-input ant-input",attrs:{mask:["### #### ####"]},on:{input:e.handleChangeTel}})],1),t("a-form-item",{attrs:{"label-col":e.formItemLayout.labelCol,"wrapper-col":e.formItemLayout.wrapperCol,label:"银行卡"}},[t("the-mask",{directives:[{name:"decorator",rawName:"v-decorator",value:["card",{initialValue:"",rules:[{required:!0,message:"Input something!"}]}],expression:"[\n                'card',\n                {\n                  'initialValue':'',\n                  rules: [{\n                    required: true,\n                    message: 'Input something!',\n                  }],\n                }\n              ]"}],staticClass:"v-input ant-input",attrs:{mask:["#### #### #### ####"]},on:{input:e.handleChangeCard}})],1),t("a-form-item",{attrs:{"label-col":e.formItemLayout.labelCol,"wrapper-col":e.formItemLayout.wrapperCol,label:"姓名"}},[t("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,message:"Please input your phone number!"}]}],expression:"[\n          'name',\n          {\n            rules: [{ required: true, message: 'Please input your phone number!' }],\n          }\n        ]"}],staticStyle:{width:"100%"}})],1)],1),t("a-button",{attrs:{type:"primary"},on:{click:e.check}},[e._v("Check")]),e._v("\n    "+e._s(e.result)+"\n  ")],1)],1)},[],!1,null,"6f6f8a2d",null);a.default=l.exports}}]);
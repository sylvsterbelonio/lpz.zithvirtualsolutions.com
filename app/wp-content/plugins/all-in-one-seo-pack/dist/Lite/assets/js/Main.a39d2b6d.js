var v=Object.defineProperty,d=Object.defineProperties;var f=Object.getOwnPropertyDescriptors;var o=Object.getOwnPropertySymbols;var $=Object.prototype.hasOwnProperty,h=Object.prototype.propertyIsEnumerable;var i=(e,t,r)=>t in e?v(e,t,{enumerable:!0,configurable:!0,writable:!0,value:r}):e[t]=r,s=(e,t)=>{for(var r in t||(t={}))$.call(t,r)&&i(e,r,t[r]);if(o)for(var r of o(t))h.call(t,r)&&i(e,r,t[r]);return e},a=(e,t)=>d(e,f(t));import{a as x}from"./index.24bc83f1.js";import"./ToolsSettings.c7becacb.js";import"./helpers.55800a79.js";import{R as g,a as y}from"./RequiresUpdate.76e69211.js";import{n}from"./vueComponentNormalizer.87056a83.js";import{C as R}from"./Index.909a7a9f.js";import S from"./Redirects.ce867337.js";import"./default-i18n.abde8d59.js";import"./isArrayLikeObject.26ec157b.js";import"./Modal.f47c8aa2.js";import"./index.6be33911.js";import"./client.94d919c5.js";import"./_commonjsHelpers.f40d732e.js";import"./constants.50303a5f.js";import"./cleanForSlug.d874125b.js";import"./RequiresUpdate.33501e39.js";/* empty css             */import"./params.bea1a08d.js";import"./Header.593327d3.js";import"./LicenseKeyBar.f184444d.js";import"./LogoGear.0c3dd5e3.js";import"./AnimatedNumber.b6059bfd.js";import"./Logo.1a5e022a.js";import"./QuestionMark.83ebd18e.js";import"./Support.b1f25bbd.js";import"./Tabs.8b88fa19.js";import"./TruSeoScore.98a47fd6.js";import"./Information.f4b75b56.js";import"./Slide.f5d21606.js";import"./Close.5e7bcb70.js";import"./Exclamation.356738ce.js";import"./Url.781a1d48.js";import"./Gear.c974e953.js";import"./Redirects.68d6878c.js";import"./Index.c4d61e8a.js";import"./JsonValues.08065e69.js";import"./ProBadge.7c0de2f7.js";import"./External.8868c638.js";import"./Checkbox.5873a8d2.js";import"./Checkmark.e7547654.js";import"./Index.6b49ef32.js";import"./Row.13b6f3f1.js";import"./Trash.214b5744.js";import"./Tooltip.3ec20ff5.js";import"./Plus.a9b9ba75.js";import"./Blur.8490ecd2.js";import"./Card.af43a02b.js";import"./Table.873415a5.js";import"./Index.a47fbf4a.js";import"./RequiredPlans.db6c7cbc.js";var E=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div")},M=[];const b={},c={};var F=n(b,E,M,!1,j,null,null,null);function j(e){for(let t in c)this[t]=c[t]}var A=function(){return F.exports}(),L=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div")},T=[];const w={},_={};var C=n(w,L,T,!1,U,null,null,null);function U(e){for(let t in _)this[t]=_[t]}var q=function(){return C.exports}(),B=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div")},N=[];const z={},u={};var I=n(z,B,N,!1,P,null,null,null);function P(e){for(let t in u)this[t]=u[t]}var k=function(){return I.exports}(),D=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div")},G=[];const H={},l={};var J=n(H,D,G,!1,K,null,null,null);function K(e){for(let t in l)this[t]=l[t]}var O=function(){return J.exports}(),Q=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div")},V=[];const W={},p={};var X=n(W,Q,V,!1,Y,null,null,null);function Y(e){for(let t in p)this[t]=p[t]}var Z=function(){return X.exports}(),tt=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("core-main",{attrs:{"page-name":e.strings.pageName,"show-save-button":e.showSaveButton,"exclude-tabs":e.excludeTabs}},[r(e.$route.name,{tag:"component"})],1)},et=[];const rt={components:{CoreMain:R,FullSiteRedirect:A,ImportExport:q,Logs:k,Logs404:O,Redirects:S,Settings:Z},mixins:[g,y],data(){return{strings:{pageName:this.$t.__("Redirects",this.$td)}}},computed:a(s({},x("redirects",["options"])),{showSaveButton(){return this.$route.name!=="redirects"&&this.$route.name!=="groups"&&this.$route.name!=="logs-404"&&this.$route.name!=="logs"&&this.$route.name!=="import-export"},excludeTabs(){const e=this.$addons.isActive("aioseo-redirects")?this.getExcludedUpdateTabs("aioseo-redirects"):this.getExcludedActivationTabs("aioseo-redirects");return this.options.logs.log404.enabled||e.push("logs-404"),(!this.options.logs.redirects.enabled||this.options.main.method==="server")&&e.push("logs"),e}})},m={};var nt=n(rt,tt,et,!1,ot,null,null,null);function ot(e){for(let t in m)this[t]=m[t]}var re=function(){return nt.exports}();export{re as default};
module.exports=function(t){var e={};function o(n){if(e[n])return e[n].exports;var r=e[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}return o.m=t,o.c=e,o.d=function(t,e,n){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)o.d(n,r,function(e){return t[e]}.bind(null,r));return n},o.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="",o(o.s=9)}([function(t,e){t.exports=flarum.core.compat.extend},function(t,e){t.exports=flarum.core.compat.app},function(t,e){t.exports=flarum.core.compat["models/Discussion"]},function(t,e){t.exports=flarum.core.compat.Model},function(t,e){t.exports=flarum.core.compat["states/DiscussionListState"]},function(t,e){t.exports=flarum.core.compat["utils/DiscussionControls"]},function(t,e){t.exports=flarum.core.compat["components/Button"]},function(t,e){t.exports=flarum.core.compat["components/Badge"]},,function(t,e,o){"use strict";o.r(e);var n=o(0),r=o(1),a=o.n(r),f=o(4),p=o.n(f),u=o(5),c=o.n(u),s=o(6),i=o.n(s),l=o(3),d=o.n(l),m=o(2),b=o.n(m);b.a.prototype.frontpage=d.a.attribute("frontpage"),b.a.prototype.front=d.a.attribute("front");var g=o(7),x=o.n(g);b.a.prototype.frontpage=d.a.attribute("frontpage"),a.a.initializers.add("fof/frontpage",(function(){Object(n.extend)(p.a.prototype,"requestParams",(function(t){"front"===app.current.get("routeName")&&(t.filter.q=(t.filter.q||"")+"is:frontpage")})),Object(n.extend)(p.a.prototype,"sortMap",(function(t){delete t.latest,delete t.newest,delete t.top,delete t.oldest,t.front="-frontdate",t.latest="-lastPostedAt",t.newest="-createdAt",t.oldest="createdAt",t.top="-commentCount"})),Object(n.extend)(c.a,"moderationControls",(function(t,e){var o=e.frontpage();e.front()&&t.add("frontpage",i.a.component({icon:"fas fa-home",onclick:function(){o=!o,e.save({frontpage:o})}},app.translator.trans(e.frontpage()?"core.forum.post_controls.pull_from_front_button":"core.forum.post_controls.push_to_front_button")))})),Object(n.extend)(b.a.prototype,"badges",(function(t){this.frontpage()&&t.add("frontpage",x.a.component({type:"frontpage",label:app.translator.trans("core.forum.badge.frontpage_tooltip"),icon:"fas fa-home"}),10)}))}))}]);
//# sourceMappingURL=forum.js.map
function error(e){alert("ERROR("+e.code+"): "+e.message)}function createMap(e){var t=e.coords.latitude,o=e.coords.longitude;currentMarker=L.marker([t,o]),map=new L.Map("map-public");var n=new L.TileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",{minZoom:10,maxZoom:18,attribution:'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'});map.setView(new L.LatLng(t,o),15),map.addLayer(n),map.addLayer(locationsLayer);var a=L.popup({autoClose:!1,closeOnClick:!1,className:"current-popup"}).setContent("Tú estás aquí");currentMarker.addTo(map).bindPopup(a).openPopup(),loadLocations(),map.on("zoomend",function(){loadLocations()}),map.on("dragend",function(){loadLocations()})}function loadLocations(){jQuery.post(jQuery("#admin-url").val(),{action:"getEventsInBounds",north:map.getBounds().getNorth(),south:map.getBounds().getSouth(),west:map.getBounds().getWest(),east:map.getBounds().getEast()},function(e){locationsLayer.clearLayers();for(var t,o,n,a=JSON.parse(e),r=0;r<a.locations.length;r++){t=a.locations[r].meta["nwm-wp-location-lat"][0],o=a.locations[r].meta["nwm-wp-location-lng"][0],n=L.marker([t,o]);var s=L.popup({closeOnClick:!1,autoClose:!1,closeButton:!1}).setContent(a.locations[r].post_title);n.bindPopup(s),locationsLayer.addLayer(n)}locationsLayer.eachLayer(function(e){e.openPopup()})})}function getDistanceFromLatLonInKm(e,t,o,n){var a=deg2rad(o-e),r=deg2rad(n-t),s=Math.sin(a/2)*Math.sin(a/2)+Math.cos(deg2rad(e))*Math.cos(deg2rad(o))*Math.sin(r/2)*Math.sin(r/2);return 6371*(2*Math.atan2(Math.sqrt(s),Math.sqrt(1-s)))}function deg2rad(e){return e*(Math.PI/180)}!function(e,t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],function(o){return t(o,e,e.document)}):"object"==typeof module&&module.exports?module.exports=t(require("jquery"),e,e.document):t(jQuery,e,e.document)}("undefined"!=typeof window?window:this,function(e,t,o,n){"use strict";function a(){return L.height()+C.offset}function r(o,n,r,s){if(w===o&&(r=!1),!0===T)return!0;if(m[o]){if(H=!1,!0===D&&(C.afterRender(),D=!1),r&&"function"==typeof C.before&&!1===C.before(o,g))return!0;if(S=1,O=p[o],!1===D&&w>o&&!1===s&&v[o]&&(l=a(),S=parseInt(g[o].outerHeight()/l),O=parseInt(p[o])+(g[o].outerHeight()-l)),C.updateHash&&C.sectionName&&(!0!==D||0!==o))if(history.pushState)try{history.replaceState(null,null,m[o])}catch(e){t.console&&console.warn("Scrollify warning: Page must be hosted to manipulate the hash value.")}else t.location.hash=m[o];if(w=o,n)e(C.target).stop().scrollTop(O),r&&C.after(o,g);else{if(E=!0,e().velocity?e(C.target).stop().velocity("scroll",{duration:C.scrollSpeed,easing:C.easing,offset:O,mobileHA:!1}):e(C.target).stop().animate({scrollTop:O},C.scrollSpeed,C.easing),t.location.hash.length&&C.sectionName&&t.console)try{e(t.location.hash).length&&console.warn("Scrollify warning: ID matches hash value - this will cause the page to anchor.")}catch(e){}e(C.target).promise().done(function(){E=!1,D=!1,r&&C.after(o,g)})}}}function s(e){function t(t){for(var o=0,n=e.slice(Math.max(e.length-t,1)),a=0;a<n.length;a++)o+=n[a];return Math.ceil(o/t)}return t(10)>=t(70)}function i(e,t){for(var o=m.length;o>=0;o--)"string"==typeof e?m[o]===e&&(y=o,r(o,t,!0,!0)):o===e&&(y=o,r(o,t,!0,!0))}var c,u,l,h,d,f,p=[],m=[],g=[],v=[],y=0,w=0,S=1,M=!1,L=e(t),b=L.scrollTop(),H=!1,E=!1,x=!1,T=!1,I=[],k=(new Date).getTime(),D=!0,N=!1,O=0,j="onwheel"in o?"wheel":o.onmousewheel!==n?"mousewheel":"DOMMouseScroll",C={section:".section",sectionName:"section-name",interstitialSection:"",easing:"easeOutExpo",scrollSpeed:1100,offset:0,scrollbars:!0,target:"html,body",standardScrollElements:!1,setHeights:!0,overflowScroll:!0,updateHash:!0,touchScroll:!0,before:function(){},after:function(){},afterResize:function(){},afterRender:function(){}},R=function(n){function i(t){e().velocity?e(C.target).stop().velocity("scroll",{duration:C.scrollSpeed,easing:C.easing,offset:t,mobileHA:!1}):e(C.target).stop().animate({scrollTop:t},C.scrollSpeed,C.easing)}function w(t){t&&(b=L.scrollTop());var o=C.section;v=[],C.interstitialSection.length&&(o+=","+C.interstitialSection),!1===C.scrollbars&&(C.overflowScroll=!1),l=a(),e(o).each(function(t){var o=e(this);C.setHeights?o.is(C.interstitialSection)?v[t]=!1:o.css("height","auto").outerHeight()<l||"hidden"===o.css("overflow")?(o.css({height:l}),v[t]=!1):(o.css({height:o.height()}),C.overflowScroll?v[t]=!0:v[t]=!1):o.outerHeight()<l||!1===C.overflowScroll?v[t]=!1:v[t]=!0}),t&&L.scrollTop(b)}function D(o,n){var a=C.section;C.interstitialSection.length&&(a+=","+C.interstitialSection),p=[],m=[],g=[],e(a).each(function(o){var n=e(this);p[o]=o>0?parseInt(n.offset().top)+C.offset:parseInt(n.offset().top),C.sectionName&&n.data(C.sectionName)?m[o]="#"+n.data(C.sectionName).toString().replace(/ /g,"-"):!1===n.is(C.interstitialSection)?m[o]="#"+(o+1):(m[o]="#",o===e(a).length-1&&o>1&&(p[o]=p[o-1]+(parseInt(e(e(a)[o-1]).outerHeight())-parseInt(e(t).height()))+parseInt(n.outerHeight()))),g[o]=n;try{e(m[o]).length&&t.console&&console.warn("Scrollify warning: Section names can't match IDs - this will cause the browser to anchor.")}catch(e){}t.location.hash===m[o]&&(y=o,M=!0)}),!0===o&&r(y,!1,!1,!1)}function O(){return!v[y]||!((b=L.scrollTop())>parseInt(p[y]))}function R(){return!v[y]||(b=L.scrollTop(),l=a(),!(b<parseInt(p[y])+(g[y].outerHeight()-l)-28))}N=!0,e.easing.easeOutExpo=function(e,t,o,n,a){return t==a?o+n:n*(1-Math.pow(2,-10*t/a))+o},h={handleMousedown:function(){if(!0===T)return!0;H=!1,x=!1},handleMouseup:function(){if(!0===T)return!0;H=!0,x&&h.calculateNearest(!1,!0)},handleScroll:function(){if(!0===T)return!0;c&&clearTimeout(c),c=setTimeout(function(){if(x=!0,!1===H)return!1;H=!1,h.calculateNearest(!1,!0)},200)},calculateNearest:function(e,t){b=L.scrollTop();for(var o,n=1,a=p.length,s=0,i=Math.abs(p[0]-b);n<a;n++)(o=Math.abs(p[n]-b))<i&&(i=o,s=n);(R()&&s>y||O())&&(y=s,r(s,e,t,!1))},wheelHandler:function(o){if(!0===T)return!0;if(C.standardScrollElements&&(e(o.target).is(C.standardScrollElements)||e(o.target).closest(C.standardScrollElements).length))return!0;v[y]||o.preventDefault();var n=(new Date).getTime(),a=(o=o||t.event).originalEvent.wheelDelta||-o.originalEvent.deltaY||-o.originalEvent.detail,i=Math.max(-1,Math.min(1,a));if(I.length>149&&I.shift(),I.push(Math.abs(a)),n-k>200&&(I=[]),k=n,E)return!1;if(i<0){if(y<p.length-1&&R()){if(!s(I))return!1;o.preventDefault(),E=!0,r(++y,!1,!0,!1)}}else if(i>0&&y>0&&O()){if(!s(I))return!1;o.preventDefault(),E=!0,r(--y,!1,!0,!1)}},keyHandler:function(e){return!0===T||!1===o.activeElement.readOnly||!0!==E&&void(38==e.keyCode||33==e.keyCode?y>0&&O()&&(e.preventDefault(),r(--y,!1,!0,!1)):40!=e.keyCode&&34!=e.keyCode||y<p.length-1&&R()&&(e.preventDefault(),r(++y,!1,!0,!1)))},init:function(){C.scrollbars?(L.on("mousedown",h.handleMousedown),L.on("mouseup",h.handleMouseup),L.on("scroll",h.handleScroll)):e("body").css({overflow:"hidden"}),L.on(j,h.wheelHandler),L.on("keydown",h.keyHandler)}},d={touches:{touchstart:{y:-1,x:-1},touchmove:{y:-1,x:-1},touchend:!1,direction:"undetermined"},options:{distance:30,timeGap:800,timeStamp:(new Date).getTime()},touchHandler:function(t){if(!0===T)return!0;if(C.standardScrollElements&&(e(t.target).is(C.standardScrollElements)||e(t.target).closest(C.standardScrollElements).length))return!0;var o;if(void 0!==t&&void 0!==t.touches)switch(o=t.touches[0],t.type){case"touchstart":d.touches.touchstart.y=o.pageY,d.touches.touchmove.y=-1,d.touches.touchstart.x=o.pageX,d.touches.touchmove.x=-1,d.options.timeStamp=(new Date).getTime(),d.touches.touchend=!1;case"touchmove":d.touches.touchmove.y=o.pageY,d.touches.touchmove.x=o.pageX,d.touches.touchstart.y!==d.touches.touchmove.y&&Math.abs(d.touches.touchstart.y-d.touches.touchmove.y)>Math.abs(d.touches.touchstart.x-d.touches.touchmove.x)&&(t.preventDefault(),d.touches.direction="y",d.options.timeStamp+d.options.timeGap<(new Date).getTime()&&0==d.touches.touchend&&(d.touches.touchend=!0,d.touches.touchstart.y>-1&&Math.abs(d.touches.touchmove.y-d.touches.touchstart.y)>d.options.distance&&(d.touches.touchstart.y<d.touches.touchmove.y?d.up():d.down())));break;case"touchend":!1===d.touches[t.type]&&(d.touches[t.type]=!0,d.touches.touchstart.y>-1&&d.touches.touchmove.y>-1&&"y"===d.touches.direction&&(Math.abs(d.touches.touchmove.y-d.touches.touchstart.y)>d.options.distance&&(d.touches.touchstart.y<d.touches.touchmove.y?d.up():d.down()),d.touches.touchstart.y=-1,d.touches.touchstart.x=-1,d.touches.direction="undetermined"))}},down:function(){y<p.length&&(R()&&y<p.length-1?r(++y,!1,!0,!1):(l=a(),Math.floor(g[y].height()/l)>S?(i(parseInt(p[y])+l*S),S+=1):i(parseInt(p[y])+(g[y].outerHeight()-l))))},up:function(){y>=0&&(O()&&y>0?r(--y,!1,!0,!1):S>2?(l=a(),S-=1,i(parseInt(p[y])+l*S)):(S=1,i(parseInt(p[y]))))},init:function(){if(o.addEventListener&&C.touchScroll){var e={passive:!1};o.addEventListener("touchstart",d.touchHandler,e),o.addEventListener("touchmove",d.touchHandler,e),o.addEventListener("touchend",d.touchHandler,e)}}},f={refresh:function(e,t){clearTimeout(u),u=setTimeout(function(){w(!0),D(t),e&&C.afterResize()},400)},handleUpdate:function(){f.refresh(!1,!1)},handleResize:function(){f.refresh(!0,!1)},handleOrientation:function(){f.refresh(!0,!0)}},C=e.extend(C,n),w(!1),D(!1),!0===M?r(y,!1,!0,!0):setTimeout(function(){h.calculateNearest(!0,!1)},200),p.length&&(h.init(),d.init(),L.on("resize",f.handleResize),o.addEventListener&&t.addEventListener("orientationchange",f.handleOrientation,!1))};return R.move=function(t){if(t===n)return!1;t.originalEvent&&(t=e(this).attr("href")),i(t,!1)},R.instantMove=function(e){if(e===n)return!1;i(e,!0)},R.next=function(){y<m.length&&r(y+=1,!1,!0,!0)},R.previous=function(){y>0&&r(y-=1,!1,!0,!0)},R.instantNext=function(){y<m.length&&r(y+=1,!0,!0,!0)},R.instantPrevious=function(){y>0&&r(y-=1,!0,!0,!0)},R.destroy=function(){if(!N)return!1;C.setHeights&&e(C.section).each(function(){e(this).css("height","auto")}),L.off("resize",f.handleResize),C.scrollbars&&(L.off("mousedown",h.handleMousedown),L.off("mouseup",h.handleMouseup),L.off("scroll",h.handleScroll)),L.off(j,h.wheelHandler),L.off("keydown",h.keyHandler),o.addEventListener&&C.touchScroll&&(o.removeEventListener("touchstart",d.touchHandler,!1),o.removeEventListener("touchmove",d.touchHandler,!1),o.removeEventListener("touchend",d.touchHandler,!1)),p=[],m=[],g=[],v=[]},R.update=function(){if(!N)return!1;f.handleUpdate()},R.current=function(){return g[y]},R.currentIndex=function(){return y},R.disable=function(){T=!0},R.enable=function(){T=!1,N&&h.calculateNearest(!1,!1)},R.isDisabled=function(){return T},R.setOptions=function(o){if(!N)return!1;"object"==typeof o?(C=e.extend(C,o),f.handleUpdate()):t.console&&console.warn("Scrollify warning: setOptions expects an object.")},e.scrollify=R,R});var map,currentMarker,locationsLayer=new L.layerGroup;window.onload=void 0,jQuery(document).ready(function(){jQuery.scrollify({section:".mv-scrollify"})});
//# sourceMappingURL=script.js.map

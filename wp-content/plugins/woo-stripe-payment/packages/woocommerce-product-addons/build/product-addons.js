(()=>{"use strict";var t={n:r=>{var e=r&&r.__esModule?()=>r.default:()=>r;return t.d(e,{a:e}),e},d:(r,e)=>{for(var n in e)t.o(e,n)&&!t.o(r,n)&&Object.defineProperty(r,n,{enumerable:!0,get:e[n]})},o:(t,r)=>Object.prototype.hasOwnProperty.call(t,r),r:t=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})}},r={};function e(t,r){(null==r||r>t.length)&&(r=t.length);for(var e=0,n=new Array(r);e<r;e++)n[e]=t[e];return n}function n(t){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},n(t)}function o(t,r,e){return o=function(t,r){if("object"!=n(t)||!t)return t;var e=t[Symbol.toPrimitive];if(void 0!==e){var o=e.call(t,"string");if("object"!=n(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(t)}(r),(r="symbol"==n(o)?o:o+"")in t?Object.defineProperty(t,r,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[r]=e,t;var o}t.r(r);const a=window.jQuery;var c=t.n(a);const i=window.wc_stripe;function u(t,r){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);r&&(n=n.filter((function(r){return Object.getOwnPropertyDescriptor(t,r).enumerable}))),e.push.apply(e,n)}return e}function l(t){for(var r=1;r<arguments.length;r++){var e=null!=arguments[r]?arguments[r]:{};r%2?u(Object(e),!0).forEach((function(r){o(t,r,e[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):u(Object(e)).forEach((function(r){Object.defineProperty(t,r,Object.getOwnPropertyDescriptor(e,r))}))}return t}var f=function(t){i.product_gateways.forEach((function(t){t.maybe_calculate_cart&&t.maybe_calculate_cart()}))};c()((function(){i.product_gateways.length&&(i.product_gateways.forEach((function(t){var r=t.get_add_to_cart_data;t.get_add_to_cart_data=function(){return l(l({},r.call(t)),c()("form.cart .wc-pao-addon-field").serializeArray().reduce((function(t,r){if(/([\w\-\_]+)\[\]$/.test(r.name)){var n=r.name.substring(0,r.name.length-2);return l(l({},t),{},o({},n,[].concat(function(t){if(Array.isArray(t))return e(t)}(a=t[n]||[])||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(a)||function(t,r){if(t){if("string"==typeof t)return e(t,r);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?e(t,r):void 0}}(a)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}(),[r.value])))}var a;return l(l({},t),{},o({},r.name,r.value))}),{}))}})),c()(document.body).on("updated_addons","form.cart",f))})),(this.wc_stripe=this.wc_stripe||{})["product-addons"]=r})();
//# sourceMappingURL=product-addons.js.map
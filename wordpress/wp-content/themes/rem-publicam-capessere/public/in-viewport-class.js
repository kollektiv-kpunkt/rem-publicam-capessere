"use strict";
!(function (e, t) {
  function n(e, t) {
    return e.classList
      ? e.classList.contains(t)
      : new RegExp("(^| )" + t + "( |$)", "gi").test(e.className);
  }
  function s(e, t) {
    return e.classList ? e.classList.add(t) : (e.className += " " + t);
  }
  function i(e, t) {
    return e.classList
      ? e.classList.remove(t)
      : (e.className = e.className.replace(
          new RegExp("(^|\\b)" + t.split(" ").join("|") + "(\\b|$)", "gi"),
          " "
        ));
  }
  function a() {
    f = t.getElementsByClassName(r);
  }
  function c() {
    for (
      var a = e.pageYOffset || t.documentElement.scrollTop,
        c =
          a +
          (e.innerHeight ||
            t.documentElement.clientHeight ||
            t.body.clientHeight),
        r = e.pageYOffset || t.documentElement.scrollTop,
        g = 0,
        m = f.length;
      g < m;
      g += 1
    ) {
      var p = f[g];
      !0 === o(p, r, a, c)
        ? n(p, l) || (s(p, l), n(p, u) || s(p, u))
        : n(p, l) && (i(p, l), n(p, d) || s(p, d));
    }
  }
  function o(e, t, n, s) {
    var i = e.getBoundingClientRect().top + t;
    return i + e.offsetHeight >= n && i < s;
  }
  var r = "i-v",
    l = "in-viewport",
    u = "in-viewport-once",
    d = "was-in-viewport",
    f = [];
  t.onreadystatechange = function () {
    "interactive" === t.readyState &&
      (a(),
      e.addEventListener("scroll", c),
      e.addEventListener("resize", c),
      c());
  };
})(window, document);
//# sourceMappingURL=in-viewport-class.min.js.map

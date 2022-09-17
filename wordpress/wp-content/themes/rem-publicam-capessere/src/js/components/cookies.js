glowCookies.start("en", {
  hideAfterClick: true,
  policyVersion: 1,
  border: "none",
  customScript: [
    {
      type: "custom",
      position: "body",
      content: "_paq.push(['rememberConsentGiven']);",
    },
  ],
  policyLink: "/datenschutz",
  bannerDescription:
    "Um unsere Kampagne zu optimieren, setzen wir auf unserer Webseite Cookies ein. Mit deinem Einverständnis hilft du uns, eine effiziente Kampagne durchzuführen.",
  bannerLinkText: "Mehr erfahren",
  bannerBackground: "#ffffff",
  bannerColor: "#232323",
  bannerHeading: "<span style='color: var(--prim)'>Datenschutz</span>",
  bannerHeadingColor: "var(--prim)",
  acceptBtnText: "Zustimmen",
  acceptBtnColor: "#ffffff",
  acceptBtnBackground: "var(--prim)",
  rejectBtnText: '<i class="fas" id="cookie-reject"></i>',
  rejectBtnColor: "white",
  rejectBtnBackground: "black",
});

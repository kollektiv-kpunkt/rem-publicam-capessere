import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import App from "./components/App/App";
import Devbutton from "./components/Devbutton/Devbutton";
import Navbar from "./components/Navbar/Navbar";
import "./styles/fonts/fonts.css";
import Hero from "./components/Hero/Hero";
import Intro from "./components/Intro/Intro";
import CallToAction from "./components/CallToAction/CallToAction";
import Positions from "./components/Positions/Positions";
import FooterCtA from "./components/FooterCtA/FooterCtA";
import Footer from "./components/Footer/Footer";

ReactDOM.render(
  <div>
    <App>
      <Navbar />
      <Hero />
      <Intro />
      <CallToAction />
      <Positions />
      <FooterCtA />
      <Footer />
    </App>
    <Devbutton figmalink="https://www.figma.com/file/Zu1qFcUmIZAQf8FNy68Zg3/PN-35-Proto?node-id=0%3A1" />
  </div>,
  document.getElementById("root")
);

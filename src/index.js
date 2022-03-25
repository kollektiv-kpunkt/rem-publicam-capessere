import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import App from "./components/App/App";
import Devbutton from "./components/Devbutton/Devbutton";
import Navbar from "./components/Navbar/Navbar";
import "./styles/fonts/fonts.css";

ReactDOM.render(
  <div>
    <App>
      <Navbar />
    </App>
    <Devbutton figmalink="https://www.figma.com/file/Zu1qFcUmIZAQf8FNy68Zg3/PN-35-Proto?node-id=0%3A1" />
  </div>,
  document.getElementById("root")
);

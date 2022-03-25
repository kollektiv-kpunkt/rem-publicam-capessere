import React from "react";
import "./LargeContainer.css";

const LargeContainer = (props) => (
  <div className="LargeContainerWrapper">
    <div className="LargeContainerInner">{props.children}</div>
  </div>
);

export default LargeContainer;

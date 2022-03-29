import React from "react";
import "./MediumContainer.css";

const MediumContainer = (props) => (
  <div className="MediumContainerWrapper">
    <div className="MediumContainerInner">{props.children}</div>
  </div>
);

export default MediumContainer;

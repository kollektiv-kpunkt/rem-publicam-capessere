import React from "react";
import PropTypes from "prop-types";
import "./Devbutton.css";

const Devbutton = (props) => (
  <div className="DevbuttonWrapper">
    <a className="K-Devbutton" href={props.figmalink} target="_blank">
      Project in development
    </a>
  </div>
);

Devbutton.propTypes = {
  // bla: PropTypes.string,
};

Devbutton.defaultProps = {
  figmalink: "https://www.figma.com/",
};

export default Devbutton;

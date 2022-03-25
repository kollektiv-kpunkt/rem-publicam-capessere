import React from "react";
import PropTypes from "prop-types";
import "./Button.css";

const Button = (props) => (
  <div className="ButtonWrapper">
    <a href={props.link} className={`button ${props.cname ? props.cname : ""}`}>
      {props.children}
    </a>
  </div>
);

Button.propTypes = {
  link: PropTypes.string,
};

Button.defaultProps = {
  link: "#",
};

export default Button;

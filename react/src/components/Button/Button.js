import React from "react";
import PropTypes from "prop-types";
import "./Button.css";

const Button = (props) => {
  if (props.type === "submit") {
    return (
      <div className="ButtonWrapper">
        <button
          id={props.id ? props.id : ""}
          type="submit"
          href={props.link}
          className={`button ${props.className ? props.className : ""}`}
          onClick={props.onClick ? props.onClick : null}
        >
          {props.children}
        </button>
      </div>
    );
  } else {
    return (
      <div className="ButtonWrapper">
        <a
          id={props.id ? props.id : ""}
          type="submit"
          href={props.link}
          className={`button ${props.className ? props.className : ""}`}
          onClick={props.onClick ? props.onClick : null}
          target={props.target ? props.target : "_self"}
        >
          {props.children}
        </a>
      </div>
    );
  }
};

Button.propTypes = {
  link: PropTypes.string,
};

Button.defaultProps = {
  link: "#",
};

export default Button;

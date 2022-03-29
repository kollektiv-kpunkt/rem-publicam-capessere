import React from "react";
import PropTypes from "prop-types";
import "./Navbar.css";
import Logo from "./logo";
import Button from "../Button/Button";

const Navbar = (props) => (
  <div className="NavbarWrapper">
    <nav className="flex justify-between mx-auto my-3">
      <div id="logo-container">
        <Logo />
      </div>
      <div id="menu-container" className="my-auto">
        <ul className="flex">
          <li>
            <a href="#">Über mich</a>
          </li>
          <li>
            <a href="#">Anliegen</a>
          </li>
          <li>
            <Button link="#mitmachen" className="neg line">
              Mitmachen
            </Button>
          </li>
          <li>
            <Button link="#spenden" className="neg line marginleft">
              Spenden
            </Button>
          </li>
        </ul>
      </div>
    </nav>
  </div>
);

Navbar.propTypes = {
  // bla: PropTypes.string,
};

Navbar.defaultProps = {
  // bla: 'test',
};

export default Navbar;

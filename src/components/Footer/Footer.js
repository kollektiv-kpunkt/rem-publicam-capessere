import React from "react";
import PropTypes from "prop-types";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import { Facebook, Instagram, Twitter } from "react-feather";
import Logo from "../Navbar/logo";
import "./Footer.css"

const Footer = (props) => (
  <div className="FooterWrapper mt-40 mb-4">
    <LargeContainer>
      <div id="footer-upper" className="pb-2  border-b-2 border-neutral-800">
        <div id="footer-some-icons" className="flex gap-2">
          <a
            className="footer-some-icon h-8 w-8 flex justify-center items-center bg-neutral-800 rounded-full"
            href="https://facebook.com"
            target="_blank"
          >
            <Facebook className="text-white h-4" />
          </a>
          <a
            className="footer-some-icon h-8 w-8 flex justify-center items-center bg-neutral-800 rounded-full"
            href="https://instagram.com"
            target="_blank"
          >
            <Instagram className="text-white h-4" />
          </a>
          <a
            className="footer-some-icon h-8 w-8 flex justify-center items-center bg-neutral-800 rounded-full"
            href="https://twitter.com"
            target="_blank"
          >
            <Twitter className="text-white h-4" />
          </a>
        </div>
      </div>
      <div id="footer-lower" className="flex justify-between mt-4">
        <div id="footer-logo-container" className="flex gap-4">
          <Logo />
          <p className="leading-none my-auto text-neutral-800">
            <b>Jacqueline Fehr</b>
            <br />
            in den Regierungsrat
          </p>
        </div>
        <div id="footer-menu-container" className="my-auto">
          <ul className="flex gap-10 font-bold text-neutral-800">
            <li className="footer-menu-item">
              <a href="#">Über mich</a>
            </li>
            <li className="footer-menu-item">
              <a href="#">Anliegen</a>
            </li>
            <li className="footer-menu-item">
              <a href="#">Datenschutz</a>
            </li>
            <li className="footer-menu-item">
              <a href="#">Impressum</a>
            </li>
          </ul>
        </div>
      </div>
    </LargeContainer>
  </div>
);

Footer.propTypes = {
  // bla: PropTypes.string,
};

Footer.defaultProps = {
  // bla: 'test',
};

export default Footer;

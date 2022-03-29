import React from "react";
import PropTypes from "prop-types";
import "./Navbar.css";
import Logo from "./logo";
import Button from "../Button/Button";

class Navbar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isScroll: "",
    };
  }

  componentDidMount() {
    if (window.scrollY > 0) {
      this.setState({
        isScroll: true,
      });
    }

    document.addEventListener("scroll", () => {
      if (window.scrollY > 0) {
        this.setState({
          isScroll: true,
        });
      } else {
        this.setState({
          isScroll: false,
        });
      }
    });
  }

  render() {
    return (
      <div className="NavbarWrapper">
        <div
          className={
            this.state.isScroll
              ? "scrollbar scroll flex w-full"
              : "scrollbar flex w-full"
          }
        >
          <nav className="flex justify-between mx-auto my-3">
            <div id="logo-container" className="my-auto">
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
      </div>
    );
  }
}

Navbar.propTypes = {
  // bla: PropTypes.string,
};

Navbar.defaultProps = {
  // bla: 'test',
};

export default Navbar;

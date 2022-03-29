import React from "react";
import PropTypes from "prop-types";
import "./FooterCtA.css";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Button from "../Button/Button";

const FooterCtA = (props) => (
  <div className="FooterCtAWrapper my-20">
    <LargeContainer>
      <div className="FooterCtA-container">
        <div id="FooterCtA-outer">
          <img src="/FooterCtA.jpg" alt="Image of people protesting" />
          <div id="FooterCtA-blind" />
          <div
            id="FooterCtA-content"
            className="text-white text-right pr-32 py-40"
          >
            <h1 className="text-5xl mb-2">Werde Teil der Veränderung!</h1>
            <p className="text-xl">
              Donec in tristique pulvinar facilisi integer pellentesque velit
              potenti. Dictumst lorem ullamcorper ridiculus aenean in. Enim
              lacinia faucibus risus proin semper.
            </p>
            <div
              id="FooterCtA-button-container"
              className="flex mt-6 justify-end"
            >
              <Button
                target="_blank"
                link="https://mitglied-werden.sp-ps.ch/"
                className="arrow"
              >
                Mitglied werden
              </Button>
              <Button className="arrow neg ml-4">Mitmachen</Button>
            </div>
          </div>
        </div>
      </div>
    </LargeContainer>
  </div>
);

FooterCtA.propTypes = {
  // bla: PropTypes.string,
};

FooterCtA.defaultProps = {
  // bla: 'test',
};

export default FooterCtA;

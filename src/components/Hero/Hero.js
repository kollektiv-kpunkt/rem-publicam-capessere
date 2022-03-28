import React from "react";
import PropTypes from "prop-types";
import "./Hero.css";
import MediumContainer from "../containers/MediumContainer/MediumContainer";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Button from "../Button/Button";

const Hero = (props) => (
  <div className="HeroWrapper mb-20">
    <LargeContainer>
      <div id="heroine-img">
        <div id="heroine-img-blind"></div>
        <img src="/353745750_JF.jpg"></img>
      </div>
      <div id="heroine-testimonial-wrapper">
        <p id="heroine-testimonial">
          «Aliquam lacinia ornare nibh pretium enim bibendum. At eget netus
          maecenas egestas.»
        </p>
        <div id="heroine-buttons" className="flex">
          <Button link="#" cname="line arrow">
            Mehr erfahren
          </Button>
          <Button link="#" cname="black arrow ml-6">
            Positionen
          </Button>
        </div>
      </div>
    </LargeContainer>
  </div>
);

Hero.propTypes = {
  // bla: PropTypes.string,
};

Hero.defaultProps = {
  // bla: 'test',
};

export default Hero;

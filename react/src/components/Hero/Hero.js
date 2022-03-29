import React from "react";
import PropTypes from "prop-types";
import "./Hero.css";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Button from "../Button/Button";
import { Fade, Slide } from "react-awesome-reveal";

const Hero = (props) => (
  <div className="HeroWrapper mb-20">
    <LargeContainer>
      <Fade triggerOnce delay={500} duration={350}>
        <div id="heroine-img">
          <div id="heroine-img-blind"></div>
          <img src="/353745750_JF.jpg"></img>
        </div>
      </Fade>
      <div id="heroine-testimonial-wrapper">
        <p id="heroine-testimonial">
          «Aliquam lacinia ornare nibh pretium enim bibendum. At eget netus
          maecenas egestas.»
        </p>
        <div id="heroine-buttons" className="flex">
          <Button link="#" className="line arrow">
            Mehr erfahren
          </Button>
          <Button link="#" className="black arrow ml-6">
            Unterstützen
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

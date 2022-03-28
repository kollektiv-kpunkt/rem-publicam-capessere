import React from "react";
import PropTypes from "prop-types";
import MediumContainer from "../containers/MediumContainer/MediumContainer";
import Column from "../containers/Column/Column";
//import { Test } from './Intro.styles';

const Intro = (props) => (
  <div className="IntroWrapper mx-14">
    <MediumContainer>
      <h1 className="text-4xl mb-8">Meine Vision für Zürich</h1>
      <Column columns="3" layout="1/2">
        <div style={{ height: "300px" }}></div>
        <div style={{ height: "300px" }}></div>
      </Column>
    </MediumContainer>
  </div>
);

Intro.propTypes = {
  // bla: PropTypes.string,
};

Intro.defaultProps = {
  // bla: 'test',
};

export default Intro;

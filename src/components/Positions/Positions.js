import React from "react";
import PropTypes from "prop-types";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Column from "../containers/Column/Column";
import Position from "./Position/Position";
import "./Positions.css";
import { Fade } from "react-awesome-reveal";

const Positions = (props) => (
  <div className="PositionsWrapper my-14">
    <LargeContainer>
      <Column>
        <div className="mt-10 mb-72">
          <h1 className="text-4xl text-primary">Das Kann Zürich</h1>
          <p>
            Donec in tristique pulvinar facilisi integer pellentesque velit
            potenti. Dictumst lorem ullamcorper ridiculus aenean in. Enim
            lacinia faucibus risus proin semper. Lorem pellentesque nisl, tellus
            lorem facilisi egestas enim vitae morbi. Donec in tristique pulvinar
            facilisi integer pellentesque velit potenti. Dictumst lorem
            ullamcorper ridiculus aenean in.
          </p>
          <div id="positions-readmore" className="mt-3"></div>
        </div>
        <Fade triggerOnce delay={500}>
          <div className="positions-grid flex flex-wrap">
            <Position
              type="fullwidth"
              title="Position 1"
              content="Eu labore esse id quis ad velit sint incididunt elit Lorem quis dolor. Dolore deserunt consequat aliqua sint. Dolore deserunt consequat sunt sit consequat. Non aute sint officia laboris."
              fulltext={{
                p: "Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore. Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore.",
                p: "Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore. Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore.",
              }}
            />
            <Position
              title="Position 2"
              content="Eu labore esse id quis ad velit sint incididunt elit Lorem quis dolor. Dolore deserunt consequat aliqua sint. Dolore deserunt consequat sunt sit consequat. Non aute sint officia laboris."
              fulltext="Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore. Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore."
            />
            <Position
              title="Position 3"
              content="Eu labore esse id quis ad velit sint incididunt elit Lorem quis dolor. Dolore deserunt consequat aliqua sint. Dolore deserunt consequat sunt sit consequat. Non aute sint officia laboris."
              fulltext="Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore. Nulla ullamco sint magna ad sunt et nulla occaecat aute consequat adipisicing incididunt. Enim sint voluptate id exercitation officia exercitation ex nisi incididunt aliqua do labore commodo. Excepteur exercitation nulla anim Lorem aliqua in proident elit commodo officia excepteur occaecat. Esse deserunt labore dolore eu sunt incididunt pariatur. Ipsum quis elit irure commodo duis dolore."
            />
          </div>
        </Fade>
      </Column>
      <div className="positions-image-container">
        <img src="positions-bg.jpg" alt="Positions" />
        <div id="positions-image-blind" />
      </div>
    </LargeContainer>
  </div>
);

export default Positions;

import React from "react";
import MediumContainer from "../containers/MediumContainer/MediumContainer";
import Column from "../containers/Column/Column";
import Button from "../Button/Button";
import "./Intro.css";

const Intro = (props) => (
  <div className="IntroWrapper my-14">
    <MediumContainer>
      <h1 className="text-4xl mb-8 text-primary">Meine Vision für Zürich</h1>
      <Column columns="3" layout="1/2">
        <div id="image-wrapper">
          <div id="image-container">
            <img src="/263202245_JF.jpg" alt="Candidate Jacqueline Fehr" />
            <div id="image-blind"></div>
          </div>
        </div>
        <div id="intro-container">
          <p className="mb-4 text-xl">
            Donec in tristique pulvinar facilisi integer pellentesque velit
            potenti. Dictumst lorem ullamcorper ridiculus aenean in. Enim
            lacinia faucibus risus proin semper. Lorem pellentesque nisl, tellus
            lorem facilisi egestas enim vitae morbi. Vulputate odio urna eget
            elementum iaculis non amet, sed. Praesent tellus sed condimentum
            sagittis. Odio varius ultrices egestas gravida ullamcorper sit mi et
            aliquam.
          </p>
          <Button link="#" cname="black arrow">
            Positionen
          </Button>
        </div>
      </Column>
    </MediumContainer>
  </div>
);

export default Intro;

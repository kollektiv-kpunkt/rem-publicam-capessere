import React from "react";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Column from "../containers/Column/Column";
import "./CallToAction.css";
import Step1 from "./steps/Step1/Step1";
import Step2 from "./steps/Step2/Step2";
import { Fade, Slide } from "react-awesome-reveal";
import { v4 as uuid } from "uuid";
import Step3 from "./steps/Step3/Step3";
import axios from "axios";

class CallToAction extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      step: 1,
      submit: "signup-" + uuid(),
      donate: true,
    };

    this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount() {
    let srcscript = document.createElement("script");
    srcscript.src = "https://tamaro.raisenow.com/sp-zuerich/latest/widget.js";
    document.body.append(srcscript);
  }
  handleSubmit = (e) => {
    e.preventDefault();
    if (this.state.step === 1) {
      this.setState({
        firstname: document.getElementById("firstname").value,
        plz: document.getElementById("plz").value,
        email: document.getElementById("email").value,
        optin: document.getElementById("optin").checked,
        step: 2,
      });
    } else if (this.state.step === 2) {
      this.setState({
        support: document.getElementById("support").checked,
        donate: document.getElementById("donate").checked,
        step: 3,
      });
      axios.post("/api/calltoaction", {
        data: JSON.stringify(this.state),
      });
    }
  };

  render() {
    return (
      <div className="CallToActionWrapper my-20">
        <LargeContainer>
          <Column>
            <Slide delay={500} triggerOnce>
              <Fade delay={600} triggerOnce>
                <div id="cta-img">
                  <div id="cta-img-wrapper">
                    <div id="cta-img-inner">
                      <img src="/Cta_JF.png" />
                      <div id="cta-image-blind"></div>
                      <div id="cta-image-gradient"></div>
                      <div id="cta-img-content">
                        <h2 className="text-4xl">Zusammen für Zürich</h2>
                        <p className="text-end">
                          A eu ut scelerisque sed adipiscing et pellentesque
                          risus facilisis. Quisque rutrum ut ultrices gravida.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </Fade>
            </Slide>
            <Slide direction="right" delay={500} triggerOnce>
              <Fade delay={600} triggerOnce>
                <div id="cta-form" className="py-20">
                  <div id="cta-form-wrapper">
                    <form onSubmit={this.handleSubmit}>
                      {this.state.step === 1 ? <Step1 /> : null}
                      {this.state.step === 2 ? <Step2 /> : null}
                      {this.state.step === 3 ? (
                        <Step3 donate={this.state.donate} />
                      ) : null}
                    </form>
                  </div>
                </div>
              </Fade>
            </Slide>
          </Column>
        </LargeContainer>
      </div>
    );
  }
}

CallToAction.propTypes = {
  // bla: PropTypes.string,
};

CallToAction.defaultProps = {
  // bla: 'test',
};

export default CallToAction;

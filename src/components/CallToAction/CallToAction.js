import React from "react";
import LargeContainer from "../containers/LargeContainer/LargeContainer";
import Column from "../containers/Column/Column";
import "./CallToAction.css";
import Step1 from "./steps/Step1/Step1";
import Step2 from "./steps/Step2/Step2";

class CallToAction extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      step: 1,
    };
  }

  render() {
    return (
      <div className="CallToActionWrapper my-14">
        <LargeContainer>
          <Column>
            <div id="cta-img">
              <div id="cta-img-wrapper">
                <div id="cta-img-inner">
                  <img src="/Cta_Jf.png" />
                  <div id="cta-img-content">
                    <h2 className="text-4xl">Zusammen für Zürich</h2>
                    <p className="text-end">
                      A eu ut scelerisque sed adipiscing et pellentesque risus
                      facilisis. Quisque rutrum ut ultrices gravida.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div id="cta-form">
              <div id="cta-form-wrapper">
                <form action="#">
                  {this.state.step === 1 ? <Step1 /> : null}
                  {this.state.step === 2 ? <Step2 /> : null}
                </form>
              </div>
            </div>
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

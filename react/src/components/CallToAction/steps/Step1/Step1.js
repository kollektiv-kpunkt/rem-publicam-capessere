import React from "react";
import PropTypes from "prop-types";
import Button from "../../../Button/Button";
import { Check, CheckSquare, Square } from "react-feather";

class Step1 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      optin: true,
    };
    this.handleOptin = this.handleOptin.bind(this);
  }

  handleOptin = (e) => {
    this.setState({
      optin: !this.state.optin,
    });
  };

  render() {
    return (
      <div className="Step1Wrapper StepWrapper">
        <div className="input-wrapper">
          <label htmlFor="firstname" className="text-xl">
            Vorname
          </label>
          <input type="text" name="firstname" id="firstname" required />
        </div>
        <div className="input-wrapper">
          <label htmlFor="plz" className="text-xl">
            PLZ
          </label>
          <input type="text" name="plz" id="plz" required />
        </div>
        <div className="input-wrapper fullwidth">
          <label htmlFor="email" className="text-xl">
            E-Mail Adresse
          </label>
          <input type="email" name="email" id="email" required />
        </div>
        <div className="input-wrapper fullwidth checkbox">
          <input type="checkbox" name="optin" id="optin" hidden checked={this.state.optin === true ? "checked" : ""} />
          {this.state.optin === true ? (
            <CheckSquare className="h-4 w-4 text-white" />
          ) : (
            <Square className="h-4 w-4 text-white" />
          )}
          <label
            htmlFor="optin"
            onClick={this.handleOptin}
            className="text-xs block"
          >
            Ich bin einverstanden, dass mich Jacqueline Fehr und die SP Kanton
            Zürich auf dem Laufenden halten. Mehr zum Datenschutz Ich bin
            einverstanden, dass mich Jacqueline Fehr und die SP Kanton Zürich
            auf dem Laufenden halten. Mehr zum Datenschutz
          </label>
        </div>
        <Button link="#" className="arrow neg line" type="submit">
          Unterstützen
        </Button>
      </div>
    );
  }
}

Step1.propTypes = {
  // bla: PropTypes.string,
};

Step1.defaultProps = {
  // bla: 'test',
};

export default Step1;

import React from "react";
import PropTypes from "prop-types";
import { Square, CheckSquare } from "react-feather";
import Button from "../../../Button/Button";

class Step2 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      support: true,
      donate: false,
    };
  }

  handleToggle = (e) => {
    if (e.target.getAttribute("type") == "support")
      this.setState({ support: !this.state.support });
    else this.setState({ donate: !this.state.donate });
  };

  render() {
    return (
      <div className="Step2Wrapper">
        <p className="text-xl text-white mb-4">
          <b>Danke für deine Unterstzützung!</b>
          <br />
          Teile uns doch bitte noch kurz mit, wie du Jacqueline unterstützen
          möchtest:
        </p>
        <div className="StepWrapper">
          <div className="input-wrapper fullwidth checkbox">
            <input
              type="checkbox"
              name="support"
              id="support"
              hidden
              checked={this.state.support === true ? "checked" : ""}
            />
            {this.state.support === true ? (
              <CheckSquare className="h-4 w-4 text-white" />
            ) : (
              <Square className="h-4 w-4 text-white" />
            )}
            <label
              htmlFor="support"
              onClick={this.handleToggle}
              type="support"
              className="leading-none font-bold"
            >
              Ich möchte Jacqueline im Wahlkampf unterstützen!
            </label>
          </div>
          <div className="input-wrapper fullwidth checkbox">
            <input
              type="checkbox"
              name="donate"
              id="donate"
              hidden
              checked={this.state.donate === true ? "checked" : ""}
            />
            {this.state.donate === true ? (
              <CheckSquare className="h-4 w-4 text-white" />
            ) : (
              <Square className="h-4 w-4 text-white" />
            )}
            <label
              htmlFor="donate"
              onClick={this.handleToggle}
              type="donate"
              className="leading-none font-bold"
            >
              Ich möchte für Jacquelines Wahlkampf spenden!
            </label>
          </div>
          <Button link="#" className="arrow black" type="submit">
            Unterstützen
          </Button>
        </div>
      </div>
    );
  }
}

Step2.propTypes = {
  // bla: PropTypes.string,
};

Step2.defaultProps = {
  // bla: 'test',
};

export default Step2;

import React from "react";
import PropTypes from "prop-types";
import Button from "../../Button/Button";
//import { Test } from './Position.styles';

class Position extends React.Component {
  constructor(props) {
    super(props);

    this.handleClick = this.handleClick.bind(this);
  }

  handleClick = (e) => {
    e.preventDefault();
    alert("Folgt: Darstellung in Arbeit");
  };

  render() {
    return (
      <div
        className={this.props.type ? this.props.type + " position" : "position"}
      >
        <div className="PositionWrapper">
          <div className="position-outer text-white bg-primary p-6 box-border">
            <div className="position-inner">
              <h2 className="text-xl">{this.props.title}</h2>
              <p className="text-sm">{this.props.content}</p>
            </div>
          </div>
          <Button className="neg line arrow text-sm" onClick={this.handleClick}>
            Weiterlesen
          </Button>
        </div>
      </div>
    );
  }
}

export default Position;

import React from "react";
import PropTypes from "prop-types";
import "./App.css";

const App = (props) => <div>{props.children}</div>;

App.propTypes = {
  // bla: PropTypes.string,
};

App.defaultProps = {
  // bla: 'test',
};

export default App;

import React from "react";
import PropTypes from "prop-types";
import Donate from "./Donate";
import Share from "./Share/Share";
//import { Test } from './Step3.styles';

const Step3 = (props) => (
  <div className="Step3Wrapper">
    <Share />
    {props.donate ? <Donate /> : null}
  </div>
);

Step3.propTypes = {
  // bla: PropTypes.string,
};

Step3.defaultProps = {
  // bla: 'test',
};

export default Step3;

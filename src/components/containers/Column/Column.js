import React from "react";
import "./Column.css";

class Column extends React.Component {
  constructor(props) {
    super(props);
    this.classes = "";
    if (props.columns) {
      this.classes += "cols-" + props.columns + " columns";
    } else {
      this.classes +=
        `cols-${React.Children.count(props.children)}` + "cols columns";
    }

    if (props.layout) {
      this.classes += ` layout-${props.layout.replace("/", "_")}`;
    }
  }

  render() {
    return (
      <div className="ColumnWrapper">
        <div class={this.classes}>{this.props.children}</div>
      </div>
    );
  }
}

Column.propTypes = {
  // bla: PropTypes.string,
};

Column.defaultProps = {
  // bla: 'test',
};

export default Column;

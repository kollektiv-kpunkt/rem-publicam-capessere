import React from "react";
import PropTypes from "prop-types";
import Button from "../../../../Button/Button";
import "./Share.css";
import TextareaAutosize from "react-textarea-autosize";

const Share = (props) => (
  <div className="ShareWrapper">
    <div id="share-inner" className="mb-4">
      <h1 className="text-2xl text-white">Teile deine Unterstzützung!</h1>
      <p className="text-xl text-white mb-4">
        Danke vielmals für deine Unterstützung! Hilf uns noch mehr Menschen zu
        erreichen, indem du ihnen eine Nachricht über meine Kandidatur schickst!
      </p>
      <TextareaAutosize
        defaultValue="Fugiat cupidatat qui in veniam reprehenderit ea sunt aliquip esse eu eu. Consequat fugiat aliqua Lorem commodo commodo fugiat exercitation ullamco reprehenderit Lorem. Laborum sint ex sit esse cillum id non officia laborum."
        className="flex"
      />
      <div id="share-buttons" className="flex flex-wrap gap-2 mt-2">
        <Button id="whatsapp">Auf WhatsApp teilen</Button>
        <Button id="telegram">Auf Telegram teilen</Button>
        <Button id="signal">Auf Signal teilen</Button>
        <Button id="facebook">Auf Facebook teilen</Button>
        <Button id="email" className="neg line">
          Per Mail teilen
        </Button>
      </div>
    </div>
  </div>
);

Share.propTypes = {
  // bla: PropTypes.string,
};

Share.defaultProps = {
  // bla: 'test',
};

export default Share;

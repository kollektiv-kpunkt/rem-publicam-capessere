import React from "react";

class Donate extends React.Component {
  constructor(props) {
    super(props);
  }

  componentDidMount() {
    window.rnw.tamaro.runWidget("#donation-widget", {
      language: "de",
      testMode: false,
      debug: false,
      purposes: ["p1"],
      purposeDetails: {
        p1: {
          stored_campaign_id: 30307365,
        },
      },
      translations: {
        de: {
          purposes: {
            p1: "Wahlkampf SP Stadt Zürich",
          },
        },
      },
      paymentFormPrefill: {
        stored_customer_email_permission: true,
        stored_customer_donation_receipt: true,
        stored_customer_country: "CH",
        stored_sxt_address_source: "1008",
        //stored_hidden_parameter: 'myValue',
      },
    });
  }

  render() {
    return (
      <div className="DonateWrapper mt-4">
        <h1 className="text-2xl text-white mt-12 mb-4">
          Spende für Jacquelines Wahlkampf!
        </h1>
        <div id="donation-widget"></div>
      </div>
    );
  }
}

export default Donate;

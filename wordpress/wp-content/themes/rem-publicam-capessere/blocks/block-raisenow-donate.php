<div id="donation-widget" class="mt-8"></div>
<script src="<?= $_ENV["RNWSRC"] ?>"></script>
<script>
window.rnw.tamaro.runWidget('#donation-widget', {
    language: 'de',
    testMode: false,
    debug: false,
    purposes: ['p1'],
    purposeDetails: {
        p1: {
            stored_campaign_id: <?= $_ENV["RNWID"] ?>,
        },
    },
    translations: {
        de: {
            purposes: {
                p1: '<?= $_ENV["RNWPURPOSE"] ?>',
            },
        },
    },
    paymentFormPrefill: {
        stored_customer_email_permission: true,
        stored_customer_donation_receipt: true,
        stored_customer_country: 'CH',
        stored_sxt_address_source: '1008',
    },
})
</script>

<style>
:root {
    --tamaro-primary-color: var(--prim);
    --tamaro-primary-color__hover: white;
    --tamaro-primary-bg-color: white;
    --tamaro-border-color: black;
    --tamaro-bg-color: white;
}
</style>
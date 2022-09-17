<div id="optout-form" class="my-6">
    <p>
        <input type="checkbox" id="optout">
        <label for="optout"><strong></strong></label>
    </p>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
  function setOptOutText(element) {
    _paq.push([function() {
      element.checked = !this.isUserOptedOut();
      document.querySelector('label[for=optout] strong').innerText = this.isUserOptedOut()
        ? 'Matomo wird in ihrem Browser aktuell nicht ausgeführt. Klicken Sie hier, um Matomo zu aktivieren.'
        : 'Matomo wird in ihrem Browser aktuell ausgeführt. Klicken Sie hier, um Matomo zu deaktivieren.';
    }]);
  }

  var optOut = document.getElementById("optout");
  optOut.addEventListener("click", function() {
    if (this.checked) {
      _paq.push(['forgetUserOptOut']);
      localStorage.setItem("GlowCookies", 1);
    } else {
      _paq.push(['optUserOut']);
      localStorage.setItem("GlowCookies", 0);
    }
    setOptOutText(optOut);
  });
  setOptOutText(optOut);
});
</script>
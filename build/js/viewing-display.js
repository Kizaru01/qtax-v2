(function ($) {
  var assessment = createSection("qtax-assessment-grid");
  var payment = createSection("qtax-payment-grid");
  var template = document.getElementById("qtax-serving-card");
  var hasContainerUnits = window.CSS && window.CSS.supports &&
    window.CSS.supports("width", "1cqw");

  function createSection(id) {
    return {
      grid: document.getElementById(id),
      windowSlots: Object.create(null),
      records: []
    };
  }

  function sizeLegacyCards(section) {
    var card = section.grid.firstElementChild;
    if (card) {
      // Scale the em fallbacks to the grid cell on Chrome without container units.
      section.grid.style.fontSize =
        Math.min(card.offsetWidth / 100, card.offsetHeight / 28) + "px";
    }
  }

  function renderSection(section) {
    var rows = Math.max(4, Math.ceil(section.records.length / 2));
    var cards = document.createDocumentFragment();

    section.grid.style.gridTemplateRows = "repeat(" + rows + ", minmax(0, 1fr))";
    section.records.forEach(function (record) {
      var card = template.content.cloneNode(true);
      var service = card.querySelector(".ns-card-service");
      card.querySelector(".ns-card-window-num").textContent = record.window || "–";
      card.querySelector(".ns-card-ticket").textContent = record.number || "–";
      service.textContent = iftype(record.type, record.status);
      service.hidden = !service.textContent;
      cards.appendChild(card);
    });

    section.grid.textContent = "";
    section.grid.appendChild(cards);
    if (!hasContainerUnits) {
      sizeLegacyCards(section);
    }
  }

  $("#dt_serving").on("draw.dt", function (event, settings) {
    var records = new $.fn.dataTable.Api(settings).rows().data().toArray();

    records.forEach(function (record) {
      var section = isPaymentServing(record.type, record.status) ? payment : assessment;
      var slot = section.windowSlots[record.window];

      // Keep the last ticket when a window drops out of the active snapshot.
      if (slot === undefined) {
        slot = section.records.length;
        section.windowSlots[record.window] = slot;
      }
      section.records[slot] = record;
    });

    renderSection(assessment);
    renderSection(payment);
  });

  if (!hasContainerUnits) {
    window.addEventListener("resize", function () {
      sizeLegacyCards(assessment);
      sizeLegacyCards(payment);
    });
  }
})(jQuery);


function renderCards(gridId, records) {
  const grid = document.getElementById(gridId);

  const rows = Math.max(4, Math.ceil(records.length / 2));

  grid.style.setProperty("--ns-rows", rows);
  grid.classList.toggle("ns-grid-dense", rows > 4);

  const template = document.getElementById("qtax-serving-card");
  const cards = document.createDocumentFragment();

  for (const record of records) {
    const card = template.content.cloneNode(true);
    const service = card.querySelector(".ns-card-service");

    card.querySelector(".ns-card-window-num").textContent =
      record.window || "–";

    card.querySelector(".ns-card-ticket").textContent =
      record.number || "–";

    service.textContent = iftype(
      record.ifpayment,
      record.type,
      record.status
    );

    service.hidden = !service.textContent;

    cards.appendChild(card);
  }

  grid.replaceChildren(cards);
}

jQuery("#dt_serving").on("draw.dt", function (event, settings) {
  const records = new jQuery.fn.dataTable.Api(settings)
    .rows()
    .data()
    .toArray();

  const assessmentRecords = records.filter(function (record) {
    return record.type === "REGULAR" || record.type === "SPECIAL";
  });

  const paymentRecords = records.filter(function (record) {
    return record.type === "REGULAR5-10" || record.type === "SPECIAL5-10";
  });

  renderCards("qtax-serving-grid", assessmentRecords);
  renderCards("qtax-payment-grid", paymentRecords);
});
jQuery("#dt_serving").on("draw.dt", function (event, settings) {
  const records = new jQuery.fn.dataTable.Api(settings).rows().data().toArray();
  const grid = document.getElementById("qtax-serving-grid");
  const columns = records.length > 4 ? 2 : 1;
  const rows = Math.max(1, Math.ceil(records.length / columns));

  grid.style.setProperty("--ns-cols", columns);
  grid.style.setProperty("--ns-rows", rows);
  grid.classList.toggle("ns-grid-dense", records.length > 6);

  if (!records.length) {
    const empty = document.createElement("div");
    empty.className = "ns-empty";
    empty.textContent = "Waiting for next customer…";
    grid.replaceChildren(empty);
    return;
  }

  const template = document.getElementById("qtax-serving-card");
  const cards = document.createDocumentFragment();

  for (const record of records) {
    const card = template.content.cloneNode(true);
    const service = card.querySelector(".ns-card-service");
    card.querySelector(".ns-card-window-num").textContent = record.window || "–";
    card.querySelector(".ns-card-ticket").textContent = record.number || "–";
    service.textContent = iftype(record.ifpayment, record.type, record.status);
    service.hidden = !service.textContent;
    cards.appendChild(card);
  }

  grid.replaceChildren(cards);
});

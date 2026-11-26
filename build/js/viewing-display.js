
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
    ).replace(/^(Assessment|Payment)\s*-?\s*/i, "")
     .trim();

    service.hidden = !service.textContent;

    cards.appendChild(card);
  }

  grid.innerHTML = "";
  grid.appendChild(cards);
}
// let previousServing = {};
// let isFirstLoad = true;
// let hasLoadedData = false;
// // jQuery("#dt_serving").on("xhr.dt", function (event, settings, json) {
// //   if (json != null) {
// //     hasLoadedData = true;
// //     console.log("Backend data received:", json);
// //   }
// // });
jQuery("#dt_serving").on("draw.dt", function (event, settings) {
  const records = new jQuery.fn.dataTable.Api(settings)
    .rows()
    .data()
    .toArray();
 
  // detectNewServing(records);
  const assessmentRecords = records.filter(function (record) {
    return record.type === "REGULAR" || record.type === "SPECIAL";
  });

  const paymentRecords = records.filter(function (record) {
    return record.type === "REGULAR5-10" || record.type === "SPECIAL5-10";
  });

  renderCards("qtax-serving-grid", assessmentRecords);
  renderCards("qtax-payment-grid", paymentRecords);
});
// function announceTicket(ticketNumber, windowNumber) {
//   const message =
//     "Now serving ticket number " + ticketNumber +
//     ". Please proceed to Window " + windowNumber + ".";

//   const speech = new SpeechSynthesisUtterance(message);

//   speech.lang = "en-US";
//   speech.rate = 1;
//   speech.pitch = 1;
//   speech.volume = 1;

//   window.speechSynthesis.speak(speech);
// }

// function detectNewServing(records) {  
//   console.log({
//     hasLoadedData: hasLoadedData,
//     isFirstLoad: isFirstLoad,
//     previousServing: previousServing,
//     recordCount: records.length
//   });

//   if (!hasLoadedData) {
//     return;
//   }
//   const currentServing = {};

//   for (const record of records) {
//     if (record.status !== "SERVING") {
//       continue;
//     }

//     if (!record.window || !record.number) {
//       continue;
//     }

//     const windowNumber = record.window;
//     const ticketNumber = record.number;

//     currentServing[windowNumber] = ticketNumber;

//     if (
//       !isFirstLoad &&
//       previousServing[windowNumber] !== ticketNumber
//     ) {
//       announceTicket(ticketNumber, windowNumber);
//     }
//   }

//   previousServing = currentServing;
//   isFirstLoad = false;
// }
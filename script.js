const profitForm = document.querySelector("#profitForm");
const profitResult = document.querySelector("#profitResult");
const livestockForm = document.querySelector("#livestockForm");
const livestockResult = document.querySelector("#livestockResult");
const submitStatus = document.querySelector("#submitStatus");
const backendSummary = document.querySelector("#backendSummary");
const backendAverages = document.querySelector("#backendAverages");
const backendLatest = document.querySelector("#backendLatest");
const contactForm = document.querySelector(".contact-form");
const apiUrl = "livestock_api.php";

function formatMoney(value) {
  return new Intl.NumberFormat("sw-TZ", {
    style: "currency",
    currency: "TZS",
    maximumFractionDigits: 0
  }).format(value);
}

function formatNumber(value) {
  return new Intl.NumberFormat("sw-TZ", {
    maximumFractionDigits: 0
  }).format(value);
}

function updateProfit() {
  const birds = Number(document.querySelector("#birds").value) || 0;
  const cost = Number(document.querySelector("#cost").value) || 0;
  const extra = Number(document.querySelector("#extra").value) || 0;
  const price = Number(document.querySelector("#price").value) || 0;
  const sales = birds * price;
  const expenses = birds * cost + extra;
  const profit = sales - expenses;

  profitResult.textContent = `Faida makadirio: ${formatMoney(profit)}`;
}

function updateLivestock() {
  const cows = Number(document.querySelector("#cows").value) || 0;
  const goats = Number(document.querySelector("#goats").value) || 0;
  const chickens = Number(document.querySelector("#chickens").value) || 0;
  const milkRate = Number(document.querySelector("#milkRate").value) || 0;
  const eggRate = Number(document.querySelector("#eggRate").value) || 0;
  const kidRate = Number(document.querySelector("#kidRate").value) || 0;

  const totalAnimals = cows + goats + chickens;
  const totalMilk = cows * milkRate;
  const totalEggs = chickens * eggRate;
  const totalKids = goats * kidRate;

  livestockResult.textContent = `Jumla ya mifugo: ${formatNumber(totalAnimals)} | Maziwa / siku: ${formatNumber(totalMilk)} L | Mayai / siku: ${formatNumber(totalEggs)} | Wanachanga / mwezi: ${formatNumber(totalKids)}`;
}

async function fetchBackendSummary() {
  if (!backendSummary) return;

  try {
    const response = await fetch(apiUrl);
    const result = await response.json();

    if (result.status !== 'ok') {
      backendSummary.querySelector('p').textContent = 'Haikuwezekana kupata data kutoka backend.';
      return;
    }

    const summary = result.summary;
    backendSummary.innerHTML = `
      <strong>Matokeo ya sasa</strong>
      <p>Rekodi: ${formatNumber(summary.totalRecords)}</p>
      <p>Jumla ya mifugo yote: ${formatNumber(summary.totalAnimals)}</p>
      <p>Maziwa yote / siku: ${formatNumber(summary.totalMilk)} L</p>
    `;
    backendAverages.innerHTML = `
      <strong>Wastani wa rekodi</strong>
      <p>Maziwa wastani / rekodi: ${formatNumber(summary.averageMilk)} L</p>
      <p>Mayai wastani / rekodi: ${formatNumber(summary.averageEggs)}</p>
      <p>Wanachanga wastani / rekodi: ${formatNumber(summary.averageKids)}</p>
    `;

    if (summary.latest) {
      backendLatest.innerHTML = `
        <strong>Rekodi ya mwisho</strong>
        <p>Ng'ombe: ${formatNumber(summary.latest.cows)}</p>
        <p>Mbuzi: ${formatNumber(summary.latest.goats)}</p>
        <p>Kuku: ${formatNumber(summary.latest.chickens)}</p>
      `;
    } else {
      backendLatest.innerHTML = `
        <strong>Rekodi ya mwisho</strong>
        <p>Hakuna rekodi iliyohifadhiwa bado.</p>
      `;
    }
  } catch (error) {
    backendSummary.querySelector('p').textContent = 'Tatizo la mtandao au backend.';
  }
}

async function submitLivestock(event) {
  event.preventDefault();
  if (!livestockForm) return;

  const cows = Number(document.querySelector("#cows").value) || 0;
  const goats = Number(document.querySelector("#goats").value) || 0;
  const chickens = Number(document.querySelector("#chickens").value) || 0;
  const milkRate = Number(document.querySelector("#milkRate").value) || 0;
  const eggRate = Number(document.querySelector("#eggRate").value) || 0;
  const kidRate = Number(document.querySelector("#kidRate").value) || 0;

  try {
    const response = await fetch(apiUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ cows, goats, chickens, milkRate, eggRate, kidRate })
    });
    const result = await response.json();

    if (result.status === 'ok') {
      submitStatus.textContent = 'Data imesajiliwa kwa backend.';
      submitStatus.style.color = '#0f766e';
      fetchBackendSummary();
    } else {
      submitStatus.textContent = 'Haikuwezekana kuhifadhi data.';
      submitStatus.style.color = '#b91c1c';
    }
  } catch (error) {
    submitStatus.textContent = 'Tatizo la mtandao wakati wa kuhifadhi.';
    submitStatus.style.color = '#b91c1c';
  }
}

if (profitForm) {
  profitForm.addEventListener("input", updateProfit);
  updateProfit();
}

if (livestockForm) {
  livestockForm.addEventListener("input", updateLivestock);
  livestockForm.addEventListener("submit", submitLivestock);
  updateLivestock();
  fetchBackendSummary();
}

if (contactForm) {
  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const name = document.querySelector("#name").value.trim();
    const phone = document.querySelector("#phone").value.trim();
    const message = document.querySelector("#message").value.trim();
    const text = `Habari BARCO MILY COMPANY, naitwa ${name}. Simu yangu ni ${phone}. ${message}`;
    const whatsappUrl = `https://wa.me/255762453159?text=${encodeURIComponent(text)}`;

    window.open(whatsappUrl, "_blank", "noopener");
  });
}

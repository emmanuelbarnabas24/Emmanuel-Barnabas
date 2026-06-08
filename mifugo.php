<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mifugo | BARCO MILY COMPANY</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="site-header">
    <a class="brand" href="index.html" aria-label="BARCO MILY COMPANY">
      <span>KB</span>
      BARCO MILY COMPANY
    </a>
    <nav aria-label="Menyu kuu">
      <a href="index.html">Nyumbani</a>
      <a href="bidhaa.html">Bidhaa</a>
      <a href="ufugaji.html">Ufugaji</a>
      <a href="mifugo.php">Mifugo</a>
      <a href="admin_login.php">Admin</a>
      <a href="ratiba.html">Ratiba</a>
      <a href="mahesabu.html">Mahesabu</a>
      <a href="mawasiliano.html">Mawasiliano</a>
    </nav>
  </header>

  <main>
    <section class="page-hero page-hero">
      <div>
        <p class="eyebrow">Mfugaji akili</p>
        <h1>Fuatilia idadi ya mifugo na uzalishaji wake kwa urahisi</h1>
        <p>
          Tumia mfumo huu kuhifadhi data ya mifugo na kuona ripoti za uzalishaji kwa muda.
        </p>
      </div>
    </section>

    <section class="page-split">
      <div>
        <p class="eyebrow">Kokotoa uzalishaji</p>
        <h2>Kadiria uzalishaji wa mifugo yako</h2>
        <p>
          Weka idadi ya ng'ombe, mbuzi na kuku pamoja na uzalishaji wa kila mmoja.
          Bofya kuhamisha data kwa backend ili kuipata tena baadaye.
        </p>

        <form class="calculator" id="livestockForm">
          <label for="cows">Ng'ombe</label>
          <input id="cows" name="cows" type="number" min="0" value="10">

          <label for="goats">Mbuzi</label>
          <input id="goats" name="goats" type="number" min="0" value="15">

          <label for="chickens">Kuku</label>
          <input id="chickens" name="chickens" type="number" min="0" value="60">

          <label for="milkRate">Maziwa kwa ng'ombe kwa siku (L)</label>
          <input id="milkRate" name="milkRate" type="number" min="0" value="8">

          <label for="eggRate">Mayai kwa kuku kwa siku</label>
          <input id="eggRate" name="eggRate" type="number" min="0" value="2">

          <label for="kidRate">Wanachanga wa mbuzi kwa mwezi</label>
          <input id="kidRate" name="kidRate" type="number" min="0" value="4">

          <button class="primary-button" type="submit">Hifadhi data</button>
          <output id="livestockResult">Jumla ya mifugo: 85 | Maziwa / siku: 80 L | Mayai / siku: 120 | Wanachanga / mwezi: 60</output>
          <output id="submitStatus" style="margin-top:12px; display:block; color:#0f766e;"></output>
        </form>
      </div>

      <aside class="backend-panel">
        <h3>Backend</h3>
        <p>
          Toleo la backend linahifadhi kila rekodi ya mifugo. Hapa unaweza kuona jumla, wastani, na matokeo ya hivi karibuni.
        </p>
        <div class="backend-card" id="backendSummary">
          <strong>Matokeo ya sasa</strong>
          <p>Inasubiri data ya mifugo.</p>
        </div>
        <div class="backend-card" id="backendAverages">
          <strong>Wastani wa rekodi</strong>
          <p>Weka data kwanza ili ujumbe uonekane.</p>
        </div>
        <div class="backend-card" id="backendLatest">
          <strong>Rekodi ya mwisho</strong>
          <p>Hapa utaona muhtasari wa rekodi ya karibuni.</p>
        </div>
      </aside>
    </section>
  </main>

  <footer class="site-footer">
    <p>BARCO MILY COMPANY</p>
    <span>Simu: +255 762453159 | Location: Dodoma Miyuji | Email: info@kukuborafarm.co.tz</span>
  </footer>

  <script src="script.js"></script>
</body>
</html>

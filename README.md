Kuendesha `kuku-biashara` lokali

Hatua za haraka (Windows, XAMPP):

1. Fungua XAMPP Control Panel, bonyeza Start kwa `MySQL`.
2. Fungua PowerShell, nenda kwenye folda ya project:

```powershell
cd "d:\AI PROJECT\kuku-biashara"
```

3. Endesha script ya kuanza server:

```powershell
.\run-local.ps1
```

4. Fungua kivinjari na nenda: http://localhost:8000/index.html

Matatizo yanayoweza kutokea:
- Kama script inasema `php.exe not found` hakikisha XAMPP imewekwa na path ya `php.exe` iko `C:\xampp\php\php.exe` au ongeza `php` kwenye PATH.
- Kama MySQL haiwezi kuunganishwa, hakikisha `MySQL` imeanza kwenye XAMPP Control Panel na rekebisha `db.php` ukiwa na credentials tofauti.

Faili muhimu:
- `db.php` — muunganisho wa MySQL na uundaji wa jedwali.
- `livestock_api.php` — API ya backend kwa mifugo.
- `mifugo.php`, `index.html`, `script.js` — frontend.

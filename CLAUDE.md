# CLAUDE.md – Website „Classic Card Games 3D“

## Projektzweck
Produktseite der BufoProject-Kartenspiele (Classic Card Games 3D + Premium-Titel) unter **https://bufopro.de/cardgames/**. Die Seite leitet Besucher zu den Steam-Store-Seiten weiter.
`httpdocs/` = Inhalt des Server-Ordners `cardgames/` (Plesk, nginx, PHP 8.3). Remote: github.com/bufopro/website-cardgames (privat).
Details zum Ist-Stand: [docs/ANALYSE.md](docs/ANALYSE.md).

## Deploy-Regeln
- Deployment per VS-Code-SFTP-Extension (`.vscode/sftp.json`, nicht im Repo).
- Tests **nur** in den Testordner `bufopro.de/cardgames/26/`.
- Production (`cardgames/` selbst) **nie direkt** bearbeiten oder hochladen – erst nach ausdrücklicher Freigabe.
- Production-Stände taggen: `prod-JJJJ-MM-TT`.

## Harte Regeln
- **Bestehende URLs und Anker dürfen nicht brechen.** Steam, Stores und alte Links verweisen darauf. Insbesondere:
  - `/cardgames/`, `/cardgames/index.php`, `/cardgames/infos.php` und alle bestehenden Dateien (auch scheinbar ungenutzte wie `dkd10x.exe`, `*.reg`, Bilder) bleiben erreichbar.
  - Steam-Anker (exakt so, im obersten Dokument unter `/cardgames/`): `#hearts`, `#rummy`, `#canasta`, `#ginrummy`, `#skat`, `#crazyeights`, `#thirtyone`. Sie sitzen als `id` auf den `.card`-Divs in `infos.php`, das `index.php` per `include` ausgibt (kein Frameset mehr). Nie umbenennen oder entfernen.
- **Keine Build-Toolchain** (kein npm, kein Bundler, kein Präprozessor). Das Ergebnis bleibt aus reinen Dateien, die per SFTP deploybar sind.
- **Kleine, thematische Commits.**
- Antworten an den Nutzer: **Deutsch, knapp.**

## Konventionen (aus der Analyse)
- Nur **relative Pfade** für eigene Dateien (keine `/…`-Pfade, keine absoluten URLs). Nur so funktioniert dieselbe Fassung unter `/cardgames/26/` und `/cardgames/`.
- Keine Einbindungen von außerhalb `cardgames/` (heute: keine CSS/JS/PHP-Includes von bufopro.de oder Fremd-Domains). Wenn doch nötig, dann bewusst und in docs/ANALYSE.md dokumentiert.
- Encoding: Dateien UTF-8. Der Server sendet `charset=iso-8859-1` → bei sichtbarem Nicht-ASCII-Text `header('Content-Type: text/html; charset=utf-8');` setzen oder Entities verwenden.
- Zeilenenden: LF im Repo (`.gitattributes`), `.reg`-Dateien bleiben byte-genau (CRLF).
- Kaufbuttons verlinken direkt auf `https://store.steampowered.com/app/<id>/`. App-IDs: siehe docs/ANALYSE.md, Abschnitt 8.
- Seiteninhalt ist englisch.

# Analyse – Production-Stand 2026-11-12

Live-URL: **https://bufopro.de/cardgames/** (Plesk, nginx + PHP 8.3).
`httpdocs/` entspricht 1:1 dem Ordner `cardgames/` auf dem Server (Abgleich mit Live-Ausgabe am 2026-11-12: identisch, abgesehen vom gerenderten `date('Y')`).

## 1. Seitenstruktur

| Datei | Rolle |
|---|---|
| `index.php` | Frameset (`<frameset cols=*,0>`) mit einem einzigen Frame `infos.php`. Titel „Classic Card Games 3D“. Kein PHP-Code, kein Viewport, kein `lang`. |
| `infos.php` | Eigentliche Inhaltsseite: Header-Bild, 8 Spiel-Kacheln (Steam-Links), Footer mit Support-Mail, Logo, Copyright. Einziger PHP-Code: `<?= date('Y') ?>` im Footer. |

Weitere Seiten gibt es nicht. Kein `.htaccess` im Ordner (Server antwortet auf `/cardgames/.htaccess` mit 403 – das ist die Standardsperre, nicht der Beweis einer Datei).

### Nicht referenzierte Dateien (aber öffentlich erreichbar – nicht löschen, alte Links möglich)

| Datei | Inhalt |
|---|---|
| `dkd107.exe`, `dkd108.exe`, `dkd109.exe` | Windows-Programme (PE32, UPX), je ~0,8 MB, HTTP 200 |
| `mcimp3wavextension.reg`, `mcimp3wavextension2.reg` | Registry-Tweaks MCI für MP3/WAV (HKLM) |
| `cover.jpg` (212×300), `dkd_top.jpg` (500×180), `logo_rm.jpg` (132×40), `kapsel4_trendpoker.jpg` (616×353) | Bilder ohne Verwendung |
| `img/up.gif`, `img/down.gif` (14×10) | Pfeil-Icons ohne Verwendung |

## 2. Technik

- Reines HTML in `.php`-Dateien, **keine Includes** (`include`/`require`/`virtual` kommen nicht vor), keine DB, keine Formulare.
- **Kein externes CSS/JS**, keine Libraries, keine Webfonts. Inline-`<style>` in `infos.php`, dazu viel Legacy-Markup (`<font>`, `align=`, `<table>` im Footer, Tippfehler `wdith=100%`).
- Ungültiges Markup: `<p><h2 …>…</h3></p>` (Zeile 65), `.textbox`-Klasse ohne CSS.
- **Charset-Konflikt:** Server sendet `Content-Type: text/html; charset=iso-8859-1`, `infos.php` deklariert `<meta charset="UTF-8">` und ist UTF-8 gespeichert. Der HTTP-Header gewinnt. Heute unsichtbar, weil alle Umlaute nur in CSS-Kommentaren stehen und © als Entity (`&#9400;`) kodiert ist. **Jeder sichtbare Nicht-ASCII-Text würde falsch dargestellt** → Abhilfe: `header('Content-Type: text/html; charset=utf-8');` in PHP oder HTML-Entities.
- Zeilenenden: PHP-Dateien sind auf dem Server bereits LF; `mcimp3wavextension2.reg` ist CRLF, `mcimp3wavextension.reg` LF. Das Repo ist byte-identisch zum Server (`.reg` als `-text`).

## 3. Pfade und Links bei Deployment in einen Unterordner `/26/`

**Alle internen Referenzen sind relativ** – nichts bricht in `bufopro.de/cardgames/26/`, solange alle Dateien mit hochgeladen werden.

| Datei:Zeile | Referenz | Art |
|---|---|---|
| `index.php:4` | `infos.php` | relativ |
| `infos.php:9` | `url(verlauf.jpg)` | relativ (CSS) |
| `infos.php:59` | `img.jpg` | relativ |
| `infos.php:72–107` | `kapsel4_*.jpg` (8×) | relativ |
| `infos.php:137` | `logo_bp.jpg` | relativ |

Keine root-relativen (`/…`) Pfade, keine absoluten URLs auf eigene Dateien.

## 4. Abhängigkeiten außerhalb von `cardgames/` bzw. auf andere Domains

**Eingebunden** (CSS, JS, Header, PHP-Includes, Bilder) wird **nichts** von außerhalb des Ordners – weder aus `bufopro.de/` noch von fremden Domains.

Nur Links (keine Einbindung):

| Ziel | Wo |
|---|---|
| `https://store.steampowered.com/app/…` (9×) | Kaufbuttons, s. Abschnitt 7 |
| `http://www.bufopro.de/` | Logo + Copyright-Link im Footer (http, nicht https) |
| `mailto:support@bufopro.de` | Footer |

Indirekte Server-Abhängigkeiten (liegen außerhalb des Repos):
- Charset-Default `iso-8859-1` (Plesk/Webserver-Konfiguration von bufopro.de).
- `https://bufopro.de/cardgames` → 301 auf `/cardgames/`. `http://` und `www.` liefern direkt 200 (kein Redirect auf https).
- `https://bufopro.de/robots.txt` → 404. Startseite `bufopro.de/` verlinkt nicht auf `/cardgames/`.

## 5. Anker (von Steam verlinkt)

**Im Quelltext existiert derzeit kein einziger Anker** (kein `id=`, kein `<a name=…>`; einziges `name=` ist der Viewport-Meta-Tag).
Zusätzlich ist `index.php` ein Frameset: Ein Fragment wie `/cardgames/#thirtyone` bezieht sich auf das Frameset-Dokument, nicht auf `infos.php` im Frame. Die Steam-Anker landen deshalb heute alle oben auf der Seite.

Von Steam tatsächlich verlinkte URLs (Store-Seiten, „Website“-Link, abgerufen 2026-11-12):

| Steam-App | Spiel | Verlinkte URL | Anker existiert? |
|---|---|---|---|
| 941920 | Classic Card Games 3D | `http://bufopro.de/cardgames/` | – |
| 1178520 | Hearts 3D Premium | `https://bufopro.de/cardgames/#hearts` | nein |
| 1029900 | Rummy 3D Premium | `http://bufopro.de/cardgames/#rummy` | nein |
| 966090 | Canasta 3D Premium | `https://bufopro.de/cardgames/#canasta` | nein |
| 1178510 | Gin Rummy 3D Premium | `http://bufopro.de/cardgames/#ginrummy` | nein |
| 1070770 | Skat 3D Premium | `http://bufopro.de/cardgames/#skat` | nein |
| 1178500 | Crazy Eights 3D Premium | `http://bufopro.de/cardgames/#crazyeights` | nein |
| 1178530 | Thirty-One 3D Premium | `http://bufopro.de/cardgames/#thirtyone` | nein |
| 662230 | Trendpoker 3D | `https://trendpoker.de/`, `https://trendpoker.de/stat/` | – (andere Domain) |

Achtung: Anker heißt `crazyeights`, Bilddatei aber `kapsel4_crazy8s.jpg`. Die Anker-IDs müssen exakt wie oben lauten, und sie müssen im **obersten Dokument** unter `/cardgames/` liegen (Frameset ablösen oder Hash an den Frame weiterreichen).

Andere Quellen (alte Foren-/Presse-Links, Spiele selbst) wurden nicht geprüft.

## 6. Mobile-Tauglichkeit

- `index.php` (Top-Level-Dokument) hat **keinen Viewport-Meta** → Mobilbrowser rendern in ~980 px Breite und zoomen heraus. Der Viewport in `infos.php` wirkt im Frame nicht auf das Layout der Seite.
- Frameset auf Mobilgeräten: schlechte Scroll-/Zoom-Erfahrung, Deep-Links und Anker funktionieren nicht.
- Feste Breiten: `.card img { width: 450px; height: 259px }` plus `width=450 height=259` – auf < 470 px horizontaler Überlauf. Titel `font-size: 64px` fest.
- Bildgrößen: Kacheln 616×353 (Hearts 825×473) werden auf 450×259 skaliert, leichte Verzerrung (Seitenverhältnis 1,745 vs. 1,737). Kein `srcset`, kein `loading="lazy"`. Gesamtgewicht der Kacheln ~1 MB, unkritisch.
- Header-Bild `img.jpg` 467×181 ohne CSS-Begrenzung (passt knapp).

## 7. SEO-Basics

| Punkt | Status |
|---|---|
| `<title>` | `index.php`: „Classic Card Games 3D“ ✓ · `infos.php`: **„Deine Webseite“** (Platzhalter; wird separat indexiert) |
| Meta-Description | fehlt (beide) |
| `lang` | `index.php` fehlt · `infos.php` `lang="de"`, Inhalt aber englisch |
| Überschriften | `h1` ✓, `h2` falsch mit `</h3>` geschlossen |
| `alt`-Texte | Kacheln ✓ · `img.jpg` und `logo_bp.jpg` ohne `alt` |
| Canonical, Open Graph, strukturierte Daten | fehlen |
| robots.txt / Sitemap | 404 (Domain-Root, außerhalb des Repos) |
| Frameset | Suchmaschinen sehen auf `/cardgames/` keinen Inhalt; `infos.php` erscheint als eigene URL |
| Inhalt | „Website under construction“, „News and info will appear soon“ |

## 8. Kaufbuttons

Alle Buttons sind Bild-Links mit `target="_blank"` direkt auf Steam (kein Tracking, kein `rel`).

| Zeile | Bild | alt | Ziel |
|---|---|---|---|
| `infos.php:58` | `img.jpg` | – | https://store.steampowered.com/app/941920/ (Classic Card Games 3D) |
| `infos.php:71` | `kapsel4_hearts.jpg` | Hearts | https://store.steampowered.com/app/1178520/ |
| `infos.php:76` | `kapsel4_rummy.jpg` | Rummy | https://store.steampowered.com/app/1029900/ |
| `infos.php:81` | `kapsel4_canasta.jpg` | Canasta | https://store.steampowered.com/app/966090/ |
| `infos.php:86` | `kapsel4_ginrummy.jpg` | Gin Rummy | https://store.steampowered.com/app/1178510/ |
| `infos.php:91` | `kapsel4_skat.jpg` | Skat | https://store.steampowered.com/app/1070770/ |
| `infos.php:96` | `kapsel4_crazy8s.jpg` | Crazy 8s | https://store.steampowered.com/app/1178500/ |
| `infos.php:101` | `kapsel4_thirtyone.jpg` | Thirty One | https://store.steampowered.com/app/1178530/ |
| `infos.php:106` | `kapsel4_tp3dce.jpg` | Trendpoker | https://store.steampowered.com/app/662230/ |

## 9. Sprachversionen

Nur eine Version, Inhalt **englisch** (trotz `lang="de"`). Keine Sprachumschaltung, kein `hreflang`.

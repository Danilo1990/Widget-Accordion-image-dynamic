# Accordion DC — Widget Elementor

Widget accordion custom per Elementor. Ogni item ha titolo, testo, immagine di sfondo e bottone con link — tutto gestibile dall'editor senza toccare codice.

## Requisiti

- WordPress 6.0+
- PHP 8.0+
- Elementor (free o Pro)

## Installazione

1. Carica la cartella del plugin in `/wp-content/plugins/`
2. Attiva il plugin da **Plugin → Plugin installati**
3. Il widget **Accordion DC** apparirà nella categoria **Custom** dell'editor Elementor

## File inclusi

```
accordion-dc/
├── accordion-dc.php          # file principale del plugin
├── widget-accordion-dc.php   # classe del widget Elementor
├── accordion-dc.css          # stili del widget
├── accordion-dc.js           # logica interattiva (jQuery)
└── README.md
```

## Utilizzo

1. Apri una pagina con Elementor
2. Cerca il widget **Accordion DC** nel pannello sinistro
3. Trascina il widget nella pagina
4. Aggiungi gli item dal tab **Content → Items**
5. Personalizza colori, tipografia e spaziature dal tab **Style**

## Note

- Il bottone è opzionale: se non compili il campo **Button Text** in un item, il bottone non appare per quell'item
- L'immagine di sfondo cambia dinamicamente al passaggio del mouse su ogni item (desktop) o al tap (mobile)

## Autore

Danilo Calabrese — [danilocalabrese.it](https://danilocalabrese.it)

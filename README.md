# Prism.js Supported Languages (Auto-Updated)

This repository provides an always up-to-date list of all languages supported by Prism.js v2.
The list is generated automatically every night using GitHub Actions and published as a structured JSON file.

## What This Repository Contains

The script fetches Prism.js’ official `components.json` file and extracts all languages, including:

- Primary language definitions
- Language titles
- Aliases and alias titles
- Sorted results for easier lookup

The final output is stored in:

```
prismjs-supported-languages.json
```

This file is intended for use in applications that need an authoritative, up-to-date list of Prism.js languages (for example: syntax highlighting pickers, IDE integrations, documentation tools, etc.).

## How It Works

### 1. Fetch language definitions from Prism.js

The PHP script downloads:

```
https://raw.githubusercontent.com/PrismJS/prism/refs/heads/v2/src/components.json
```

### 2. Parse + normalize

It extracts:

- `title`
- `language` (internal key)
- `aliasTitles`, if available

All entries are converted into a simple flat structure.

### 3. Sort + write JSON

The languages are alphabetically sorted by title and written to:

```
prismjs-supported-languages.json
```

### 4. Auto-updated daily

A GitHub Actions workflow runs every day at 02:00 UTC:

- Runs the PHP generator
- Detects changes
- Commits updated results automatically

This ensures the JSON file is always in sync with the latest Prism.js v2 languages.

## Output Example

```json
[
  {
    "title": "ABNF",
    "language": "abnf"
  },
  {
    "title": "ActionScript",
    "language": "actionscript"
  },
  {
    "title": "Ada",
    "language": "ada"
  }
]
```

## Files

| File                               | Description                                                    |
| ---------------------------------- | -------------------------------------------------------------- |
| `prismjs-supported-languages.php`  | Generator script that fetches and transforms the language list |
| `prismjs-supported-languages.json` | Final auto-generated output file                               |
| `.github/workflows/update.yml`     | Automation workflow that regenerates the file daily            |

## Why This Exists

Prism.js stores its language metadata in a format that’s useful internally, but not ideal for consuming applications.
This repository simplifies that data into a clean, predictable JSON file that can be integrated anywhere.

If you use Prism.js and need a dynamic language selector or dependency checker, this provides an easy solution.

## License

This repository only contains generated metadata.
Prism.js is licensed under the MIT License (see the Prism.js repository for details).

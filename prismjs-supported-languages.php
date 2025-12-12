<?php

$url = 'https://raw.githubusercontent.com/PrismJS/prism/refs/heads/v2/src/components.json';
$data = file_get_contents($url);

if ($data === false) {
  fwrite(STDERR, "Error: Failed to fetch data from Prism.js repository\n");
  exit(1);
}

$components = json_decode($data);

if ($components === null) {
  fwrite(STDERR, "Error: Failed to parse JSON data\n");
  exit(1);
}

$languages = [];

foreach ($components->languages as $langKey => $content) {
  if ($langKey === 'meta') {
    continue;
  }

  $languages[] = [
    'title' => $content->title ?? $langKey,
    'language' => $langKey
  ];

  if (isset($content->aliasTitles)) {
    foreach ((array) $content->aliasTitles as $aliasKey => $aliasTitle) {
      $languages[] = [
        'title' => $aliasTitle,
        'language' => $aliasKey
      ];
    }
  }
}

usort($languages, fn($a, $b) => strcmp($a['title'], $b['title']));

$json = json_encode($languages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

if (file_put_contents('prismjs-supported-languages.json', $json) === false) {
  fwrite(STDERR, "Error: Failed to write output file\n");
  exit(1);
}

echo "✓ Successfully generated prismjs-supported-languages.json with " . count($languages) . " entries\n";

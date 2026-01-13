<?php
/**
 * cps276_examples_exporter.php  (fixed GitHub links)
 *
 * Generates a Markdown index of CPS276 example projects by chapter,
 * with correct links:
 *  - GitHub directory: .../tree/main/chapterN
 *  - GitHub files:     .../blob/main/chapterN/path/to/file.ext
 * Streams a download: cps276_examples_index.md
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* =========================
   ========== CONFIG ========
   ========================= */

// Adjust this to where the examples live on disk
$localExamplesDir = realpath(__DIR__ . '/../cps276_examples');
if (!$localExamplesDir || !is_dir($localExamplesDir)) {
  $fallback = __DIR__ . '/cps276_examples';
  if (is_dir($fallback)) $localExamplesDir = realpath($fallback);
}

// Public base URLs
$liveBaseUrl     = 'https://russet-v8.wccnet.edu/~sshaper/cps276_examples/';
$ghDirBaseUrl    = 'https://github.com/sshaper/cps276_examples/tree/main/'; // for chapter directories
$ghFileBaseUrl   = 'https://github.com/sshaper/cps276_examples/blob/main/'; // for individual files

// Chapters to include
$chapters = range(1, 14);

// File types to show in per-chapter “Sample files”
$listExts = ['php','html','htm','css','js','md','json'];

/* =========================
   ====== HELPERS ==========
   ========================= */

function isHidden(string $name): bool {
  return strlen($name) && $name[0] === '.';
}

function findChapterDirs(string $baseDir): array {
  $map = [];
  if (!is_dir($baseDir)) return $map;
  $entries = scandir($baseDir);
  natcasesort($entries);
  foreach ($entries as $e) {
    if ($e === '.' || $e === '..' || isHidden($e)) continue;
    $full = $baseDir . DIRECTORY_SEPARATOR . $e;
    if (!is_dir($full)) continue;
    if (preg_match('/\bchap(?:ter)?\s*([0-9]{1,2})\b/i', $e, $m)) {
      $map[(int)$m[1]] = ['name'=>$e, 'path'=>$full];
    } elseif (preg_match('/^([0-9]{1,2})$/', $e, $m)) {
      $map[(int)$m[1]] = ['name'=>$e, 'path'=>$full];
    }
  }
  return $map;
}

function listFilesShort(string $dir, array $exts, int $limit = 15): array {
  if (!is_dir($dir)) return [];
  $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
    $dir,
    FilesystemIterator::SKIP_DOTS|FilesystemIterator::FOLLOW_SYMLINKS
  ));
  $out = [];
  foreach ($rii as $file) {
    if (!is_file($file)) continue;
    $name = $file->getFilename();
    if (isHidden($name)) continue;
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if ($exts && !in_array($ext, $exts, true)) continue;
    $out[] = substr($file->getPathname(), strlen($dir)+1);
    if (count($out) >= $limit) break;
  }
  natsort($out);
  return array_values($out);
}

/* =========================
   ===== RENDER MARKDOWN ===
   ========================= */

$chapterDirs = $localExamplesDir && is_dir($localExamplesDir) ? findChapterDirs($localExamplesDir) : [];

ob_start();

echo "# CPS276 Examples Index\n\n";
echo "_Generated automatically. Links point to live server and GitHub._\n\n";

echo "## Summary by Chapter\n\n";
echo "| Chapter | Live | GitHub | Status |\n";
echo "|--------:|:-----|:-------|:-------|\n";
foreach ($chapters as $n) {
  $status = "Not found";
  $live   = "—";
  $gh     = "—";
  if (isset($chapterDirs[$n])) {
    $dirName = $chapterDirs[$n]['name'];
    $status  = "Available";
    $live    = "[".$dirName."](".rtrim($liveBaseUrl,'/').'/'.rawurlencode($dirName)."/)";
    $gh      = "[".$dirName."](".rtrim($ghDirBaseUrl,'/').'/'.rawurlencode($dirName).")";
  }
  printf("| %d | %s | %s | %s |\n", $n, $live, $gh, $status);
}

echo "\n---\n\n";
echo "## Details by Chapter\n\n";

foreach ($chapters as $n) {
  echo "### Chapter {$n}\n\n";
  if (!isset($chapterDirs[$n])) {
    echo "_No examples available for this chapter._\n\n";
    continue;
  }
  $dirName = $chapterDirs[$n]['name'];
  $absPath = $chapterDirs[$n]['path'];

  $liveDir = rtrim($liveBaseUrl,'/').'/'.rawurlencode($dirName).'/';
  $ghDir   = rtrim($ghDirBaseUrl,'/').'/'.rawurlencode($dirName);

  echo "- **Live directory:** {$liveDir}\n";
  echo "- **GitHub directory:** {$ghDir}\n\n";

  $files = listFilesShort($absPath, $listExts, 15);
  if ($files) {
    echo "**Sample files (first 15):**\n\n";
    foreach ($files as $rel) {
      // Encode each path segment for URLs, keep slashes
      $parts   = array_map('rawurlencode', explode('/', $rel));
      $relEnc  = implode('/', $parts);

      $liveFile = $liveDir . $relEnc;
      // IMPORTANT: Use blob/main for files
      $ghFile   = rtrim($ghFileBaseUrl,'/').'/'.rawurlencode($dirName).'/'.$relEnc;

      echo "- `{$rel}` — [Live]({$liveFile}) | [GitHub]({$ghFile})\n";
    }
    echo "\n";
  } else {
    echo "_No matching files found to list (php/html/css/js/md/json)._ \n\n";
  }
}

$md = ob_get_clean();

/* =========================
   ==== STREAM DOWNLOAD ====
   ========================= */

$filename = 'cps276_examples_index.md';
header('Content-Type: text/markdown; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Length: '.strlen($md));
echo $md;

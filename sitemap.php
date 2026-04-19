<?php
require_once 'config.php';
require_once 'db.php';
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc><?= SITE_URL ?>/</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
<?php
$pages = db_query('SELECT slug, title FROM pages');
foreach ($pages as $p) {
    echo "  <url><loc>" . SITE_URL . "/page/" . htmlspecialchars($p['slug']) . "</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>\n";
}
$news = db_query('SELECT slug FROM news ORDER BY published_at DESC');
foreach ($news as $n) {
    echo "  <url><loc>" . SITE_URL . "/news/" . htmlspecialchars($n['slug']) . "</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>\n";
}
?>
</urlset>

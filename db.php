<?php
function get_db() {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $pdo;
}
function db_query($sql, $params = []) {
    $stmt = get_db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}
function db_exec($sql, $params = []) {
    $stmt = get_db()->prepare($sql);
    return $stmt->execute($params);
}
function db_single($sql, $params = []) {
    $stmt = get_db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}
function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function csrf_check() {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) die('CSRF error');
}

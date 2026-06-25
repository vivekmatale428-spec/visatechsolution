<?php
require_once __DIR__ . '/../config/database.php';

function sanitize(string $input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function basePath(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }

    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    if (preg_match('#/(client|admin)(/|$)#', $scriptDir)) {
        $scriptDir = dirname($scriptDir);
    }

    $base = rtrim($scriptDir, '/') . '/';
    if ($base === '/') {
        $base = '';
    }

    return $base;
}

function url(string $path = ''): string
{
    return basePath() . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

/* ---- Admin Auth ---- */
function isAdminLoggedIn(): bool
{
    return isset($_SESSION['admin_id']);
}

function requireAdminLogin(): void
{
    if (!isAdminLoggedIn()) {
        redirect('index.php');
    }
}

function isLoggedIn(): bool
{
    return isAdminLoggedIn();
}

function requireLogin(): void
{
    requireAdminLogin();
}

/* ---- Client Auth ---- */
function isClientLoggedIn(): bool
{
    return isset($_SESSION['client_id']);
}

function requireClientLogin(): void
{
    if (!isClientLoggedIn()) {
        redirect(url('client/login.php'));
    }
}

/* ---- Data Fetchers ---- */
function getTestimonials(int $limit = 0): array
{
    try {
        $db = getDB();
        $sql = 'SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC';
        if ($limit > 0) $sql .= ' LIMIT ' . (int) $limit;
        return $db->query($sql)->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getProjects(int $limit = 0): array
{
    try {
        $db = getDB();
        $sql = 'SELECT * FROM projects WHERE is_active = 1 ORDER BY created_at DESC';
        if ($limit > 0) $sql .= ' LIMIT ' . (int) $limit;
        return $db->query($sql)->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getPortfolioProjects(int $limit = 0): array
{
    return getProjects($limit);
}

function getFounders(): array
{
    try {
        $db = getDB();
        return $db->query('SELECT * FROM founders WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getTeamMembers(): array
{
    return getFounders();
}

function getServicesFromDB(): array
{
    try {
        $db = getDB();
        return $db->query('SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getTechnologiesFromDB(): array
{
    try {
        $db = getDB();
        $rows = $db->query('SELECT * FROM technologies WHERE is_active = 1 ORDER BY category, sort_order')->fetchAll();
        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['category']][] = $row['name'];
        }
        return $grouped;
    } catch (PDOException $e) {
        return [];
    }
}

function getBlogPosts(int $limit = 0): array
{
    try {
        $db = getDB();
        $sql = 'SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_at DESC';
        if ($limit > 0) $sql .= ' LIMIT ' . (int) $limit;
        return $db->query($sql)->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getBlogPost(string $slug): ?array
{
    try {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM blog_posts WHERE slug = :slug AND is_published = 1 LIMIT 1');
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch() ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function getCareers(): array
{
    try {
        $db = getDB();
        return $db->query('SELECT * FROM careers WHERE is_active = 1 ORDER BY created_at DESC')->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getUnreadMessagesCount(): int
{
    try {
        $db = getDB();
        return (int) $db->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn();
    } catch (PDOException $e) {
        return 0;
    }
}

function getUnreadInquiriesCount(): int
{
    return getUnreadMessagesCount();
}

function getClientProjects(int $clientId): array
{
    try {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM project_tracking WHERE client_id = :id ORDER BY updated_at DESC');
        $stmt->execute([':id' => $clientId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function getProjectProgress(string $status): int
{
    $statuses = PROJECT_STATUSES;
    $index = array_search($status, $statuses);
    if ($index === false) return 0;
    return (int) round((($index + 1) / count($statuses)) * 100);
}

function renderStars(int $rating): string
{
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= $rating
            ? '<i class="bi bi-star-fill text-warning"></i>'
            : '<i class="bi bi-star text-muted"></i>';
    }
    return $html;
}

function renderProgressBar(string $status): string
{
    $progress = getProjectProgress($status);
    return '<div class="progress-track"><div class="progress-fill" style="width:' . $progress . '%"></div></div>
            <small class="text-muted">' . sanitize($status) . ' — ' . $progress . '%</small>';
}

function uploadFile(array $file, string $subdir, array $allowed = ['pdf','doc','docx']): ?string
{
    if ($file['error'] !== UPLOAD_ERR_OK) return null;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;

    $dir = UPLOAD_PATH . $subdir . '/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    if (move_uploaded_file($file['tmp_name'], $dir . $filename)) {
        return $subdir . '/' . $filename;
    }
    return null;
}

/* ---- Static Fallbacks ---- */
function getServices(): array
{
    $db = getServicesFromDB();
    if (!empty($db)) {
        return array_map(fn($s) => [
            'icon' => $s['icon'],
            'title' => $s['title'],
            'description' => $s['description'],
        ], $db);
    }
    return [
        ['icon' => 'bi-layers', 'title' => 'Full Stack Development', 'description' => 'Complete frontend and backend solutions.'],
        ['icon' => 'bi-stack', 'title' => 'MERN Stack Development', 'description' => 'MongoDB, Express, React, Node.js solutions.'],
        ['icon' => 'bi-cup-hot', 'title' => 'Java Development', 'description' => 'Scalable enterprise Java applications.'],
        ['icon' => 'bi-filetype-py', 'title' => 'Python Development', 'description' => 'APIs, automation, and backend systems.'],
        ['icon' => 'bi-microsoft', 'title' => '.NET Development', 'description' => 'ASP.NET Core enterprise applications.'],
        ['icon' => 'bi-palette', 'title' => 'UI/UX Design', 'description' => 'Modern user-friendly interface design.'],
        ['icon' => 'bi-globe', 'title' => 'Website Development', 'description' => 'Responsive professional websites.'],
        ['icon' => 'bi-plug', 'title' => 'API Development', 'description' => 'RESTful API design and integration.'],
        ['icon' => 'bi-database', 'title' => 'Database Design', 'description' => 'Architecture and optimization.'],
        ['icon' => 'bi-headset', 'title' => 'Software Maintenance', 'description' => 'Ongoing support and monitoring.'],
    ];
}

function getTechnologies(): array
{
    $db = getTechnologiesFromDB();
    if (!empty($db)) return $db;
    return [
        'Frontend' => ['HTML', 'CSS', 'JavaScript', 'Bootstrap', 'React'],
        'Backend' => ['PHP', 'Node.js', 'Java'],
        'Programming' => ['Python', 'Java', 'C#'],
        'Database' => ['MySQL', 'SQL Server'],
        'Tools' => ['GitHub', 'VS Code', 'Postman'],
    ];
}

function getWhyChooseUs(): array
{
    return [
        ['icon' => 'bi-people', 'title' => 'Experienced Development Team'],
        ['icon' => 'bi-cpu', 'title' => 'Modern Technology Stack'],
        ['icon' => 'bi-graph-up-arrow', 'title' => 'Scalable Solutions'],
        ['icon' => 'bi-shield-check', 'title' => 'Clean & Secure Code'],
        ['icon' => 'bi-currency-dollar', 'title' => 'Affordable Pricing'],
        ['icon' => 'bi-chat-dots', 'title' => 'Transparent Communication'],
        ['icon' => 'bi-clock', 'title' => 'On-Time Delivery'],
        ['icon' => 'bi-life-preserver', 'title' => 'Long-Term Support'],
    ];
}

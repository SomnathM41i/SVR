<?php
require_once('includes/bootstrap.php');
include_once('memprotect.php');
require_once('includes/partner_match.php');

mysqli_set_charset($con, 'utf8mb4');

function horoscopeEscape($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function fetchSingleColumn(mysqli $connection, string $query, string $column): array
{
    $values = [];
    $result = mysqli_query($connection, $query);

    if (!$result) {
        return $values;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $values[] = $row[$column];
    }

    return $values;
}

function bindHoroscopeSearchParameters(
    mysqli_stmt $statement,
    string $types,
    array &$parameters
): void {
    $references = [];

    foreach ($parameters as &$parameter) {
        $references[] = &$parameter;
    }

    mysqli_stmt_bind_param($statement, $types, ...$references);
}

$loginId = $_SESSION['MatriID'] ?? $_SESSION['matriid'] ?? '';

$viewerStatement = mysqli_prepare(
    $con,
    'SELECT * FROM register WHERE MatriID = ? LIMIT 1'
);
mysqli_stmt_bind_param($viewerStatement, 's', $loginId);
mysqli_stmt_execute($viewerStatement);
$viewer = mysqli_fetch_assoc(mysqli_stmt_get_result($viewerStatement)) ?: [];
mysqli_stmt_close($viewerStatement);

$rashiOptions = fetchSingleColumn(
    $con,
    "SELECT Moon_Sign
     FROM moon_sign
     WHERE status = 'enable'
       AND Moon_Sign <> 'Does not matter'
     ORDER BY ID",
    'Moon_Sign'
);

$nadiOptions = ['Aadi', 'Madhya', 'Antya'];

$mangalOptions = fetchSingleColumn(
    $con,
    "SELECT type
     FROM manglik
     WHERE type <> ''
       AND type <> 'Does not matter'
     ORDER BY id",
    'type'
);

$selectedRashi = trim((string)($_GET['rashi'] ?? ''));
$selectedNadi = trim((string)($_GET['nadi'] ?? ''));
$selectedMangal = trim((string)($_GET['mangal'] ?? ''));
$devakInput = trim((string)($_GET['devak'] ?? ''));
$selectedDevak = function_exists('mb_substr')
    ? mb_substr($devakInput, 0, 100, 'UTF-8')
    : substr($devakInput, 0, 100);

if (!in_array($selectedRashi, $rashiOptions, true)) {
    $selectedRashi = '';
}

if (!in_array($selectedNadi, $nadiOptions, true)) {
    $selectedNadi = '';
}

if (!in_array($selectedMangal, $mangalOptions, true)) {
    $selectedMangal = '';
}

$searchSubmitted = isset(
    $_GET['rashi'],
    $_GET['nadi'],
    $_GET['devak'],
    $_GET['mangal']
);

$hasSearchCriteria =
    $selectedRashi !== ''
    || $selectedNadi !== ''
    || $selectedDevak !== ''
    || $selectedMangal !== '';

$currentPage = max(1, (int)($_GET['page'] ?? 1));
$profilesPerPage = 12;
$totalProfiles = 0;
$totalPages = 1;
$profiles = [];

if ($hasSearchCriteria) {
    $oppositeGender = ($viewer['Gender'] ?? '') === 'Male' ? 'Female' : 'Male';
    $devakPattern = '%' . $selectedDevak . '%';
    $filterClauses = [
        'r.MatriID <> ?',
        'r.Gender = ?'
    ];
    $filterParameters = [$loginId, $oppositeGender];

    if ($selectedRashi !== '') {
        $filterClauses[] = 'r.Moonsign = ?';
        $filterParameters[] = $selectedRashi;
    }

    if ($selectedNadi !== '') {
        $filterClauses[] = 'r.nadi = ?';
        $filterParameters[] = $selectedNadi;
    }

    if ($selectedDevak !== '') {
        $filterClauses[] = 'r.devak LIKE ?';
        $filterParameters[] = $devakPattern;
    }

    if ($selectedMangal !== '') {
        $filterClauses[] = 'r.Manglik = ?';
        $filterParameters[] = $selectedMangal;
    }

    $filterClauses[] = "r.visibility <> 'hidden'";
    $filterClauses[] = "r.Status NOT IN ('Banned', 'InActive')";
    $filterClauses[] = "NOT EXISTS (
        SELECT 1
        FROM block_member b
        WHERE (
            BINARY b.matriid = BINARY ?
            AND BINARY b.profile_id = BINARY r.MatriID
        )
        OR (
            BINARY b.profile_id = BINARY ?
            AND BINARY b.matriid = BINARY r.MatriID
        )
    )";
    $filterParameters[] = $loginId;
    $filterParameters[] = $loginId;
    $profileFilters = implode("\nAND ", $filterClauses);

    $countStatement = mysqli_prepare(
        $con,
        "SELECT COUNT(*) AS total
         FROM register r
         WHERE $profileFilters"
    );

    $countParameterTypes = str_repeat('s', count($filterParameters));
    bindHoroscopeSearchParameters(
        $countStatement,
        $countParameterTypes,
        $filterParameters
    );

    mysqli_stmt_execute($countStatement);
    $countResult = mysqli_fetch_assoc(mysqli_stmt_get_result($countStatement));
    $totalProfiles = (int)($countResult['total'] ?? 0);
    mysqli_stmt_close($countStatement);

    $totalPages = max(1, (int)ceil($totalProfiles / $profilesPerPage));
    $currentPage = min($currentPage, $totalPages);
    $offset = ($currentPage - 1) * $profilesPerPage;

    $profileStatement = mysqli_prepare(
        $con,
        "SELECT r.*
         FROM register r
         WHERE $profileFilters
         ORDER BY r.Regdate DESC
         LIMIT ? OFFSET ?"
    );

    $profileParameters = $filterParameters;
    $profileParameters[] = $profilesPerPage;
    $profileParameters[] = $offset;
    bindHoroscopeSearchParameters(
        $profileStatement,
        $countParameterTypes . 'ii',
        $profileParameters
    );

    mysqli_stmt_execute($profileStatement);
    $profileResult = mysqli_stmt_get_result($profileStatement);

    while ($profile = mysqli_fetch_assoc($profileResult)) {
        $profiles[] = $profile;
    }

    mysqli_stmt_close($profileStatement);
}

$activeFilters = [];

if ($selectedRashi !== '') {
    $activeFilters[] = 'Rashi: ' . $selectedRashi;
}

if ($selectedNadi !== '') {
    $activeFilters[] = 'Nadi: ' . $selectedNadi;
}

if ($selectedDevak !== '') {
    $activeFilters[] = 'Devak: ' . $selectedDevak;
}

if ($selectedMangal !== '') {
    $activeFilters[] = 'Mangal: ' . $selectedMangal;
}

$paginationFilters = [
    'rashi' => $selectedRashi,
    'nadi' => $selectedNadi,
    'devak' => $selectedDevak,
    'mangal' => $selectedMangal
];

$heightLabels = [
    1 => '4Ft',
    2 => '4Ft 1 inch',
    3 => '4Ft 2 inch',
    4 => '4Ft 3 inch',
    5 => '4Ft 4 inch',
    6 => '4Ft 5 inch',
    7 => '4Ft 6 inch',
    8 => '4Ft 7 inch',
    9 => '4Ft 8 inch',
    10 => '4Ft 9 inch',
    11 => '4Ft 10 inch',
    12 => '4Ft 11 inch',
    13 => '5Ft',
    14 => '5Ft 1 inch',
    15 => '5Ft 2 inch',
    16 => '5Ft 3 inch',
    17 => '5Ft 4 inch',
    18 => '5Ft 5 inch',
    19 => '5Ft 6 inch',
    20 => '5Ft 7 inch',
    21 => '5Ft 8 inch',
    22 => '5Ft 9 inch',
    23 => '5Ft 10 inch',
    24 => '5Ft 11 inch',
    25 => '6Ft',
    26 => '6Ft 1 inch',
    27 => '6Ft 2 inch',
    28 => '6Ft 3 inch',
    29 => '6Ft 4 inch',
    30 => '6Ft 5 inch',
    31 => '6Ft 6 inch',
    32 => '6Ft 7 inch',
    33 => '6Ft 8 inch',
    34 => '6Ft 9 inch',
    35 => '6Ft 10 inch',
    36 => '6Ft 11 inch',
    37 => '7Ft'
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horoscope Search - Manpasand Jodidar</title>
    <link rel="icon" href="branding/favicons/favicon.ico">
    <link rel="stylesheet" href="css3/Style.css">
    <link rel="stylesheet" href="css3/mvv-premium.css">
    <style>
        .horoscope-search-card {
            position: relative;
            z-index: 4;
            max-width: 980px;
            margin: -36px auto 42px;
            padding: 24px;
            border: 1px solid var(--mvv-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 14px 35px rgba(58, 42, 34, 0.1);
        }

        .horoscope-search-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            align-items: end;
        }

        .horoscope-search-form label {
            display: block;
            margin-bottom: 7px;
            color: var(--mvv-maroon);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .horoscope-search-form select,
        .horoscope-search-form input {
            width: 100%;
            min-height: 48px;
            padding: 10px 13px;
            border: 1px solid var(--mvv-border);
            border-radius: 5px;
            background: #fff;
        }

        .horoscope-search-form select:focus,
        .horoscope-search-form input:focus {
            border-color: var(--mvv-saffron);
            outline: 2px solid rgba(230, 91, 35, 0.12);
        }

        .horoscope-search-action {
            display: flex;
            grid-column: 1 / -1;
            justify-content: flex-end;
        }

        .horoscope-result-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .horoscope-result-heading h2 {
            margin: 0;
            color: var(--mvv-maroon);
            font-size: 1.35rem;
        }

        .horoscope-result-heading span {
            color: var(--mvv-muted);
            font-size: 0.88rem;
        }

        .horoscope-profile-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .horoscope-profile-card {
            overflow: hidden;
            border: 1px solid var(--mvv-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(58, 42, 34, 0.06);
        }

        .horoscope-profile-photo {
            width: 100%;
            height: 260px;
            object-fit: cover;
            background: #eee;
        }

        .horoscope-profile-body {
            padding: 16px;
        }

        .horoscope-detail-tag {
            display: inline-flex;
            margin: 0 4px 8px 0;
            padding: 5px 9px;
            border-radius: 999px;
            background: #f3eaff;
            color: #5c337c;
            font-size: 0.75rem;
            font-weight: 800;
        }

        .preference-tag {
            display: inline-flex;
            margin: 0 0 9px;
            padding: 5px 9px;
            border-radius: 999px;
            background: #fff0e0;
            color: var(--mvv-maroon);
            font-size: 0.73rem;
            font-weight: 800;
        }

        .horoscope-profile-body h3 {
            margin: 0 0 7px;
            font-size: 1.05rem;
        }

        .horoscope-profile-body h3 a {
            color: var(--mvv-maroon);
            text-decoration: none;
        }

        .horoscope-profile-meta {
            color: var(--mvv-muted);
            font-size: 0.84rem;
            line-height: 1.55;
        }

        .horoscope-empty-result {
            padding: 45px 24px;
            border: 1px solid var(--mvv-border);
            border-radius: 12px;
            background: #fff;
            text-align: center;
        }

        .horoscope-empty-result h2 {
            color: var(--mvv-maroon);
        }

        .horoscope-pagination {
            display: flex;
            justify-content: center;
            gap: 7px;
            margin-top: 28px;
        }

        .horoscope-pagination a {
            padding: 8px 12px;
            border: 1px solid var(--mvv-border);
            border-radius: 7px;
            color: var(--mvv-maroon);
            text-decoration: none;
        }

        .horoscope-pagination a.active {
            background: var(--mvv-maroon);
            color: #fff;
        }

        @media (max-width: 1000px) {
            .horoscope-profile-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .horoscope-search-form,
            .horoscope-profile-grid {
                grid-template-columns: 1fr;
            }

            .horoscope-search-action {
                grid-column: auto;
            }

            .horoscope-search-form button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .horoscope-profile-photo {
                height: 300px;
            }

            .horoscope-result-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page">
    <section class="mvv-page-hero">
        <div class="mvv-container">
            <div class="mvv-eyebrow">Profile Discovery</div>
            <h1>Horoscope Search</h1>
            <p>Find profiles by Rashi, Nadi, Devak, and Mangal.</p>
            <nav class="mvv-breadcrumb" aria-label="Breadcrumb">
                <a href="index_dashboard">Dashboard</a>
                <span>Horoscope Search</span>
            </nav>
        </div>
    </section>

    <section class="mvv-section">
        <div class="mvv-container">
            <div class="horoscope-search-card">
                <form class="horoscope-search-form" method="get" action="rashi_search">
                    <div>
                        <label for="rashi">Search by Rashi</label>
                        <select name="rashi" id="rashi">
                            <option value="">Any Rashi</option>
                            <?php foreach ($rashiOptions as $rashiOption) { ?>
                                <option
                                    value="<?php echo horoscopeEscape($rashiOption); ?>"
                                    <?php echo $selectedRashi === $rashiOption ? 'selected' : ''; ?>
                                >
                                    <?php echo horoscopeEscape($rashiOption); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="nadi">Search by Nadi</label>
                        <select name="nadi" id="nadi">
                            <option value="">Any Nadi</option>
                            <?php foreach ($nadiOptions as $nadiOption) { ?>
                                <option
                                    value="<?php echo horoscopeEscape($nadiOption); ?>"
                                    <?php echo $selectedNadi === $nadiOption ? 'selected' : ''; ?>
                                >
                                    <?php echo horoscopeEscape($nadiOption); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="devak">Search by Devak</label>
                        <input
                            type="text"
                            name="devak"
                            id="devak"
                            maxlength="100"
                            placeholder="Enter Devak"
                            value="<?php echo horoscopeEscape($selectedDevak); ?>"
                        >
                    </div>

                    <div>
                        <label for="mangal">Search by Mangal</label>
                        <select name="mangal" id="mangal">
                            <option value="">Any Mangal</option>
                            <?php foreach ($mangalOptions as $mangalOption) { ?>
                                <option
                                    value="<?php echo horoscopeEscape($mangalOption); ?>"
                                    <?php echo $selectedMangal === $mangalOption ? 'selected' : ''; ?>
                                >
                                    <?php echo horoscopeEscape($mangalOption); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="horoscope-search-action">
                        <button class="mvv-btn mvv-btn-primary" type="submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            Search Profiles
                        </button>
                    </div>
                </form>
            </div>

            <?php if (!$hasSearchCriteria) { ?>
                <div class="horoscope-empty-result">
                    <h2>
                        <?php echo $searchSubmitted
                            ? 'Select at least one horoscope filter'
                            : 'Start Your Horoscope Search'; ?>
                    </h2>
                    <p>Choose a Rashi, Nadi, Devak, or Mangal option to find matching profiles.</p>
                </div>
            <?php } elseif (!$profiles) { ?>
                <div class="horoscope-empty-result">
                    <h2>No profiles found</h2>
                    <p>No visible profiles currently match the selected horoscope details.</p>
                </div>
            <?php } else { ?>
                <div class="horoscope-result-heading">
                    <h2>Horoscope Search Results</h2>
                    <span>
                        <?php echo $totalProfiles; ?>
                        profile<?php echo $totalProfiles === 1 ? '' : 's'; ?> found
                        &middot;
                        <?php echo horoscopeEscape(implode(' · ', $activeFilters)); ?>
                    </span>
                </div>

                <div class="horoscope-profile-grid">
                    <?php foreach ($profiles as $profile) {
                        $encodedProfileId = urlencode(base64_encode($profile['MatriID']));
                        $matchScore = partner_match_score($viewer, $profile);
                        $profilePhoto = 'images/nophoto.jpg';
                        $photoVisibility = $profile['photo_visibility'] ?? '';
                        $hasApprovedPhoto =
                            ($profile['Photo1Approve'] ?? '') === 'Yes'
                            && !empty($profile['Photo1'])
                            && $profile['Photo1'] !== 'nophoto.jpg';
                        $canViewPhoto =
                            $photoVisibility === 'allphoto'
                            || (
                                $photoVisibility === 'paidphoto'
                                && ($viewer['Status'] ?? '') === 'Paid'
                            );

                        if ($hasApprovedPhoto && $canViewPhoto) {
                            $profilePhoto =
                                'photoprocess.php?image=gallary/'
                                . $profile['Photo1']
                                . '&square=500';
                        }

                        $profileLocation = trim(
                            ($profile['City'] ?? '')
                            . ', '
                            . ($profile['Taluka'] ?? '')
                            . ', '
                            . ($profile['Dist'] ?? ''),
                            ', '
                        );
                        ?>
                        <article class="horoscope-profile-card">
                            <a
                                href="full_profile?id=<?php echo $encodedProfileId; ?>"
                                target="_blank"
                            >
                                <img
                                    class="horoscope-profile-photo"
                                    src="<?php echo horoscopeEscape($profilePhoto); ?>"
                                    alt="Profile photo"
                                    loading="lazy"
                                    onerror="this.src='images/nophoto.jpg'"
                                >
                            </a>

                            <div class="horoscope-profile-body">
                                <?php if (!empty($profile['Moonsign'])) { ?>
                                    <span class="horoscope-detail-tag">
                                        <i class="fas fa-moon" aria-hidden="true"></i>
                                        <?php echo horoscopeEscape($profile['Moonsign']); ?>
                                    </span>
                                <?php } ?>

                                <?php if (!empty($profile['nadi'])) { ?>
                                    <span class="horoscope-detail-tag">
                                        Nadi: <?php echo horoscopeEscape($profile['nadi']); ?>
                                    </span>
                                <?php } ?>

                                <?php if (!empty($profile['Manglik'])) { ?>
                                    <span class="horoscope-detail-tag">
                                        Mangal: <?php echo horoscopeEscape($profile['Manglik']); ?>
                                    </span>
                                <?php } ?>

                                <br>

                                <span class="preference-tag">
                                    <?php echo partner_match_badge($matchScore); ?>
                                </span>

                                <h3>
                                    <a
                                        href="full_profile?id=<?php echo $encodedProfileId; ?>"
                                        target="_blank"
                                    >
                                        <?php echo horoscopeEscape($profile['MatriID']); ?>
                                    </a>
                                </h3>

                                <div class="horoscope-profile-meta">
                                    <?php echo horoscopeEscape(
                                        $profile['Education'] ?: 'Education not specified'
                                    ); ?>
                                    <br>
                                    <?php echo horoscopeEscape(
                                        $profile['Occupation'] ?: 'Occupation not specified'
                                    ); ?>
                                    <br>
                                    <?php echo (int)$profile['Age']; ?> years,
                                    <?php echo horoscopeEscape(
                                        $heightLabels[$profile['Height']] ?? ''
                                    ); ?>
                                    <br>
                                    <?php echo horoscopeEscape($profileLocation); ?>

                                    <?php if (!empty($profile['devak'])) { ?>
                                        <br>
                                        Devak: <?php echo horoscopeEscape($profile['devak']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                </div>

                <?php if ($totalPages > 1) { ?>
                    <nav class="horoscope-pagination" aria-label="Search result pages">
                        <?php for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
                            $paginationFilters['page'] = $pageNumber;
                            $paginationUrl = 'rashi_search?' . http_build_query($paginationFilters);
                            ?>
                            <a
                                class="<?php echo $pageNumber === $currentPage ? 'active' : ''; ?>"
                                href="<?php echo horoscopeEscape($paginationUrl); ?>"
                            >
                                <?php echo $pageNumber; ?>
                            </a>
                        <?php } ?>
                    </nav>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
</main>

<?php include('footer3.php'); ?>
</body>
</html>

<?php
require_once(__DIR__ . '/annual_income.php');

function partner_match_values($value)
{
    $parts = preg_split('/\s*,\s*|\s+,+\s+/', trim((string)$value), -1, PREG_SPLIT_NO_EMPTY);
    return array_values(array_filter(array_map('trim', $parts), function ($item) {
        return $item !== '' && strcasecmp($item, 'Any') !== 0;
    }));
}

function partner_match_overlap($preference, $candidateValue)
{
    $wanted = partner_match_values($preference);
    $actual = partner_match_values($candidateValue);
    if (!$wanted || !$actual) return false;
    $wanted = array_map('mb_strtolower', $wanted);
    $actual = array_map('mb_strtolower', $actual);
    return (bool)array_intersect($wanted, $actual);
}

function partner_match_range($value, $from, $to)
{
    $value = annual_income_normalize_value($value);
    $from = annual_income_normalize_value($from);
    $to = annual_income_normalize_value($to);
    if ($from === '' || $to === '' || !is_numeric($value) || !is_numeric($from) || !is_numeric($to)) return false;
    return (float)$value >= (float)$from && (float)$value <= (float)$to;
}

function partner_match_score(array $viewer, array $candidate)
{
    $locationParts = [
        ['preference' => 'PE_Countrylivingin', 'candidate' => 'Country'],
        ['preference' => 'PE_State', 'candidate' => 'State'],
        ['preference' => 'PE_District', 'candidate' => 'Dist'],
        ['preference' => 'PE_Taluka', 'candidate' => 'Taluka'],
        ['preference' => 'PE_City', 'candidate' => 'City']
    ];
    $locationConfigured = false;
    $locationMatched = true;
    foreach ($locationParts as $part) {
        $preference = $viewer[$part['preference']] ?? '';
        if (partner_match_values($preference)) {
            $locationConfigured = true;
            if (!partner_match_overlap($preference, $candidate[$part['candidate']] ?? '')) $locationMatched = false;
        }
    }
    $locationMatched = $locationConfigured && $locationMatched;

    $points = [
        'Marital Status' => partner_match_overlap($viewer['Looking'] ?? '', $candidate['Maritalstatus'] ?? ''),
        'Age' => partner_match_range($candidate['Age'] ?? '', $viewer['PE_FromAge'] ?? '', $viewer['PE_ToAge'] ?? ''),
        'Height' => partner_match_range($candidate['Height'] ?? '', $viewer['PE_from_Height'] ?? '', $viewer['PE_to_Height'] ?? ''),
        'Religion' => partner_match_overlap($viewer['PE_Religion'] ?? '', $candidate['Religion'] ?? ''),
        'Caste' => partner_match_overlap($viewer['PE_Caste'] ?? '', $candidate['Caste'] ?? ''),
        'Complexion' => partner_match_overlap($viewer['PE_Complexion'] ?? '', $candidate['Complexion'] ?? ''),
        'Education' => partner_match_overlap($viewer['PE_Education'] ?? '', $candidate['Education'] ?? ''),
        'Occupation' => partner_match_overlap($viewer['PE_Occupation'] ?? '', $candidate['Occupation'] ?? ''),
        'Location' => $locationMatched,
        'Annual Income' => partner_match_range($candidate['Annualincome'] ?? '', $viewer['PE_income_from'] ?? '', $viewer['PE_income_to'] ?? '')
    ];

    $matched = count(array_filter($points));
    return [
        'matched' => $matched,
        'total' => 10,
        'percentage' => $matched * 10,
        'is_100' => $matched === 10,
        'label' => $matched === 10 ? '100% Partner Match' : ($matched >= 8 ? 'Strong Match' : ($matched >= 6 ? 'Good Match' : ($matched * 10).'% Match')),
        'points' => $points
    ];
}

function partner_match_badge(array $score)
{
    return (int)$score['percentage'].'% Preferences Match';
}

function partner_match_is_child_accepted(array $viewer, array $candidate)
{
    if (($candidate['Maritalstatus'] ?? '') !== 'Divorced') return true;
    $children = json_decode((string)($candidate['children_details'] ?? ''), true);
    $reportedChildren = trim((string)($candidate['PE_HaveChildren'] ?? ''));
    $hasChildren = is_array($children) && count($children) > 0;
    if (!$hasChildren && !in_array(strtolower($reportedChildren), ['', 'none', '0', 'no'], true)) {
        $hasChildren = true;
    }
    if (!$hasChildren) return true;

    $acceptance = $viewer['child_acceptance'] ?? '';
    if ($acceptance === 'Do Not Accept Children') return false;
    if ($acceptance === '' || $acceptance === 'Both Boy and Girl Child') return true;
    if (!is_array($children)) return true;
    $acceptedGender = $acceptance === 'Boy Child' ? 'Male' : ($acceptance === 'Girl Child' ? 'Female' : '');
    if ($acceptedGender === '') return true;
    foreach ($children as $child) if (($child['gender'] ?? '') !== $acceptedGender) return false;
    return true;
}

function partner_match_count_100(mysqli $con, array $viewer)
{
    $viewerId = mysqli_real_escape_string($con, (string)($viewer['MatriID'] ?? ''));
    $gender = ($viewer['Gender'] ?? '') === 'Male' ? 'Female' : 'Male';
    $gender = mysqli_real_escape_string($con, $gender);
    $result = mysqli_query($con, "SELECT r.* FROM register r WHERE r.MatriID<>'$viewerId' AND r.Gender='$gender' AND r.visibility<>'hidden' AND r.Status NOT IN('Banned','InActive') AND NOT EXISTS (SELECT 1 FROM block_member b WHERE (b.matriid='$viewerId' AND b.profile_id=r.MatriID) OR (b.profile_id='$viewerId' AND b.matriid=r.MatriID))");
    $count = 0;
    if ($result) while ($candidate = mysqli_fetch_assoc($result)) {
        if (partner_match_is_child_accepted($viewer, $candidate) && partner_match_score($viewer, $candidate)['is_100']) $count++;
    }
    return $count;
}

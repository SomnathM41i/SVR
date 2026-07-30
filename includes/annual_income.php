<?php

function annual_income_options(): array
{
    return [
        '100000' => '₹1 Lakh',
        '200000' => '₹2 Lakh',
        '300000' => '₹3 Lakh',
        '400000' => '₹4 Lakh',
        '500000' => '₹5 Lakh',
        '600000' => '₹6 Lakh',
        '700000' => '₹7 Lakh',
        '800000' => '₹8 Lakh',
        '900000' => '₹9 Lakh',
        '1000000' => '₹10 Lakh',
        '1200000' => '₹12 Lakh',
        '1400000' => '₹14 Lakh',
        '1600000' => '₹16 Lakh',
        '1800000' => '₹18 Lakh',
        '2000000' => '₹20 Lakh',
        '2200000' => '₹22 Lakh',
        '2400000' => '₹24 Lakh',
        '2600000' => '₹26 Lakh',
        '2800000' => '₹28 Lakh',
        '3000000' => '₹30 Lakh',
        '3500000' => '₹35 Lakh',
        '4000000' => '₹40 Lakh',
        '4500000' => '₹45 Lakh',
        '5000000' => '₹50 Lakh',
        '6000000' => '₹60 Lakh',
        '7000000' => '₹70 Lakh',
        '8000000' => '₹80 Lakh',
        '9000000' => '₹90 Lakh',
        '10000000' => '₹1 Crore',
        '12500000' => '₹1.25 Crore',
        '15000000' => '₹1.5 Crore',
        '20000000' => '₹2 Crore',
        '30000000' => '₹3 Crore',
        '50000000' => '₹5 Crore',
        '50000001' => '₹5 Crore Above',
        'Not Working' => 'Not Working',
        'Income Not Disclosed' => 'Income Not Disclosed'
    ];
}

function annual_income_numeric_options(): array
{
    return array_filter(
        annual_income_options(),
        static fn($label, $value): bool => ctype_digit((string)$value),
        ARRAY_FILTER_USE_BOTH
    );
}

function annual_income_normalize_value($income): string
{
    $income = trim((string)$income);

    if ($income === '') {
        return '';
    }

    $options = annual_income_options();

    if (isset($options[$income])) {
        return $income;
    }

    $numericIncome = str_replace([',', '₹', 'Rs.', 'Rs', 'INR', ' '], '', $income);

    if (ctype_digit($numericIncome) && isset($options[$numericIncome])) {
        return $numericIncome;
    }

    $normalizedIncome = strtolower(preg_replace('/\s+/', ' ', str_replace('₹', '', $income)));
    $legacyLabels = [
        'do not wish to specify' => 'Income Not Disclosed',
        'not disclosed' => 'Income Not Disclosed',
        'not set' => 'Income Not Disclosed',
        'unemployed' => 'Not Working'
    ];

    if (isset($legacyLabels[$normalizedIncome])) {
        return $legacyLabels[$normalizedIncome];
    }

    foreach ($options as $value => $label) {
        $normalizedLabel = strtolower(preg_replace('/\s+/', ' ', str_replace('₹', '', $label)));

        if ($normalizedIncome === $normalizedLabel) {
            return $value;
        }
    }

    return $income;
}

function annual_income_is_valid($income, bool $numericOnly = false): bool
{
    $normalizedIncome = annual_income_normalize_value($income);
    $options = $numericOnly ? annual_income_numeric_options() : annual_income_options();

    return isset($options[$normalizedIncome]);
}

function annual_income_format($income, string $emptyLabel = 'Income Not Disclosed'): string
{
    $income = trim((string)$income);

    if ($income === '') {
        return $emptyLabel;
    }

    $normalizedIncome = annual_income_normalize_value($income);
    $options = annual_income_options();

    if (isset($options[$normalizedIncome])) {
        return $options[$normalizedIncome];
    }

    if (is_numeric($normalizedIncome)) {
        $numericIncome = (float)$normalizedIncome;

        if ($numericIncome >= 10000000) {
            $crores = rtrim(rtrim(number_format($numericIncome / 10000000, 2, '.', ''), '0'), '.');
            return '₹' . $crores . ' Crore';
        }

        if ($numericIncome >= 100000) {
            $lakhs = rtrim(rtrim(number_format($numericIncome / 100000, 2, '.', ''), '0'), '.');
            return '₹' . $lakhs . ' Lakh';
        }

        return '₹' . number_format($numericIncome, 0, '.', ',');
    }

    return $income;
}

function annual_income_select_options($selectedIncome = '', bool $numericOnly = false): string
{
    $selectedIncome = annual_income_normalize_value($selectedIncome);
    $options = $numericOnly ? annual_income_numeric_options() : annual_income_options();
    $html = '';

    foreach ($options as $value => $label) {
        $value = (string)$value;
        $selected = $selectedIncome === $value ? ' selected' : '';
        $html .= '<option value="'
            . htmlspecialchars($value, ENT_QUOTES, 'UTF-8')
            . '"'
            . $selected
            . '>'
            . htmlspecialchars($label, ENT_QUOTES, 'UTF-8')
            . '</option>';
    }

    return $html;
}

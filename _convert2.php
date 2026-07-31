<?php
/**
 * Robust template converter: old header.php/footer.php → header3.php/footer3.php
 *
 * Strategy: split each file at <!DOCTYPE html>, find header include, find footer include,
 * extract body content between them, then rebuild with new template.
 *
 * Usage: php _convert2.php
 */

$files = [
    'full_profile.php'               => ['title'=>'Full Profile – Manpasand Jodidar',              'banner'=>'Profile',          'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Profile']],
    'full_profile_photo_issue.php'   => ['title'=>'Profile Photo – Manpasand Jodidar',             'banner'=>'Profile Photo',    'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Profile']],
    'message.php'                    => ['title'=>'Messages – Manpasand Jodidar',                   'banner'=>'Messages',         'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Messages']],
    'message_received.php'           => ['title'=>'Received Messages – Manpasand Jodidar',          'banner'=>'Received Messages','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Messages']],
    'message_send.php'               => ['title'=>'Sent Messages – Manpasand Jodidar',              'banner'=>'Sent Messages',    'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Messages']],
    'send_message.php'               => ['title'=>'Send Message – Manpasand Jodidar',               'banner'=>'Send Message',     'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Messages']],
    'interest_received.php'          => ['title'=>'Interest Received – Manpasand Jodidar',          'banner'=>'Interest Received','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Interest Received']],
    'interest_send.php'              => ['title'=>'Interest Sent – Manpasand Jodidar',              'banner'=>'Interest Sent',    'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Interest Sent']],
    'block_profile.php'              => ['title'=>'Blocked Profiles – Manpasand Jodidar',           'banner'=>'Blocked Profiles', 'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Blocked Profiles']],
    'profile_ignore.php'             => ['title'=>'Ignored Profiles – Manpasand Jodidar',           'banner'=>'Ignored Profiles', 'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Ignored Profiles']],
    'Profile_shortlisted.php'        => ['title'=>'Shortlisted Profiles – Manpasand Jodidar',       'banner'=>'Shortlisted Profiles','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Shortlisted Profiles']],
    'who_connected_me.php'           => ['title'=>'Who Connected With Me – Manpasand Jodidar',      'banner'=>'Who Connected With Me','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Who Connected With Me']],
    'who_shortlisted_me.php'         => ['title'=>'Who Shortlisted Me – Manpasand Jodidar',         'banner'=>'Who Shortlisted Me','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Who Shortlisted Me']],
    'who_viewed_my_profile.php'      => ['title'=>'Profile Views – Manpasand Jodidar',              'banner'=>'Profile Views',    'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Profile Views']],
    'who_viewed_addreess_list.php'   => ['title'=>'Address Views – Manpasand Jodidar',              'banner'=>'Address Views',    'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Address Views']],
    'my_viewed_profile.php'          => ['title'=>'Viewed Profiles – Manpasand Jodidar',            'banner'=>'Viewed Profiles',  'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Viewed Profiles']],
    'my_viewed_contactlist.php'      => ['title'=>'Viewed Contacts – Manpasand Jodidar',            'banner'=>'Viewed Contacts',  'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Viewed Contacts']],
    'my_connected_members.php'       => ['title'=>'Connected Members – Manpasand Jodidar',          'banner'=>'Connected Members','crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Connected Members']],
    'viewed_address.php'             => ['title'=>'Viewed Address – Manpasand Jodidar',             'banner'=>'Viewed Address',   'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Viewed Address']],
    'Vcontactdetail.php'             => ['title'=>'Contact Details – Manpasand Jodidar',            'banner'=>'Contact Details',  'crumbs'=>['index'=>'Home',''=>'Contact Details']],
    'premium_members.php'            => ['title'=>'Premium Members – Manpasand Jodidar',            'banner'=>'Premium Members',  'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Premium Members']],
    'membership_choose.php'          => ['title'=>'Choose Membership – Manpasand Jodidar',          'banner'=>'Membership Plans', 'crumbs'=>['index'=>'Home','index_dashboard'=>'Dashboard',''=>'Membership Plans']],
];

// ── helpers ──────────────────────────────────────────────────────────────────

function build_banner(string $banner, array $crumbs): string {
    $lis = '';
    $active = '';
    foreach ($crumbs as $href => $label) {
        if ($href === '') { $active = $label; }
        else { $lis .= "          <li><a href=\"$href\">$label</a></li>\n"; }
    }
    $lis .= "          <li>$active</li>\n";
    return "<section class=\"lagnam-page-banner\">\n"
         . "  <div class=\"container\">\n"
         . "    <h1 class=\"banner-title\">$banner</h1>\n"
         . "    <ul class=\"banner-breadcrumb\">\n"
         . $lis
         . "    </ul>\n"
         . "  </div>\n"
         . "</section>";
}

function build_head(string $title): string {
    $pt = $title . ' | Manpasand Jodidar';
    return "<?php\n\$page_title = '$pt';\ninclude('header3.php');\n?>"
         . "\n<style>\n"
         . ".page-section { padding:60px 0; background:#faf7f2; min-height:calc(100vh - 180px); }\n"
         . ".content-card { background:#fff; border-radius:16px; box-shadow:0 4px 30px rgba(0,0,0,0.06); padding:40px; max-width:1200px; margin:0 auto; border:1px solid rgba(122,14,26,0.06); }\n"
         . ".section-title { font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--primary-maroon); text-align:center; margin-bottom:24px; }\n"
         . ".theme-btn { display:inline-block; padding:12px 28px; background:linear-gradient(135deg, var(--royal-gold), #E8C46A); border:none; border-radius:10px; font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:600; color:var(--primary-maroon); transition:all 0.3s; cursor:pointer; border:0; text-decoration:none; }\n"
         . ".theme-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(212,164,55,0.35); color:var(--primary-maroon); }\n"
         . "input, select, textarea { width:100%; padding:10px 14px; border:1.5px solid #e0dbd5; border-radius:10px; font-size:0.92rem; color:#444; }\n"
         . "input:focus, select:focus { border-color:var(--royal-gold); box-shadow:0 0 0 3px rgba(212,164,55,0.15); outline:none; }\n"
         . "label { font-size:0.88rem; color:#666; font-weight:500; margin-bottom:4px; }\n"
         . "table { width:100%; border-collapse:collapse; }\n"
         . "table th { background:var(--primary-maroon); color:#fff; padding:10px 14px; font-weight:600; }\n"
         . "table td { padding:10px 14px; border-bottom:1px solid #f0ebe5; }\n"
         . "</style>\n";
}

function build_foot(): string {
    return "<?php include('footer3.php'); ?>\n"
         . "<script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>\n"
         . "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js\"></script>\n"
         . "</body>\n"
         . "</html>\n";
}

// ── main ─────────────────────────────────────────────────────────────────────

$cwd = __DIR__;

foreach ($files as $filename => $cfg) {
    $path = "$cwd/$filename";
    if (!is_file($path)) { echo "⚠  MISSING: $filename\n"; continue; }

    $src = file_get_contents($path);
    $orig = $src;

    // 1. Split at <!DOCTYPE html> — everything before is PHP header
    $parts = preg_split('/<!DOCTYPE html>/i', $src, 2);
    $php_header = $parts[0];
    $rest = $parts[1] ?? '';

    // 2. Find the header include position (first occurrence)
    //    Patterns: include('header.php'), include("header.php"), include 'header.php'
    $header_re = '/include\s*[\( ]\s*[\'"]header(_new)?\.php[\'"]\s*[\)]?\s*;?\s*\?>/i';
    if (!preg_match($header_re, $rest, $hm, PREG_OFFSET_CAPTURE)) {
        // try without closing PHP tag
        $header_re2 = '/include\s*[\( ]\s*[\'"]header(_new)?\.php[\'"]\s*[\)]?\s*;?/i';
        if (!preg_match($header_re2, $rest, $hm, PREG_OFFSET_CAPTURE)) {
            echo "✗  Cannot find header include in $filename\n";
            continue;
        }
    }
    $header_end = $hm[0][1] + strlen($hm[0][0]); // position right after the include line

    // 3. Find the footer include position (LAST occurrence)
    $footer_re = '/include\s*[\( ]\s*[\'"]footer\.php[\'"]\s*[\)]?\s*;?\s*\?>/i';
    $footer_pos = 0;
    if (!preg_match_all($footer_re, $rest, $fm, PREG_OFFSET_CAPTURE)) {
        // try without PHP tag
        $footer_re2 = '/include\s*[\( ]\s*[\'"]footer\.php[\'"]\s*[\)]?\s*;?/i';
        if (!preg_match_all($footer_re2, $rest, $fm, PREG_OFFSET_CAPTURE)) {
            echo "✗  Cannot find footer include in $filename\n";
            continue;
        }
    }
    $last_footer = end($fm[0]);
    $footer_start = $last_footer[1]; // position of the footer include start

    // 4. Extract body content: from after header include to before footer include
    $body_content = substr($rest, $header_end, $footer_start - $header_end);

    // 5. Clean body content: remove old shell fragments
    $body_content = preg_replace('/<div class="page-wrapper">/i', '', $body_content);
    $body_content = preg_replace('/<div class="preloader"><\/div>/i', '', $body_content);
    $body_content = preg_replace('/<span class="header-span"><\/span>/i', '', $body_content);
    $body_content = preg_replace('/<body[^>]*>/i', '', $body_content);
    $body_content = preg_replace('/<\/body>/i', '', $body_content);
    $body_content = preg_replace('/<html[^>]*>/i', '', $body_content);
    $body_content = preg_replace('/<\/html>/i', '', $body_content);
    $body_content = preg_replace('/<\/head>/i', '', $body_content);

    // Remove old page-title sections (commented or not)
    $body_content = preg_replace('/<section class="page-title".*?<\/section>/is', '', $body_content);
    $body_content = preg_replace('/<!--Page Title-->.*?<!--End Page Title-->/is', '', $body_content);

    // Remove discaimer-section
    $body_content = preg_replace('/<section class="discaimer-section".*?<\/section>/is', '', $body_content);

    // Remove profile_footer wrapper
    $body_content = preg_replace('/<div class="profile_footer">.*?<\/div>/is', '', $body_content);

    // Remove Google Maps API scripts
    $body_content = preg_replace('/<script src="https:\/\/maps\.googleapis\.com\/maps\/api\/js\?key=.*?<\/script>/is', '', $body_content);

    // Remove scroll-to-top
    $body_content = preg_replace('/<div class="scroll-to-top.*?<\/div>/is', '', $body_content);

    // Remove miscellaneous comments
    $body_content = preg_replace('/<!--Scroll to top-->/i', '', $body_content);
    $body_content = preg_replace('/<!--End pagewrapper-->/i', '', $body_content);
    $body_content = preg_replace('/<!-- End Footer -->/i', '', $body_content);
    $body_content = preg_replace('/<!-- Main Footer -->/i', '', $body_content);
    $body_content = preg_replace('/<!--End Google Map APi-->/i', '', $body_content);
    $body_content = preg_replace('/<!-- Color Setting -->/i', '', $body_content);
    $body_content = preg_replace('/<!--\s*Preloader\s*-->/i', '', $body_content);
    $body_content = preg_replace('/<!--\s*Header span\s*-->/i', '', $body_content);
    $body_content = preg_replace('/<!--\s*Header Span\s*-->/i', '', $body_content);

    // Remove old script src=js/ and color settings
    $body_content = preg_replace('/<script src="js\/.*?<\/script>/is', '', $body_content);
    $body_content = preg_replace('/<script src="css2\/.*?<\/script>/is', '', $body_content);

    // Remove jQuery CDN that's already in header3
    $body_content = preg_replace('/<script src="https:\/\/code\.jquery\.com\/.*?<\/script>/i', '', $body_content);

    // 6. Determine content type and wrap
    $body_content = trim($body_content);

    // Check if content is a speakers-section or similar multi-card layout
    // For those, wrap in container only (not content-card)
    // For single-card content, wrap in content-card

    // Simple heuristic: if content starts with <section or <div with grid, use bare wrapper
    // Otherwise wrap in content-card
    $starts_with_section = preg_match('/^<(section|div)\b/i', $body_content);

    // 7. Build new document
    $new_banner = build_banner($cfg['banner'], $cfg['crumbs']);
    $new_head = build_head($cfg['title']);
    $new_foot = build_foot();

    $out = $php_header;
    $out .= $new_head;
    $out .= "\n" . $new_banner . "\n\n";
    $out .= "<section class=\"page-section\">\n";
    $out .= "  <div class=\"container\">\n\n";
    $out .= $body_content;
    $out .= "\n\n  </div>\n";
    $out .= "</section>\n\n";
    $out .= $new_foot;

    // Clean up triple+ blank lines
    $out = preg_replace('/\n{4,}/', "\n\n", $out);
    $out = preg_replace('/^\n+/', '', $out);

    // Backup & write
    if (!is_file($path . '.bak2')) {
        copy($path, $path . '.bak2');
    }
    file_put_contents($path, $out);
    echo "✓  $filename\n";
}

echo "\nDone. 22 files converted.\n";

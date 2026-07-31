<?php
/**
 * Manpasand Jodidar — brand constants helper (Phase R1: Brand Foundation).
 *
 * Single source of truth for the application brand: name, tagline, tagline
 * and brand asset locations. Loaded once by includes/bootstrap.php so every
 * page (485+ consumers of the bootstrap) can use it.
 *
 * Contract (same as includes/security.php):
 *   - defines functions/constants only
 *   - produces NO output
 *   - performs NO database queries
 *   - starts NO session
 *
 * Nothing in this repository references it yet; Phase R2 wires the public
 * brand strings/assets to it file-by-file with auditable diffs.
 */

if (defined('MPJ_BRAND_LOADED')) {
    return;
}
define('MPJ_BRAND_LOADED', true);

/** Brand display name. */
define('MPJ_BRAND_NAME', 'Manpasand Jodidar');

/** Brand tagline (display form). */
define('MPJ_BRAND_TAGLINE', 'Rishta Dil Se, Saath Zindagi Bhar');

/** Brand tagline (uppercase form, as rendered in the logo). */
define('MPJ_BRAND_TAGLINE_UPPER', 'RISHTA DIL SE, SAATH ZINDAGI BHAR');

/**
 * Absolute public site URL (scheme + host, no trailing slash), used only
 * where RELATIVE paths cannot work: Open Graph/Twitter meta images and
 * <img> tags inside outgoing e-mail bodies.
 *
 * Defaults to the current production domain. Override without code edits:
 *   - environment variable SVR_BRAND_URL, or
 *   - config.local.php:  return [ 'SVR_BRAND_URL' => 'https://example.com' ];
 * (same mechanism as every other svr_config() key — see config.php).
 */
if (!defined('MPJ_BRAND_URL')) {
    $mpj_brand_url = 'https://weddingsparampara.com';
    if (function_exists('svr_config')) {
        $mpj_brand_url = rtrim((string) svr_config('SVR_BRAND_URL', $mpj_brand_url), '/');
    }
    define('MPJ_BRAND_URL', $mpj_brand_url);
    unset($mpj_brand_url);
}

/**
 * Map of all brand asset files, relative to the site root
 * (e.g. 'branding/logos/emblem.png'). Callers add their own relative or
 * absolute prefix because pages live at mixed depths; per-file wiring
 * happens in Phase R2+.
 *
 * @return array<string,string>
 */
function mpj_brand_assets() {
    return array(
        'logo'              => 'branding/logos/manpasand-jodidar-logo.png', // square master, cream bg
        'logo_full'         => 'branding/logos/logo-full.png',              // tight-trimmed, cream bg
        'logo_transparent'  => 'branding/logos/logo-full-transparent.png',  // transparent bg (exterior)
        'logo_badge'        => 'branding/logos/logo-badge.png',             // rounded cream card (for dark bgs)
        'emblem'            => 'branding/logos/emblem.png',                 // heart/couple mark only
        'emblem_transparent'=> 'branding/logos/emblem-transparent.png',
        'favicon_ico'       => 'branding/favicons/favicon.ico',
        'favicon_32'        => 'branding/favicons/icon-32.png',
        'apple_touch'       => 'branding/favicons/apple-touch-icon.png',
        'icon_192'          => 'branding/favicons/icon-192.png',
        'icon_512'          => 'branding/favicons/icon-512.png',
        'og_image'          => 'branding/images/og-image.jpg',              // 1200x630 social share
        'whatsapp_image'    => 'branding/images/whatsapp-share.jpg',        // WhatsApp link preview
        'email_logo'        => 'branding/images/email-logo.png',            // 640px e-mail header
        'print_logo'        => 'branding/images/print-logo.png',            // PDF/biodata letterhead
        'watermark'         => 'branding/images/watermark.png',             // 10% emblem, PDF watermark
        'splash'            => 'branding/images/splash-logo.jpg',           // loading/splash artwork
        'divider'           => 'branding/icons/divider.png',                // gold-leaf heart divider
        'heart'             => 'branding/icons/heart.png',                  // rose heart glyph
        'webmanifest'       => 'branding/site.webmanifest',
        'tokens_css'        => 'branding/branding.css',
    );
}

/**
 * One brand asset path (root-relative), or '' for an unknown key.
 */
function mpj_brand_asset($key) {
    $assets = mpj_brand_assets();
    return isset($assets[$key]) ? $assets[$key] : '';
}

/**
 * Absolute URL for a brand asset — ONLY for e-mail <img> and OG/Twitter
 * meta (places where relative URLs cannot work). Everything else should
 * resolve the root-relative path against the page's own depth.
 */
function mpj_brand_asset_url($key) {
    $rel = mpj_brand_asset($key);
    return $rel === '' ? '' : MPJ_BRAND_URL . '/' . $rel;
}

/**
 * Brand identity array for templates/emails/reports.
 *
 * @return array<string,string>
 */
function mpj_brand() {
    return array(
        'name'          => MPJ_BRAND_NAME,
        'tagline'       => MPJ_BRAND_TAGLINE,
        'tagline_upper' => MPJ_BRAND_TAGLINE_UPPER,
        'base_url'      => MPJ_BRAND_URL,
        'color_maroon'  => '#5E1426',
        'color_rose'    => '#C9556A',
        'color_gold'    => '#BA9350',
        'color_cream'   => '#F9E7DC',
        'color_burgundy'=> '#3D0C19',
    );
}

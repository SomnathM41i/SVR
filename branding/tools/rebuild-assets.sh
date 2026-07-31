#!/usr/bin/env bash
# rebuild-assets.sh — Manpasand Jodidar brand asset pipeline
#
# Regenerates every derived brand asset in branding/ from a single master logo.
#
# Usage:
#   branding/tools/rebuild-assets.sh [path-to-master.png]
#
# Default master: branding/logos/manpasand-jodidar-logo.png
# To swap in the final/original artwork later, replace that one file
# (1024x1024, logo centered on #F9E7DC cream) and re-run this script.
#
# Requires ImageMagick 6+ (convert). Pure asset generation: touches no PHP,
# no templates, no database.

set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
MASTER="${1:-$ROOT/logos/manpasand-jodidar-logo.png}"

CREAM="#F9E7DC"
MAROON="#5E1426"
ROSE="#C9556A"
GOLD="#BA9350"
WARMWHITE="#FFFDFB"

LOGOS="$ROOT/logos"
FAVS="$ROOT/favicons"
IMGS="$ROOT/images"
ICONS="$ROOT/icons"

[ -f "$MASTER" ] || { echo "ERROR: master not found: $MASTER" >&2; exit 1; }

# --- 1. Tight-trimmed full logo (cream background) --------------------------
convert "$MASTER" -fuzz 3% -trim +repage "$LOGOS/logo-full.png"

# --- 2. Transparent-background version (exterior cream only; interior
#        negative space stays intact because floodfill starts at corners) ----
convert "$MASTER" -alpha set -channel RGBA \
  -fuzz 8% -fill none -floodfill +0+0    "$CREAM" \
            -fill none -floodfill +1023+0 "$CREAM" \
            -fill none -floodfill +0+1023 "$CREAM" \
            -fill none -floodfill +1023+1023 "$CREAM" \
  +channel /tmp/.mpj-logo-alpha.png
convert /tmp/.mpj-logo-alpha.png -fuzz 3% -trim +repage "$LOGOS/logo-full-transparent.png"

# --- 3. Emblem only (heart/couple/ring/ornament), cream + transparent -------
#     Crop window tuned to the 1024x1024 master layout, then trim.
convert "$MASTER" -crop 560x510+232+70 +repage -fuzz 3% -trim +repage "$LOGOS/emblem.png"
convert /tmp/.mpj-logo-alpha.png -crop 560x510+232+70 +repage -fuzz 3% -trim +repage "$LOGOS/emblem-transparent.png"

# --- 4. Heart divider ornament + heart glyph (transparent) ------------------
convert /tmp/.mpj-logo-alpha.png -crop 336x48+344+841 +repage -fuzz 4% -trim +repage "$ICONS/divider.png"
convert /tmp/.mpj-logo-alpha.png -crop 48x48+490+840  +repage -fuzz 4% -trim +repage "$ICONS/heart.png"

# --- 5. Rounded-corner badge (for dark/maroon backgrounds) ------------------
W=$(identify -format %w "$LOGOS/logo-full.png"); H=$(identify -format %h "$LOGOS/logo-full.png")
R=$(( (W < H ? W : H) / 12 ))
convert "$LOGOS/logo-full.png" -alpha set \
  \( +clone -fill black -colorize 100 -fill white \
     -draw "roundrectangle 0,0 $((W-1)),$((H-1)) $R,$R" \) \
  -alpha off -compose CopyOpacity -composite "$LOGOS/logo-badge.png"

# --- 6. Favicon family -------------------------------------------------------
TMPF=/tmp/.mpj-favsq.png
convert "$LOGOS/emblem.png" -background "$CREAM" -gravity center \
  -resize 620x620 -extent 680x680 /tmp/.mpj-fav-base.png
for SZ in 16 32 48 64 180 192 512; do
  convert /tmp/.mpj-fav-base.png -resize ${SZ}x${SZ} "$FAVS/icon-${SZ}.png"
done
cp "$FAVS/icon-180.png" "$FAVS/apple-touch-icon.png"
convert "$FAVS/icon-16.png" "$FAVS/icon-32.png" "$FAVS/icon-48.png" "$FAVS/favicon.ico"
rm -f "$TMPF" /tmp/.mpj-fav-base.png

# --- 7. Social / share images ----------------------------------------------
#     Open Graph & WhatsApp preview: 1200x630, centered logo, thin gold frame.
convert -size 1200x630 "xc:$CREAM" \
  \( "$LOGOS/logo-full.png" -resize 560x560 \) -gravity center -composite \
  -shave 16x16 -bordercolor "$GOLD" -border 2 \
  -bordercolor "$CREAM" -border 14 \
  -strip -interlace JPEG -quality 88 "$IMGS/og-image.jpg"
cp "$IMGS/og-image.jpg" "$IMGS/whatsapp-share.jpg"

# --- 8. Splash / loading screen artwork (square) ----------------------------
convert -size 1200x1200 "xc:$CREAM" \
  \( "$LOGOS/logo-full.png" -resize 820x820 \) -gravity center -composite \
  -strip -interlace JPEG -quality 88 "$IMGS/splash-logo.jpg"

# --- 9. Email header logo (2x for retina; display at ~300px) ----------------
convert "$LOGOS/logo-full.png" -background "$CREAM" -bordercolor "$CREAM" -border 4% -resize 640x640 \
  -strip -colors 128 "PNG8:$IMGS/email-logo.png"

# --- 10. PDF / biodata watermark (emblem at 10% opacity) --------------------
convert "$LOGOS/emblem-transparent.png" -resize 480x480 \
  -channel A -evaluate multiply 0.10 +channel -strip "$IMGS/watermark.png"

# --- 11. Print letterhead strip: logo on warm white, generous padding -------
convert "$LOGOS/logo-full.png" -background "$WARMWHITE" -gravity center \
  -bordercolor "$WARMWHITE" -border 20x20 -resize 480x480 -gravity center \
  -strip "$IMGS/print-logo.png"

# --- 12. Manifest assets note (icons already in favicons/) -------------------
# --- 13. Horizontal lockup (emblem + wordmark), 3.36:1 canvas.
#     For legacy 168x50 e-mail slots and print letterheads; brand typography
#     is cropped from the master itself (never re-typeset).
convert "$MASTER" -crop 700x317+162+588 +repage -fuzz 3% -trim +repage /tmp/.mpj-wordmark.png
convert -size 1008x300 "xc:$CREAM" \
  \( "$LOGOS/emblem.png" -resize x250 \) -gravity West -geometry +66+0 -composite \
  \( /tmp/.mpj-wordmark.png -resize x230 \) -gravity West -geometry +346+0 -composite \
  -strip -colors 128 "PNG8:$LOGOS/logo-horizontal.png"
rm -f /tmp/.mpj-wordmark.png

rm -f /tmp/.mpj-logo-alpha.png /tmp/.mpj-badge-step.png

echo "Brand assets rebuilt from: $MASTER"
find "$ROOT" -type f \( -name '*.png' -o -name '*.ico' -o -name '*.jpg' \) -printf '%P %s bytes\n' | sort

#!/usr/bin/env sh

set -e

# Verify Language Extractors
scalibr -plugins="$LANGUAGE_EXTRACTORS" -o textproto=/tmp/result.textproto
grep -q "$DEFAULT_PKG_FILE" /tmp/result.textproto || { echo "FAIL: DEFAULT_PKG_FILE: $DEFAULT_PKG_FILE not found"; exit 1; }
grep -q "$EXTRA_PKG_FILE" /tmp/result.textproto || { echo "FAIL: EXTRA_PKG_FILE: $EXTRA_PKG_FILE not found"; exit 1; }

echo "----"

# Verify OS Extractor
scalibr -plugins="$OS_EXTRACTOR" -o textproto=/tmp/result.textproto
grep -qE "\sname:\s+\"$DEFAULT_PKG\"" /tmp/result.textproto || { echo "FAIL: DEFAULT_PKG: $DEFAULT_PKG not detected by OS extractor"; exit 1; }
grep -qE "\sname:\s+\"$EXTRA_PKG\"" /tmp/result.textproto || { echo "FAIL: EXTRA_PKG: $EXTRA_PKG not detected by OS extractor"; exit 1; }

echo "----"

has_exploitability_signals() {
  local target="$1"
  local file=/tmp/result.textproto

  # Fast-fail: If the target isn't in the file at all, return 1 (false)
  if ! grep -q "$target" "$file"; then
    return 1
  fi

  # Use awk to check the packages content:
  # - treat `packages: {` as separator
  # - check if the package block ($0) contains both the target file and exploitability_signals
  # - if so return 0 (true)
  # - if no match is found by the end return 1 (false)
  awk -v tgt="$target" '
    # We escape the { to treat it as a literal character
    BEGIN { RS = "packages:[[:space:]]*\\{" }

    $0 ~ tgt && /exploitability_signals/ {
      found = 1;
      exit 0
    }
    END { exit (found ? 0 : 1) }
  ' $file
}


# Verify that exploitability_signals are only added to default pkg related packages:

scalibr -plugins="$OS_EXTRACTOR,$DUP_ANNOTATOR,$LANGUAGE_EXTRACTORS" -o textproto=/tmp/result.textproto
if ! has_exploitability_signals "$DEFAULT_PKG_FILE"; then
  echo "FAIL: exploitability_signals missing from $DEFAULT_PKG_FILE" >&2
  exit 1
fi
if has_exploitability_signals "$EXTRA_PKG_FILE"; then
  echo "FAIL: exploitability_signals unexpectedly found in $EXTRA_PKG_FILE" >&2
  exit 1
fi


echo "--- All Tests Passed ---"

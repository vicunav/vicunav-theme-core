#!/usr/bin/env bash
set -euo pipefail

repo_dir="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

jq empty "$repo_dir/theme.json" "$repo_dir/styles/bonasera.json"
node "$repo_dir/tests/validate-bonasera.mjs"
node "$repo_dir/tests/validate-restaurant-patterns.mjs"

while IFS= read -r php_file; do
	php -l "$php_file" >/dev/null
done < <(find "$repo_dir" -type f -name '*.php' -not -path '*/.git/*' -not -path '*/docs/standards/*' | sort)

echo "Validaciones del theme completadas."

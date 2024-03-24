#!/bin/bash

# Function to parse the version from JSON
parse_version() {
    local version=$(jq -r '.version' composer.json)
    echo "${version#v}"  # Remove 'v' prefix if present
}

# Function to update composer.json with the new version
update_composer() {
    local new_version=$1
    jq ".version = \"v$new_version\"" composer.json > composer.tmp && mv composer.tmp composer.json
}

# Main script
# Parse version from JSON
current_version=$(parse_version)

# Increment version (e.g., v1.0.0-dev -> v1.0.1-dev)
new_version=$(echo $current_version | awk -F'-' '{split($1, a, "."); print a[1]"."a[2]"."a[3]+1""}')

# Update composer.json with the new version
update_composer "$new_version"

# Commit the changes
git add composer.json
git commit -m "Bump version to $new_version"

# Push the changes to the remote repository
git push origin main

# Create and push the tag
git tag -a "v$new_version" -m "Version $new_version"
git push origin "v$new_version"

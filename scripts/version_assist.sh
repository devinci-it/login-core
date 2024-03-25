#!/bin/bash

# Function to prompt user for SemVer category
prompt_semver() {
    read -p "Enter SemVer category (major, minor, patch): " semver_category
    case $semver_category in
        major|minor|patch)
            ;;
        *)
            echo "Invalid SemVer category. Please enter major, minor, or patch."
            prompt_semver
            ;;
    esac
}

# Prompt for SemVer category
prompt_semver

# Add all changes
git add .

# Prompt for commit message
read -p "Enter commit message: " commit_message

# Commit changes
git commit -m "$commit_message"

# Create SemVer tag
tag_version=$(git describe --tags --abbrev=0)
case $semver_category in
    major)
        tag_version=$(echo $tag_version | awk -F. '{$NF = $NF + 1;} 1' OFS=.)
        ;;
    minor)
        tag_version=$(echo $tag_version | awk -F. '{$(NF-1) = $(NF-1) + 1;} 1' OFS=.)
        ;;
    patch)
        tag_version=$(echo $tag_version | awk -F. '{$(NF-2) = $(NF-2) + 1;} 1' OFS=.)
        ;;
esac

# Tag the commit
git tag -a $tag_version -m "$commit_message"

# Prompt to push tags
read -p "Do you want to push tags? (y/n): " push_tags
if [[ $push_tags == "y" || $push_tags == "Y" ]]; then
    git push origin $tag_version
    echo "Tag $tag_version pushed successfully."
fi

# Prompt to push to main branch
read -p "Do you want to push to main branch? (y/n): " push_main
if [[ $push_main == "y" || $push_main == "Y" ]]; then
    git push origin main
    echo "Changes pushed to main branch successfully."
fi

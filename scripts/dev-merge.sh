#!/usr/bin/env bash

# Update origin branches
git remote update origin --prune

# Get current branch
currentBranch=$(git symbolic-ref --short -q HEAD)

# Ensure working directory in version branch clean
git update-index -q --refresh
if ! git diff-index --quiet HEAD --; then
  echo "Working directory not clean, please commit your changes first"
  exit
fi

git pull origin $currentBranch
git push origin $currentBranch

git checkout dev
git pull origin dev
git merge $currentBranch --no-ff --no-edit
git push origin dev

git checkout $currentBranch

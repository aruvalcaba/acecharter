# Team Contribution Guide

## Branching Structure

* `master` - the production branch. Code in this branch is release-ready and contains the code from the current build on the playstore. We'll merge `develop` into this branch on each release.
* `develop` - the **planned** working branch. All development will take place off of this branch in the future
* `refactor-adr` - the current working branch. **All development must take place off this branch 
## Checking out the Project (You can skip these next 2 steps if you have acecharter virtual machine image)

Change directories into your main project directory.

    cd ~/work

Clone the project

    git clone git@github.com:aruvalcaba/acecharter.git

You now have a local copy of the repository.

## Making Changes

All changes to the repository should initially be made within a local feature branch.

    git checkout refactor-adr
    git pull origin refactor-adr
    git checkout -b my-issue-branch

Commit as early and often as you'd like until you're done with your feature or bug fix or whatever the task is.

## Submitting your Changes

Once you have a set of commits that you'd like to share with the rest of the team, do the following:

    git fetch refactor-adr
    git rebase -i origin/refactor-adr

At this point you may or may not have merge conflicts. If you do, resolve them. Then run

    git add .
    git rebase --continue

git rebase -i  will show a list of commits. We only really want one commit per feature or fix, so if there is more than one commit, for all commits but the first one, replace the word *pick* with the word *squash* to squash those commits into one.

On the next screen, if you squashed, it will make you pick an appropriate commit message. Erase the combined ones they have there and write a single appropriate commit message.

I'd then recommend the optional step of pushing your feature branch up to the remote and comparing your branch to `refactor-adr`. Looking at the diff logs often reveals something you forgot. If something needs changing, make changes and start this process over. If everything does look good, continue.

Next, checkout the `refactor-adr` branch, merge in your changes, and push them up to the remote repo.

    git checkout refactor-adr
    git merge my-issue-branch
    git push origin refactor-adr

And you're done. Pick a new feature and do it again.

This is a nice tutorial of git rebasing, squashing commits, etc

https://www.youtube.com/watch?v=qh9KtjfjzCU
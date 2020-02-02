# Contributing to Simple CMS

First of all, thank you for contributing, you're awesome!

To have your code integrated in the Simple CMS project, there are some rules to follow, but don't panic, it's easy!

## Reporting Bugs

If you happen to find a bug, you may report it using GitHub by following these 3 points:

* Check if the bug is not already reported!
* A clear title to resume the issue
* A description of the workflow needed to reproduce the bug

> _NOTE:_ Don't hesitate giving as much information as you can (OS, Browser version...)

## Pull Requests

> Work in progress

## Squash your Commits

If you have 3 commits, start with:

```shell
git rebase -i HEAD~3
```

An editor will be opened with your 3 commits, all prefixed by `pick`.

Replace all `pick` prefixes by `fixup` (or `f`) **except the first commit** of the list.

Save and quit the editor.

After that, all your commits will be squashed into the first one and the commit message will be the first one.

If you would like to rename your commit message, type:

```shell
git commit --amend
```

Now force push to update your PR:

```shell
git push --force-with-lease
```

# License and Copyright Attribution

When you open a Pull Request to the Simple CMS project, you agree to license your code under the [MIT license](LICENSE)
and to transfer the copyright on the submitted code to Yann Prou.

Be sure to you have the right to do that (if you are a professional, ask your company)!

If you include code from another project, please mention it in the Pull Request description and credit the original author.

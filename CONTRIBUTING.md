# How to contribute

*Simple contribution guidelines to make open source happy and organized*

Resist being a lazy developer, we can get through this together.

## Project organization

* Branch `master` is always stable and release-ready.
* Branch `develop` is for development and merged into `master` when stable.
* Feature branches should be created for adding new features and merged into `develop` when ready.
* Bug fix branches should be created for fixing bugs and merged into `develop` when ready.
* See also: [*A successful Git branching model*](http://nvie.com/posts/a-successful-git-branching-model).

## Opening a new issue

**Do not open a duplicate issue!**

1. Look through existing issues to see if your issue already exists.
2. If your issue already exists, comment on its thread with any information you have. Even if this is simply to note that you are having the same problem, it is still helpful!
3. Always *be as descriptive as you can*.
4. What is the expected behavior? What is the actual behavior? What are the steps to reproduce?
5. Attach screenshots, videos, GIFs if possible.
6. **Include library version or branch experiencing the issue.**
7. **Include OS version and devices experiencing the issue.**

## Submitting a pull request

1. Find an issue to work on, or create a new one. *Avoid duplicates, please check existing issues!*
2. Fork the repo, or make sure you are synced with the latest changes on `develop`.
3. Create a new branch with a sweet name: `git checkout -b issue_<##>_<description>`.
4. Do some [motherfucking programming](http://programming-motherfucker.com).
5. Keep your code nice and clean by adhering to the coding standards & guidelines below.
6. Don't break unit tests or functionality.
7. Update the documentation header comments if needed.
8. **Rebase on `develop` branch and resolve any conflicts _before submitting a pull request!_**
9. Submit a pull request to the `develop` branch.

**You should submit one pull request per feature!** The smaller the PR, the better your chances are of getting merged. Enormous PRs will likely take enormous amounts of time to review, or they will be rejected.

## Style guidelines

Style and adherence to conventions is just as important as the code you write. Most of our time is spent reading code, not writing it. *Don't be sloppy.* 
Above all, conform to the existing style of the code in which you are working. When in doubt, refer to the guides below.

[PSR-2 Coding Style Guide](https://www.php-fig.org/psr/psr-2/)

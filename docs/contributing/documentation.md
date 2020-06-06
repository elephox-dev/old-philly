---
layout: default
title: Documentation
parent: Contributing
---

# Documentation

## Local Development

### Prerequisites

To preview your changes to the documentation before committing them, you can use jekyll, a static site generator.

You need to have ruby installed in order to use `jekyll` and `bundle`.

After you got those, navigate to the `docs/` folder from the main repository:

```bash
$ cd docs
```

Then, run:

```bash
$ bundle install
```

to install the dependencies. You only need to run this once to set jekyll up.

### Server

You will want to run this command to start watching for file changes and start a web server:

```bash
$ bundle exec jekyll serve --config _config.local.yml
```

You can then go to [localhost:4000](http://localhost:4000/) to review your changes.

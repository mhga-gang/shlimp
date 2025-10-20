# SHLIMP — SHell Lightweight Interactive Management Portal

## What the heck is this?

> This project is a minimal PHP web shell with a retro hacker-style interface running inside a Docker container (for fast tests). It's a lightweight, browser-based PHP shell with persistent session history and a fun leet aesthetic.

## Features

- **Web-based command executor** — run shell commands directly from your browser.
- **Session-based command history** — keeps track of all executed commands during your session.
- **Built-in helper commands** — `help` and `clear` for quick reference and cleanup.
- **Dockerized setup** — ready-to-run environment with PHP preinstalled.
- **Lightweight & portable** — runs with minimal dependencies and no database required.

```sh
$ docker exec -it shlimp php --version

PHP 8.1.2-1ubuntu2.22 (cli) (built: Jul 15 2025 12:11:22) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2-1ubuntu2.22, Copyright (c), by Zend Technologies
```

## How to run?

```sh
# Build container.
docker build -t shlimp .

# Run it with volume. Access on `http://localhost:1337/`
docker run -it --rm \
    -v $(pwd):/app \
    -p 1337:1337 \
    --name shlimp \
    shlimp

# Access interactive bash.
docker exec -it shlimp bash
```

## How to collaborate?

```sh
git checkout -b [BRANCH_TYPE]/[BRANCH_NAME]

git add .

git commit -m "COMMIT_TYPE(CHANGES_SCOPE): COMMIT_MSG"

git push origin [BRANCH_TYPE]/[BRANCH_NAME]
```

```sh
docker build -t shlimp .

docker run -it --rm \
    -v $(pwd):/app \
    -p 1337:1337 \
    --name shlimp \
    shlimp

docker exec -it shlimp bash
```

```sh
$ docker exec -it shlimp php --version

PHP 8.1.2-1ubuntu2.22 (cli) (built: Jul 15 2025 12:11:22) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2-1ubuntu2.22, Copyright (c), by Zend Technologies
```

```
TODO:

- Add style;
- Create docs.
```

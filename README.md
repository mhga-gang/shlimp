```sh
docker build -t shlimp .

docker run -it --rm \
    -v $(pwd):/app \
    -p 1337:1337 \
    --name shlimp \
    shlimp

docker exec -it shlimp bash
```
## KNP Taste

A **Symfony project** for accessing to awesome video courses !

# Official maintainers:

* [@lcouellan](https://github.com/lcouellan)

# Installation

```bash
git clone https://github.com/lcouellan/knp-taste.git

composer install

docker-compose build

docker-compose up -d

docker-compose exec ./bin/console doctrine:migrations:migrate

docker-compose exec ./bin/console doctrine:fixtures:load
```

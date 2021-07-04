# LaravelAPI
Estudos para criação de API em Laravel

## Comando no Composer para Baixar a instalação inicial do Projeto
composer create-project --prefer-dist laravel/laravel:^7.0 src

## Comando Docker para Criar e Iniciar os containers
docker-compose up -d

## Comando Artisan para gerar nova APP_KEY (Apenas para casos que dê algum problema com a chave atual, como por exemplo reinstalação)
php artisan key:generate.

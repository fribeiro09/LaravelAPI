# LaravelAPI
Exemplo para criação de API em Laravel.

Neste projeto foi utilizado o PHP v7.4 e Laravel v7.0. Na camada de segurança/autenticação da API foi utilizado o padrão JWT.
Para este exemplo, foi criado um CRUD simples para controle de Ordens de Serviço, aplicando o conceito de Multi-Inquilinos (Multi-Tenancy) utilizando a mesma base de dados. 
As entidades criadas são:
- Customer (Clientes)
- Order (Ordem de Serviços)
- OrderService (Relacionamento Ordem de Serviços X Serviços)
- Services (Serviços)
- Tenant (Empresas)
- Users (Usuários)

Para os testes unitários, será utilizado o PHPUnit

## Primeiros Passos

### Criar e Iniciar os containers
Comando Docker para iniciar os conteiners
```
docker-compose up -d
```

### Acessar o conteiner e rodar os comandos Artisan
Para os casos que forem necessários executar comandos artisan, acessar o prompt de comando e executar o comando abaixo
```
docker exec -it laravel-api bash 
```

### Executar os Migrates de Banco de Dados
Para os casos que forem necessários executar comandos artisan, acessar o prompt de comando e executar o comando abaixo
```
php artisan migrate
php artisan db:seed
```

### Comando Artisan para gerar nova APP_KEY (Apenas para casos que dê algum problema com a chave atual, como por exemplo reinstalação)
Em casos de nova instalação de ambiente, pode ocorrer de ser necessário regerar a Key. Para isto, executar o comando abaixo e atualizar o arquivo .env na TAG APP_KEY
```
php artisan key:generate
```

## Utilizando a API
Após este processo de configuração inicial do ambiente, os endpoints estão aptos para serem utilizados. Foi utilizado um DB SEED para preencher alguns dados basicos iniciais para consumo da API. O Usuário criado para a autenticação inicial e geração do Token podem ser vistos e alterados em /src/database/seeds/UserSeeder.php

Para auxilio e testes criei uma collection no postman, disponibilizada neste repositório na pasta /docs/LaravelAPI.postman_collection.json
A Aplicação utiliza a autenticação modo Bearer.

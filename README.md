# Posts API

## API para criação/manipulação de Posts, Comments e Likes

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![Postgres](https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white)

## Features

- CRUD de Posts
- CRUD de Comments
- Inclusão e Remoção de Likes para Posts e Comments

## Tecnologias

As tecnologias utilizadas neste projeto foram:

- Laravel Framework 8.83.23
- Composer version 2.1.8
- php v8.1.8

## Instalação

1. Abra o terminal do seu sistema operacional
2. Clone o repositório do projeto

```
git clone [...](https://github.com/erick-jeronimo/api-posts.git)
```

3. Defina seu ambiente

```
cp .env.example .env
```

4. Instale os pacotes necessários

```
composer install
```

5. Execute as migrations do projeto (certifique-se que o serviço do Postgres esteja ativo)

- Opcionalmente rode os Seeders do projeto para ter dados de teste (recomendado)

```
php artisan migrate --seed
```

6. Execute a aplicação

```
php artisan serve
```

7. Em uma nova aba/janela a do terminal do seu sistema operacional, execute o serviço de filas do laravel

```
php artisan queue:work
```

**Parabéns, sua API de Posts já está devidamente configurada e operacional!!**

## Documentação da API

A seguir temos a documentação da API com seus endpoints:

| Operação                        | Resource | Método HTTP | Endpoint                 | Respostas HTTP |
| ------------------------------- | -------- | ----------- | ------------------------ | -------------- |
| Curtir um Post                  | Like     | POST        | posts/{post}/likes       | 201, 404       |
| Curtir um Comment               | Like     | POST        | comments/{comment}/likes | 201, 404       |
| Remover um Like                 | Like     | DELETE      | likes/{like}             | 204, 404       |
| Listar Comments de um Post      | Comment  | GET         | posts/{post}/comments    | 200, 404       |
| Exibir um Comment               | Comment  | GET         | comments/{comment}       | 200, 404       |
| Registrar um Comment em um Post | Comment  | POST        | posts/{post}/comments    | 201, 404       |
| Atualizar um Comment            | Comment  | PUT         | comments/{comment}       | 200, 404       |
| Remover um Comment              | Comment  | DELETE      | comments/{comment}       | 204, 404       |
| Listar Todos os Posts           | Posts    | GET         | /posts                   | 200,           |
| Exibir um Post                  | Posts    | GET         | /posts                   | 200, 404       |
| Registrar um Post               | Posts    | POST        | /posts                   | 201            |
| Atualizar um Post               | Posts    | PUT         | /posts/{post}            | 200, 404       |
| Remover um Post                 | Posts    | DELETE      | /posts/{post}            | 204, 404       |

1. Para mais detalhes e exemplos sobre a utilização da API, abra o arquivo de collection (***API - Posts.json***) em sua ferramenta favorita (Ex.: Postman / Insomnia)
2. Opcionalmente, você pode utilizar o endereço /request-docs/ para visualizar a documentação via browser
3. Para mais detalhes, visite a [documentação da Biblioteca LDR](https://github.com/rakutentech/laravel-request-docs)

## Bibliotecas

Este projeto utiliza a(s) seguinte(s) biblioteca(s) de terceiros:

| Plugin | README |
| ------ | ------ |
| LRD - Laravel Request Docs | <https://github.com/rakutentech/laravel-request-docs> |

## Testes

Esta API conta com Feature (HTTP) Tests. Para rodar os testes utilize o seguinte comando:

```
php artisan test
```

## Contato

Email - erickjeronimo@gmail.com

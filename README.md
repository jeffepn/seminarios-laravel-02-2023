<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sobre o Projeto

Este projeto é o resultado da implementação, durante o seminário de **Laravel** no back end, oferecido pela PUC de Poços de Caldas para seus graduandos e público externo.

## Aplicabilidade

O exemplo escolhido foi uma api para controle de vendas, consistindo na criação de rotas e fluxo para gerenciamento de:

-   Produtos
-   Itens de vendas
-   Vendas

## Clonando e instalando o projeto

Para execução do projeto será necesário ter:

-   Git
-   Composer
-   PHP
-   Servidor mysql(local ou remoto)

```bash
git clone https://github.com/jeffepn/seminarios-laravel-02-2023.git
cd seminarios-laravel-02-2023
composer install
cp .env-example .env
php artisan key:generate
```

## Configuração do banco de dados

Abra o arquivo .env e edite conforme os dados de acesso de seu servidor de banco de dados.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=system_sales
DB_USERNAME=root
DB_PASSWORD=
```

Em seguida execute o comando abaixo, para criação da estrutura de dados no **DB**.

```bash
php artisan migrate
```

## Executar a aplicação

Para execução do projeto será necesário ter o PHP instalado, e um servidor mysql disponível(local ou remoto).

Não esqueça de configurar o banco de dados deste [passo](#configuração-do-banco-de-dados).

```bash
php artisan serve
# A saída será parecida como a seguir, acesso o link no navegador e projeto estará no ar
INFO  Server running on [http://127.0.0.1:8000].
```

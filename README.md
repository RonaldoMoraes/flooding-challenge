<h1 align="center">
    Desafio do Alagamento de Silhuetas
</h1>
<h4 align="center"> 
	 🗡️ Done!
</h4>

- [X] Consumir um file
- [X] Encapsular em funções/classes distintas
- [X] Mostrar tempo de execução no terminal
- [X] Representação Gráfica no terminal
- [X] Disponibilizar uma página web com form p/ input de arquivo
- [X] Representação Gráfica de cada teste na página, junto com a resposta e tempo de execução
- [X] Dockerize
- [X] Testes com phpunit (Fazer mais)
- [X] Documentação

<br>

<p align="center">	

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/RonaldoMoraes/flooding-challenge">

  <a href="https://github.com/RonaldoMoraes/flooding-challenge/commits/main">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/RonaldoMoraes/flooding-challenge">
  </a>

</p>

## 💻 Aplicação

Resolução do desafio:
<p align="center">
    ![WEB](https://github.com/RonaldoMoraes/flooding-challenge/blob/main/examples/flooding-web.jpg?raw=true)
	![TERMINAL](https://github.com/RonaldoMoraes/flooding-challenge/blob/main/examples/flooding-terminal.jpg?raw=true)
</p>

Utilizando também de:

- Orientação a Objetos;
- Strategy + Factory Design Pattern
- PHPUnit
- Execução por linha de comando e pela Web reaproveitando mesmo código

## :rocket: Tecnologias

O desafio foi desenvolvido com as seguintes ferramentas:

- PHP 7.4.16
- Composer 2.0.11
- PHPUnit 9.5.2
- Docker 20.10.2 & Docker Compose 1.28.5


### Com docker e docker-compose manualmente

```bash
# Clone este repositório
$ git clone https://github.com/RonaldoMoraes/flooding-challenge

# Entre na pasta do projeto
$ cd flooding-challenge

# Rode o docker-compose
$ docker-compose -f docker/docker-compose.yml up -d

# Rodando em http://localhost:8008

# Rodando através de comando (aceita um arquivo como parâmetro)
$ docker-compose -f docker/docker-compose.yml run php-fpm bash -c "cd /var/www && php execute.php testcases.txt"
```



### Para executar os testes (phpunit)

```bash
# Clone este repositório
$ git clone https://github.com/RonaldoMoraes/flooding-challenge

# Entre na pasta do projeto
$ cd flooding-challenge

# Rode o docker-compose
$ docker-compose -f docker/docker-compose.yml up -d

# Roda os testes
$ docker-compose -f docker/docker-compose.yml run php-fpm bash -c "cd /var/www && ./vendor/bin/phpunit tests"

# Hospital System

## Sobre o projeto

Projeto de um site de gerenciamento de uma rede de hospitais. Possui 3 módulos: Administradores, Médicos e Pacientes, além de um sistema de ecommerce. 
Cada módulo possui sua respectiva regra de négocio e sistemas baseados na necessidade de cada usuário. Possui também um pequeno sistema de rede social chamado Health+,
cujo objetivo principal é conectar os médicos presentes na rede hosptialar com os pacientes, e aproximar mais os administradores de ambos usuários afim de que eles
entendam as necessidades e problemas de ambos. 



[![Badge](https://img.shields.io/static/v1?label=LICENSA&message=MIT&color=blueviolet&link=https://github.com/vitoriamatos/Hospital-System/blob/master/LICENSE)](https://github.com/vitoriamatos/Hospital-System/blob/master/LICENSE)

<h4 align="center"> 
	🚧  Status do projeto: 🛠 Em desenvolvimento...  🚧
</h4>


## Tabela de conteúdos

<!--ts-->
   * [Sobre](#sobre-o-projeto)
   * [Tabela de Conteudo](#tabela-de-conteudo)
   * [Pré Requisitos](#pré-requisitos)
   * [Versões](#versões)
   * [Instalação](#instalação)
   * [Padrão de projeto](#testes)
   * [Como usar cada módulo](#como-usar)
      * [Administradores](#pre-requisitos)
      * [Médicos](#local-files)
      * [Pacientes](#remote-files)
      * [E-commerce](#multiple-files)
      * [Combo](#combo)
   * [Tecnologias](#tecnologias)
<!--te-->

## Pré Requisitos

  - Instalar o pacote do XAMPP
  - Instalar o composer
  - Instalar o npm e node
  
## Versões
      XAMPP Version: 7.4.21
      Composer version 2.1.3 2021-06-09 16:31:20
      npm 6.14.13
      node v14.17.3

## Instalação

Se você já possui todos os pré requisitos listados, pode clonar este repositório para sua pasta local, em qualquer parte do seu computador, 
não é necessário que seja no htdocs do xamp, pois iremos configurar uma porta para o servidor local.

Feito isso, você deve abrir o diretório do projeto pelo terminal ir até o diretório "public"  para configurar a porta, seguindo os seguintes comandos

      - cd public
      - php -S localhost:8080

Dessa forma estara configuada a porta que será usada pelo servidor local. Após isso basta apenas digitar: localhost:8080 em seu navegador e o projeto já será aberto. 
 
 ## Padrão de Projeto
 
 Foi utilizado o padrão de arquitetura MVC, bem como os conceitos de POO. Além disso, também foi utilizado o trello para um melhor controle das atividades a serem feitas 
 e das já realizadas. 
 
 obs.: posteriormente será anexado os arquivos do modelo de uml do projeto 
 
 
 ## Como usar cada módulo
 
 - Administradores
 
 Os administradores possuem a função de criar novos usuários e monitorar todo o sistema. Ele  aprova as solicitações vindas do ecommerce, e cria novos pacientes. 
 Pode criar novos médicos e administradores. Pode também verificar os status do sistema de urgencia, através de paineis e gráficos que funcionam como contadores.
 
 - Médicos 
 
 Os médicos podem abrir o relatório de urgencia e emergencia e realizar o atendimento do paciente. Podem editar suas próprias informações e buscar por pacientes na urgencia.
 
 - Pacientes
 
 Os pacientes podem solicitar agendamento de exames, verificar seu histórico hospitalar e editar suas informações. 
 
 - Ecommerce
 
  Faz a venda de algum pacote de plano, e da inicio a criação de um usuário. 
 
 
  

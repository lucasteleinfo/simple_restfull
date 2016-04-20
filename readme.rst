###################
Sistema RESTfull
###################

E ae Galera blza? Esse sistema é um exemplo de como será o nosso sistema de academias. Vamos lá:

Assim que clonarem o repositório, entrem na pasta api/ e executem o comando:

composer install

Logo após executar o comando abrem o arquivo api/application/config/config.php e editem a seguinte linha:

$config['base_url'] = '';

para essa

$config['base_url'] = 'http//localhost/caminho_da_aplicacao/api/';

Depois abrem o arquivo api/application/config/database.php e informem o acesso ao banco de dados:

'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'api',

Blza.. o WebService está pronto, agora vamos criar nossa base de dados:

No banco de dados MySQL

Inicio Script

CREATE DATABASE api;

USE api;

CREATE TABLE tb_adm_users (
  ad_use_id int NOT NULL AUTO_INCREMENT,
  ad_use_name varchar(45) DEFAULT NULL,
  ad_use_email varchar(45) DEFAULT NULL,
  ad_use_pass varchar(100) DEFAULT NULL,
  ad_use_dcre datetime DEFAULT NULL,
  ad_use_dup datetime DEFAULT NULL,
  PRIMARY KEY (ad_use_id)
);

CREATE TABLE tb_adm_posts (
  ad_pos_id int NOT NULL AUTO_INCREMENT,
  ad_pos_des varchar(45) DEFAULT NULL,
  ad_pos_inf text,
  ad_pos_iduser int DEFAULT NULL,
  ad_pos_dcre datetime DEFAULT NULL,
  ad_pos_dup datetime DEFAULT NULL,
  PRIMARY KEY (ad_pos_id)
);

Fim Script


Banco de Dados criado vamos testar o web service:

No browser acesse: http://localhost/caminho_do_sistema/api/

Tem que parecer uma menssagem assim "API de Exemplo!"

blza! a configuração do webservice esta completa.

Agora vamos para configurar o front-end:

Acesse a pasta app/ e execute o comando:

bower install

Logo após terminar de instalar as dependecias acesse o arquivo app/app/config/constants.js e alterem a linha:

'URL_API':''

para:

'URL_API':'http://localhost/caminho_do_sistema/api/'

Blza.. Agora no browser acesse: http://localhost/caminho_do_sistema/app/

Crie um usuário e realize o login... Crie um post.. Altere e o delete e depois saia do sistema...

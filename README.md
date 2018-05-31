Site Trav3lling feito na estrutura MVC utilizando a linguagem de programação PHP. 


Primeiro baixe o arquivo .sql e faça o upload em seu phpmyadmin, depois você deve acessar o arquivo config.php e setar as informações do seu banco de dados.

Dentro do arquivo environment.php você escolhe se você está em produção ou em modo de teste developer (Dentro do arquivo config.php você pode informar as duas opções).

A pasta vendor será utilizada para arquivos de terceiros como composer. 

No App encontra-se os prinpais arquivos da aplicação separado na estrutura MVC.


PASTA CONTROLLERS

Classes que fazem o controle da aplicação. É como se fossem uma cola entre os modelos e as views. É geralmente nos controllers que a aplicação verifica se é um GET,POST, etc e toma as decisões sobre qual View mostrar, como processar os dados, etc.

accountController.php -> Tudo que for sobre a page account vai ser definido aqui!	

ajaxController.php	-> Todas as requisições ajax passa por aqui, está incluso o upload de imagens da page account/edit

chatController.php	-> Ignore

donateController.php -> Tudo que for sobre a page donate vai ser definido aqui!	

errorController.php	-> Página de erro 404

homeController.php -> Tudo que for sobre a page home vai ser definido aqui!

inboxController.php	-> Aqui fica incluso as regras do chat.

index.php -> Arquivo padrão que redireciona para a raiz do projeto deixando o projeto mais seguro.	

loginController.php	-> Tudo que for sobre a page login vai ser definido aqui!	

ordersController.php -> Todas as propostas enviadas pelos freelancers irão aparecer aqui.	

profileController.php -> Aqui nós definimos as informações do usuário, Foto de perfil, Bio, Habilidades...

registerController.php -> Tudo que for sobre a page register vai ser definido aqui!

searchController.php -> Toda estrutura de pesquisa vem daqui.

yourSubscribesController.php -> Quando for aceito a proposta do freelancer aparece aqui.

PASTA LIB 

Aqui terá os arquivos auxiliares da aplicação.

PASTA MODELS

Classes relacionadas a banco de dados e regras de negócio 


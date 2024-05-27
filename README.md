
### Bem-vindos a Systemar!

Olá, se vocês chegaram aqui é por que concluíram a fase de estudos e então chegou o momento de enfim aplicar os conhecimentos absorvidos até aqui.

Neste arquivo você encontrará todos os requisitos e funcionalidades necessárias para o desenvolvimento do projeto AspirasProject. Conforme o treinamento, para este projeto será utilizado Ember.Js no Front-End e LaravelPHP no Back-End para fazer a API REST.

Neste projeto você terá autonomia para decidir qual framework css que usara para montar os layouts (Bootstrap, MaterialDesign (Materialize, Material UI), Tailwind, Semantic UI, Bulma, UiKit, Miligram). 

Independente do framework usado, lembre-se que a beleza e a responsividade do layout do projeto aqui é importante tambem.

Leia este documento até o final com muita atenção antes de iniciar o desenvolvimento.

# 1. Criar Formulário de Login (Autenticação)

Criar um Formulário para realizar a autenticação de usuario e realizar o login no sistema, solicitar o login e a senha do usuário.

A rota deverá ter o path como "/signin", ao entrar no site está rota deverá ser exibida, para realizar a autenticação no ember, utilize os addons ember-simple-auth e ember-simple-auth-token.

No laravel utilizer o addon nativo "Laravel JWT Authentication" and "php-open-source-saver/jwt-auth" [Exemplo 1](https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/), [Exemplo 2](https://blog.logrocket.com/implementing-jwt-authentication-laravel-9/)

- Login (E-Mail)
- Senha

# 2. Criar um Formulário Registro de Usuário

Criar um Formulário para realizar a criação do usuário, segue abaixo os detalhes da atividade:

A rota deverá ter o path como "/signup"

#### Campos Model User
- E-Mail (Este será utilizado para fazer o login)
- Nome
- Data de Nascimento
- Endereço
- Bairro
- Cidade
- Estado
- País
- Senha (Utilizar alguma tecnica de encrypt/decrypt para salvar no banco de dados)
- Confirmação de Senha (Não será gravado no banco de dados, apenas para validação)

#### Validações
- E-Mail 
	- NotNull.
	- UNIQUE.
	- MaxLength 255.
	- Não poderá repetir o e-mail na base de dados.
- Nome 
	- NotNull.
 	- MaxLength 255.
- Data de Nascimento 
	- NotNull.
- Endereço
	- MaxLength 255.
- Cidade 
	- MaxLength 255.
- Estado
	- MaxLength 255.
- Pais
	- MaxLength 255.
- Senha 
	- NotNull.
	- MinLength 8.
	- MaxLength 255.
	- Mínimo uma letra.
	- Mínimo um número.
	- Mínimo um Símbolo.
- Confirmação de Senha (Este campo não será gravado no banco de dados)
	- MinLength 8. 
	- Mínimo uma letra.
	- Mínimo um numero.
	- Mínimo um Símbolo.
	- Se está igual ao campo senha.

# 3. Criar uma Rota Autenticada e criar uma barra de navegação com um botão de Logout.

Apos a realização do login, você devera fazer a transição para a rota autenticada que será criada nesta fase.

A rota autenticada devera ter o path como "/".

Alem disso, você deverá realizar a implementação de uma barra de navegação (NavigationBar), nesta barra de navegação deverá ter um botão para realizar o logout, alinhado a direita.

Após esta fase, todas as novas rotas implementadas deverão ser acessadas somente se o usuario estiver autenticado, no caso elas deverão ser rotas filhas da rota Autenticada.

# 4. Criar uma rota '/todolist' e adicionar atalho na barra de navegação.

Nesta fase você deverá criar uma rota 'todolist', ela será responsavel por exibir as 'To-Do List' (Lista de Tarefas) cadastradas no banco de dados, porem isso sera realizado somente nas próximas fases.

Por enquanto, nesta rota terá apenas um botão, que será responsavel para redirecionar para a rota de criação das 'To-Do List' "/todolist/new".

# 5. Criar uma Rota para Criação das To-Do-List "/todolist/new".

Nesta fase voce deverá implementar um formulário para criação das listas de tarefas, está rota será acessada via botão na rota "/todolist". 

#### Campos Model TodoList

- Nome.
- Usuario (Relacionamento com Model Usuario, que seria o dono da lista).
- Data de Previsão de Termino.
- Tarefas (Relacionamento com Model TodoItem, seriam as tarefas da lista de tarefas).

#### Campos Model TodoItem

- Descrição.
- Prioridade.
- Realizado

#### Validações

- Nome 
	- NotNull.
 	- MaxLength 255.
- Usuario
	- NotNull.
- Tarefas
	- NotNull
 	- MinLength 1.

- Descrição 
	- NotNull.
 	- MaxLength 255.
- Prioridade.
	- NotNull
	- MaxValue 3 - (high)
	- MinValue 0 - (low)


# 6. Adicionar Visualização das Listas, Edição da Descrição da Tarefa, Prioridade da Tarefa e Exclusão de Tarefa.

Na rota "/todolist" criar a visualização das Listas de Tarefas do usuário, apos criar a visualização, adicionar opção para Editar a Descrição da Tarefa, Prioridade, e tambem a possibilidade de excluir uma Tarefa de uma Lista.

Estar atento as Validações dos Campo, para não permitir na edição deixar algum valor inválido.

# 7. Criar uma Rota de Edição de Dados do Usuário "/users/id/edit.

Remover Botão de Logout, e adicionar um botão para abrir as opções do perfil do usuario, ao clicar no botão deverá aparecer um Menu DropDown com as seguintes opções: "Editar Perfil" e "Logout".

Ao clicar em editar perfil, redirecionar para a rota de edição de perfil, ao clicar em logout realizar a desautenticação do usuario no sistema.

# 8. Criar uma Rota '/dailycontrol' e Adicionar um atalho para está rota na Navigation Bar

Chegou de fato o momento do grande desafio de vocês. Nesta fase vocês deverão implementar um sistema de controle de horarios nesta rota.

Nesta rota deverá ter uma navegação por mês, ao entrar nesta rota sempre exibir o mês atual e os horarios de trabalho já registrados.

Primeiramente vocês deverão implementar a parte das configurações, nesta rota incluir um botão configurações, onde deverá abrir os campos de configurações para editar se ja houver configurações, se não houver incluir uma nova.


#### Campos Necessários Model de Configuração 

- Carga Horaria Segunda.
- Carga Horaria Terça.
- Carga Horaria Quarta.
- Carga Horaria Quinta.
- Carga Horaria Sexta.
- Carga Horaria Sabado.
- Carga Horaria Domingo.
- Carga Horaria Feriados.
- Feriados (Model Feriado) (podem existir varios feriados)


#### Campos Necessarios Model Feriado

- Data
- Descrição
- ConfiguraçãoId 

#### Validações Configuração
- Usuário 
	- NotNull

#### Validações Feriado

- Data 
	- NotNull.
- Descrição
	- NotNull.
	- MaxLength 255.
- ConfiguraçãoId
	- NotNull.
	- MaxLength 255.


Apos criar a inclusão/edição das configurações, chegou o grande desafio implementar um sistema de controle de horarios.


Primeiramente vocês deverão adicionar um botão "Incluir Carga Horária", ao apertar este botão, deverá ser permitido incluir a carga horaria para um dia especifico, sempre deverá ser sugerido o dia atual, sendo permitido o usuario alterar para o dia desejado, se ja houver carga horaria registrada para aquele dia, permitir a edição, se não existir, permitir a inserção da carga horaria.

#### Campos Necessarios Model Feriado

- Data (dia da carga horaria)
- Horario de Entrada 1
- Horario de Saida 1
- Horario de Entrada 2
- Horario de Saida 2

#### Validações

- Data (dia da carga horaria) 
	- NotNull
- Não permitir inserir carga horaria para um dia que estiver registrado como Feriado.
- Horario de Saida > Horario de Entrada 

Apos realizar a criação da inserção da Carga Horaria, vamos partir para a exibição e calculos, utilizar a planilha de exemplo como referencia para calculos e ideias de exibição.

Ao entrar na rota /dailycontrol, deverá exibir o mes atual, e seus dias organizados em linha (Lembrem-se o Layout bonito e responsivo IMPORTA MUITO. [Exemplo](https://docs.google.com/spreadsheets/d/1PiYIYNJMjbM1MlXSLhoo3Pw8ImpU7crnFpWwY4K9l7c/edit?usp=sharing)

#### Dados que deverão ser exibidos para todos os Meses

- Exibir todos os dias do Mês selecionado (ao entrar na rota, trazer sempre o mês atual)
- Dia da Semana referente ao Dia (Exemplo: Segunda, Terça, Quarta, etc...) 
- Horario Entrada 1 (por dia)
- Horario Saida 1 (por dia)
- Horario Entrada 2 (por dia)
- Horario Saída 2 (por dia)
- Total de Horas Trabalhadas (por dia)
- Total de Horas Devido (por dia)
- Total de Horas Extra (por dia)
- Total de horas Trabalhadas (por mês)
- Total de Horas Devido (por mês)
- Total de Horas Extra (por mês)
- Quando houver um feriado registrado para um dia, não contabilizar este dia para o calculo.
- Contabilizar para o calculo apenas os dias que houverem carga horaria configurada


# 9. Lembretes

- O Layout é muito importante neste momento, a partir de agora a design do layout, a responsividade, cores e estilos de fonte importam agora, então caprichem!
- Agora é o momento de vocês aplicarem todo conhecimento adquirido nesses dias de cursos e treinamentos, juntamente com as habilidades que ja possuiam antes de entrar na Systemar, trabalhem para obter o melhor resultado utilizando Ember.js no Front-End e o Back-end API Rest com Laravel.
- Não é só o layout que importa, o codigo das aplicações, atenção em produzir um codigo legivel, reutilizavel e de boa qualidade, atenção na utilização repetições do mesmo codigo nas diferentes aplicações, faça somente quando for realmente necessario em ultimo caso, pois não é uma prática de qualidade.
- Utilizar Ember-moment para o controle de datas no Ember. [Link](https://github.com/adopted-ember-addons/ember-moment)
- Utilizar Ember-simple-auth para gerenciar autenticação no Ember. [Link](https://github.com/mainmatter/ember-simple-auth)
- Este projeto deverá ser desenvolvido individualmente, então, vocês deverão criar uma branch com o nome de vocês, e todo trabalho será comitado nesta branch, Ao final as aplicações serão avaliadas.
- Utilizar o "yarn" como gerenciador de pacotes ao inves de NPM (Utilizar somente o yarn, pois utilizamos em nossos projetos).
- Se estiverem com duvidas quanto ao Calculo de Horas do Ponto, na raiz dos projetos existem um arquivo chamado "Ponto Maio.xlsx", é uma planilha de calculo de ponto onde vocês podem utiliza-la para entender como funcionar o calculo.
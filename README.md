# TesteCRUDApi
Teste de emprego feito para Zarb Solution

## O desafio

**TABELAS NECESSÁRIAS:**

**usuarios**

- id
- nome
- cpf
- email
- senha
- created_at
- updated_at

**produtos**

- id
- nome
- preco

**produtos_usuarios**

- id_produto
- id_usuario

===============
**ATIVIDADE**

Dados as tabelas acima faça ( PHP puro  - sem framework) :
1- Criar as tabelas e fazer um CRUD de usuários. Pode usar bootstrap ou similar
2- Inserir registros nas tabelas produtos e produtos_usuarios de forma que facilite o teste.
3- Api: Criar endpoint que recebe um username e password e valida se há algum usuário com cpf ou email que esteja de acordo com o username. Se válido, retornar dados do usuário..
4- Api: Criar endpoint que recebe um id de usuário e retorna os dados dos mesmo juntamente com os produtos que ele possui


## Como Rodar o projeto
1-Inicie o servidor PHP
2-Baixe os arquivos desse repositório
3-Importe o SQL testecrudapi.sql que está no diretório raiz
4-Configure o arquivo .env fazendo uma cópia do .env-example
5-Acesse a URL do projeto no seu computador

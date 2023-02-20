<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="<?= URL_ABSOLUTE; ?>/app/public/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="row">
                <div class="col-sm-2">
                    <h2>Clientes</h2>
                </div>
                <div class="col-sm-10 text-right h2">
                    <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Cliente</a>
                </div>
            </div>
        </header>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia adipisci culpa aliquam esse tempore consequatur cum architecto ipsam nobis necessitatibus, neque at expedita officiis quasi sequi eveniet dignissimos quas voluptas?
        </div>
        <hr>
        <table class="table table-hover" id="listUsers">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Senha</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <!-- dinamic content -->
            </tbody>
        </table>
    </div>

    <script src="<?= URL_ABSOLUTE; ?>/app/public/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= URL_ABSOLUTE; ?>/app/public/js/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
    <script>
        const urlListUsers = `<?= URL_ABSOLUTE; ?>usuarios`;
        const urlDeleteUser = `<?= URL_ABSOLUTE; ?>usuario/excluir`;

        const loadUsers = (url) => {
            let nameTable = "#listUsers";
            $.ajax({
                url: url,
                dataType: 'json',
                beforeSend: function() {
                    $(nameTable + " tbody tr").remove();
                    let contentRow = `
                            <tr>
                                <td colspan="6" align="center">
                                    <img src="https://media.tenor.com/64UaxgnTfx0AAAAC/memes-loading.gif" alt="loading">
                                </td>
                            </tr>`;
                    $(nameTable + " tbody").append(contentRow);
                },
                success: function(data) {
                    $(nameTable + " tbody tr").remove();
                    if (!data.data) {
                        let contentRow = `
                            <tr>
                                <td colspan="6" align="center">
                                    <h1>Nenhum usuário registrado. Clique em Novo usuário, para adicionar o primeiro.</h1>
                                </td>
                            </tr>`;
                        $(nameTable + " tbody").append(contentRow);
                    } else {
                        Object.values(data.data).forEach((value) => {
                            let contentRow = `
                                    <tr 
                                        id="user_${value.id}"
                                    >
                                        <td>${value.id}</td>
                                        <td>${value.nome}</td>
                                        <td>${value.cpf}</td>
                                        <td>${value.email}</td>
                                        <td>${value.senha}</td>
                                        <td class="actions text-right">
                                            <a href="edit.php?id=" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="">
                                                <i class="fa fa-trash"></i> Excluir
                                            </a>
                                        </td>
                                    </tr>`;
                            $(nameTable + " tbody").append(contentRow);
                        });
                    }
                },
                error: function(data) {
                    $(nameTable + " tbody tr").remove();
                    let contentRow = `
                            <tr>
                                <td colspan="6" align="center">
                                    ${data.responseJSON.message}
                                </td>
                            </tr>`;
                    $(nameTable + " tbody").append(contentRow);
                }
            });
        }

        const deleteUser = (url, id) => {
            $.ajax({
                url: url,
                dataType: 'json',
                beforeSend: function() {
                    $(nameTable + " tbody tr").remove();
                    let contentRow = `
                            <tr>
                                <td colspan="6" align="center">
                                    <img src="https://media.tenor.com/64UaxgnTfx0AAAAC/memes-loading.gif" alt="loading">
                                </td>
                            </tr>`;
                    $(nameTable + " tbody").append(contentRow);
                },
                success: function(data) {
                    $(nameTable + " tbody tr").remove();
                    Object.values(data.data).forEach((value) => {
                        let contentRow = `
                                <tr 
                                    id="user_${value.id}"
                                >
                                    <td>${value.id}</td>
                                    <td>${value.nome}</td>
                                    <td>${value.cpf}</td>
                                    <td>${value.email}</td>
                                    <td>${value.senha}</td>
                                    <td class="actions text-right">
                                        <a href="edit.php?id=" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="">
                                            <i class="fa fa-trash"></i> Excluir
                                        </a>
                                    </td>
                                </tr>`;
                        $(nameTable + " tbody").append(contentRow);
                    });
                },
                error: function(data) {
                    $(nameTable + " tbody tr").remove();
                    let contentRow = `
                            <tr>
                                <td colspan="6" align="center">
                                    ${data.responseJSON.message}
                                </td>
                            </tr>`;
                    $(nameTable + " tbody").append(contentRow);
                }
            });
        }

        $(document).ready(function() {

            // Lista usuários que estão no banco de dados
            loadUsers(urlListUsers);

        });
    </script>
</body>

</html>
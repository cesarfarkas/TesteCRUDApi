<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="<?=URL_ABSOLUTE;?>/app/public/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Clientes</h2>
                </div>
                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Cliente</a>
                    <a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
                </div>
            </div>
        </header>
        <div class="alert alert-alert alert-dismissible" role="alert">
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
                <tr>
                    <td colspan="6" align="center">
                        <img src="https://media.tenor.com/64UaxgnTfx0AAAAC/memes-loading.gif" alt="loading">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script src="<?=URL_ABSOLUTE;?>/app/public/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=URL_ABSOLUTE;?>/app/public/js/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function()
        {
            const listUsuarios = `<?=URL_ABSOLUTE;?>usuarios`
            
            $.get(listUsuarios, function(data){
                
                $("#listUsers tbody tr").remove();

                Object.values(data.data).forEach((value) => {
                    var newRowContent = `
                    <tr>
                        <td>${value.id}</td>
                        <td>${value.nome}</td>
                        <td>${value.cpf}</td>
                        <td>${value.email}</td>
                        <td>${value.senha}</td>
                        <td class="actions text-right">
                            <a href="view.php?id=" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                            <a href="edit.php?id=" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>`;
                    $("#listUsers tbody").append(newRowContent); 
                })
            });
        });
    </script>
</body>

</html>
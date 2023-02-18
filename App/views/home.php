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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="30%">Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Atualizado em</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>tiroles</td>
                    <td>tiroles</td>
                    <td>tiroles</td>
                    <td>00 0000-0000</td>
                    <td>00/00/0000</td>
                    <td class="actions text-right">
                        <a href="view.php?id=" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="">
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script src="<?=URL_ABSOLUTE;?>/app/public/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
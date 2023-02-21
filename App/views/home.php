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
        <!-- Modal -->
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" aria-label="Close" onclick="$('#alertModal').modal('hide')"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="btnCancel" data-dismiss="modal">Close</button>
                        <button type="button" class="btn" id="btnConfirm"  data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
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
        const loadUsers = () => {
            let nameTable = "#listUsers";
            let urlListUsers = `<?= URL_ABSOLUTE; ?>usuarios`;
            $.ajax({
                url: urlListUsers,
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
                                            <a 
                                                href="#" 
                                                class="btn btn-sm btn-danger" 
                                                data-toggle="modal" 
                                                data-target="#delete-modal" 
                                                onclick="deleteUser.confirmDelete(${value.id})
                                            ">
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

        const deleteUser = {
            confirmDelete(id) {
                
                $('#alertModal').modal('show');
                
                let modal = $('#alertModal');
                let nameUser = document.querySelectorAll(`#user_${id} td`)[1].innerText;
                let btnCancel = modal.find('#btnCancel');
                let btnConfirm = modal.find('#btnConfirm');

                modal.find('.modal-title').html('Excluir usuário');
                modal.find('.modal-body').html(`Você quer excluir o usuário?<br>
                                                [id: <b>${id}</b>] <b>${nameUser}</b>`);
                
                btnCancel.show();
                btnCancel.text('Cancelar').addClass('btn-secondary');
                btnCancel.off().on('click',(e)=>{
                    e.preventDefault();
                    modal.modal('hide');
                });
                
                btnConfirm.show();
                btnConfirm.text('Excluir').addClass('btn-danger');
                btnConfirm.off().on('click',(e)=>{
                    e.preventDefault();
                    this.delete(id);
                });
            },
            delete(id) {
                let urlDeleteUser = `<?= URL_ABSOLUTE; ?>usuario/excluir`;
                $.ajax({
                    url: urlDeleteUser,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        "id": id
                    },
                    beforeSend: function() {
                        let modal = $('#alertModal');
                        modal.find('.modal-body').html(`<img src="https://media.tenor.com/64UaxgnTfx0AAAAC/memes-loading.gif" alt="loading" width="80%" style="margin: 0px auto; display: block;">`);
                    },
                    success: function(data) {
                        let modal = $('#alertModal');
                        let btnCancel = modal.find('#btnCancel');
                        let btnConfirm = modal.find('#btnConfirm');
                        modal.find('.modal-body').html(`${data.message}`);
                        btnCancel.hide();
                        btnConfirm.hide();
                        $(`#user_${id}`).remove().fadeOut();
                    },
                    error: function(data) {
                        let modal = $('#alertModal');
                        let btnCancel = modal.find('#btnCancel');
                        let btnConfirm = modal.find('#btnConfirm');
                        modal.find('.modal-body').html(`${data.responseJSON.message}`);
                        btnCancel.hide();
                        btnConfirm.hide();
                    }
                });
            }
        }

        $(document).ready(function() {

            // Lista usuários que estão no banco de dados
            loadUsers();

        });
    </script>
</body>

</html>
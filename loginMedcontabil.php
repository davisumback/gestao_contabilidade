<form action="/sistema/controllers/login/cliente.php" method="post" autocomplete="off">
    <input name="vinculo" value="MEDCONTABIL" hidden>
    <div class="collapse" id="cliente" data-parent="#collapseLogin">
        <div class="card card-body bg-card-login pt-0">
            <label class="txt-form-login mb-1" for="cpf">CPF</label>
            <input id="cpf" name="cpf" class="form-control input-contato" type="text">
            <label class="txt-form-login mb-1 mt-1" for="">senha</label>
            <input name="senha" class="form-control input-contato" type="password" maxlength="30">
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-login py-0" type="submit">entrar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="/sistema/controllers/login/franqueado.php" method="post" autocomplete="off">
    <div class="collapse" id="franqueado" data-parent="#collapseLogin" style="">
        <div class="card card-body bg-card-login pt-0">
            <label class="txt-form-login mb-1" for="">usuário</label>
            <input name="usuario" class="form-control input-contato" type="text" autocomplete="off">
            <label class="txt-form-login mb-1 mt-1" for="">senha</label>
            <input name="senha" class="form-control input-contato" type="password">
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-login py-0" type="submit">entrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
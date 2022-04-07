<div class="alert alert-light text-center pt-4 pb-4" role="alert">
    <strong class="text-secondary">{{tituloOs}}</strong>
</div>

<form action="ordem-servico.php?method=index" class="needs-validation-loading" method="post" novalidate {{filtros}}>
    <div class="row">
        <div class="col-md-3 col-sm-12 mx-auto">
            <div class="form-group text-center">
                <label class="text-secondary" for="tipoOs"><strong>Tipo Os</strong></label>
                <select class="form-control" name="tipoOs" id="tipoOs" required="true">
                    <option value="all">Todos</option>
                    {{tiposOs}}
                </select>
                <div class="invalid-feedback">
                    Obrigatório*
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 mx-auto">
            <div class="form-group text-center">
                <label class="text-secondary" for="tipoOs"><strong>Status</strong></label>
                <select class="form-control" name="status" id="tipoOs" required>
                    <option value="all">Todos</option>
                    <option value="PENDENTES">Pendentes</option>
                    <option value="FINALIZADAS">Finalizadas</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório*
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 mx-auto">
            <div class="form-group text-center">
                <label class="text-secondary" for="tipoOs"><strong>Período</strong></label>
                <select class="form-control" name="periodo" id="tipoOs" required>
                    <option value="30">Últimos 30 dias</option>
                    <option value="60">Últimos 60 dias</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-12 mb-3">
            <button class="btn btn-padrao btn-success">Pesquisar</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12 text-center">
        {{botaoNovaOs}}
    </div>    
</div>

<div class="row">

    {{todasOs}}
    
</div>
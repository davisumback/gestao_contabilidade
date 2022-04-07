<div class="modal fade bd-example-modal-lg" id="modalEditarSocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
   aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header bg-cor-primaria">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Sócio</h5>
         </div>
         <form class="" action="" method="post">

            <div class="modal-body">
               <div class="row">
                  <div class="col text-center mb-3">
                     <h4>Enviar Novos Dados do Sócio</h4>
                  </div>
               </div>
               <hr>
               <div class="row mt-3">
                  <div class="col-md-5">
                     <label for=""><strong>RG do sócio</strong></label>
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <!-- <div><input type="file" id="file-input" name="file-input" class="form-control"></div> -->
                           <label class="custom-file-label procurar-arquivo"></label>
                           <input type="file" class="custom-file-input form-control-file" name="file-input" id="file-input">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <label for=""><strong>CPF do sócio</strong></label>
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="inputGroupFile02">
                           <label class="custom-file-label procurar-arquivo" for="inputGroupFile02">Selecionar
                              arquivo</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-md-5">
                     <label for=""><strong>CNH do sócio</strong></label>
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="inputGroupFile03">
                           <label class="custom-file-label procurar-arquivo" for="inputGroupFile03">Selecionar
                              arquivo</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <label for=""><strong>Passaporte do sócio</strong></label>
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="inputGroupFile04">
                           <label class="custom-file-label procurar-arquivo" for="inputGroupFile04">Selecionar
                              arquivo</label>
                        </div>
                     </div>
                  </div>
               </div>
               <hr>
               <div class="row">
                  <div class="col">
                     <div class="card texto-padrao bg-light mb-3 rounded border-cor-accent-primaria">
                        <div class="card-header bg-cor-accent-primaria text-white text-center">
                           <b>Distribua as Quotas</b>
                        </div>
                        <div class="card-body">
                           <div class="row my-2">
                              <div class="col-md-6">
                                 <label for=""><strong>Será sócio adminstrador?</strong></label><br>
                                 <div class="btn-grou btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-cor-accent-secundaria btn-padrao">
                                       <input type="radio" name="options" id="option1" autocomplete="off">Sim
                                    </label>
                                    <label class="btn btn-cor-accent-secundaria btn-padrao">
                                       <input type="radio" name="options" id="option2" autocomplete="off">Não
                                    </label>
                                 </div>
                              </div>
                              <div class="col-md-6 my-1">
                                 <label for=""><strong>Quantidade de Quotas</strong></label>
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                    <input type="text" class="form-control col-3" id="porcentagem-socio" aria-label="Username"
                                       aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                           <hr>
                           <div class="row my-2">
                              <div class="col text-center">
                                 <h4><strong>Situação dos Sócios</strong></h4>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-md-4 my-1 text-center">
                                 <h6>Davi Sumback</h6>
                              </div>
                              <div class="col-md-4 my-2 text-center">
                                 <h6>Administrador</h6>
                              </div>
                              <div class="col-sm-4 col-md-4 my-1">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Quotas</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                       <span class="input-group-text">%</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-md-4 my-1 text-center">
                                 <h6>Luiz Carlos</h6>
                              </div>
                              <div class="col-md-4 my-2 text-center">
                                 <h6>Sócio</h6>
                              </div>
                              <div class="col-sm-4 col-md-4 my-1">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Quotas</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                       <span class="input-group-text">%</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-md-4 my-1 text-center">
                                 <h6>Carlos Eduardo</h6>
                              </div>
                              <div class="col-md-4 my-2 text-center">
                                 <h6>Sócio</h6>
                              </div>
                              <div class="col-md-4 my-1">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Quotas</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                       <span class="input-group-text">%</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-primary btn-padrao" data-dismiss="modal">Enviar</button>
               <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal">Fechar</button>
            </div>
         </form>
      </div>
   </div>
</div>
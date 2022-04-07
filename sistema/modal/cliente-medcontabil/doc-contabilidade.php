<div class="modal fade" id="modalDocContabilidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-cor-primaria">
            <h5 class="modal-title" id="exampleModalLabel">Enviar Documentos Contabilidade</h5>
         </div>
         <form action="../controllers/navegador-arquivos/upload-arquivos-teste.php?method=store" class="needs-validation-loading" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
            <div class="modal-body">
               <div class="row">
                  <input name="tipo" id="doc-conta" value="upload-contabilidade" type="text" hidden>                     
                  <input name="empresasId" id="doc-conta" value="<?= $empresaId ?>" type="text" hidden>

                  <div class="col-md-11 autocomplete">
                     <label class="label-cadastro">Enviar Documento</label>
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <input onchange='$("#fileLabelContabilidade").html($(this).val());' type="file" class="custom-file-input" name="fileUpload" required>
                           <label id="fileLabelContabilidade" class="custom-file-label procurar-arquivo" for="edital">Escolha um arquivo</label>
                        </div>
                     </div>                     
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-padrao btn-primary btn-sm"><strong>Enviar</strong></button>
               <button type="button" class="btn btn-padrao btn-secondary btn-sm" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Materia</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Materia:</label>
                    <input type="text" class="form-control" id="mateM">
                    <input type="hidden" class="form-control" id="idMateM">
                    <input type="hidden" class="form-control" id="idSemM">
                </div>
                <div class="form-group">
                    <label for="pwd">PNF:</label>
                    <select name="pnf" id="pnfM" class="form-control">
                        <option selected disabled value="">Seleccione: </option>
                        <option value="1">PNF en Electricidad</option>
                        <option value="2">PNF en Ingeniería de Mantenimiento</option>
                        <option value="3">PNF en Mecánica</option>
                        <option value="4">PNF en Informática</option>
                        <option value="5">PNF en Geociencia</option>
                        <option value="6">PNF en Sistemas de Calidad y Ambiente</option>
                    </select>
                </div>
                <div class="Trayecto form-group">
                    <label for="pwd">Trayecto:</label>
                    <select name="trayecto" id="trayectoM" class="form-control" onchange="setSemestre('#trayectoM','#semestreM')">
                        <option selected disabled value="">Seleccione: </option>
                        <option value="1">Trayecto I</option>
                        <option value="2">Trayecto II</option>
                        <option value="3">Trayecto III</option>
                        <option value="4">Trayecto IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Semestre:</label>
                    <select name="semestre" id="semestreM" class="form-control">
                        <option selected disabled value="">Seleccione: </option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <div class="col-xs-6">
                <button type="button" onclick="closeM('#myModal')" class="btn btn-danger btn-modal closeM">Cerrar</button>
            </div>
            <div class="col-xs-6">
                <button type="button" onclick="modificarM()" id="modificarM" class="btn btn-success btn-modal" >Modificar</button>
            </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Nueva Materia</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Materia:</label>
                    <input type="text" class="form-control" id="mateN">
                </div>
                <div class="form-group">
                <label for="pwd">PNF:</label>
                    <select name="pnf" id="pnfN" class="form-control">
                        <option selected disabled value="">Seleccione: </option>
                        <option value="1">PNF en Electricidad</option>
                        <option value="2">PNF en Ingeniería de Mantenimiento</option>
                        <option value="3">PNF en Mecánica</option>
                        <option value="4">PNF en Informática</option>
                        <option value="5">PNF en Geociencia</option>
                        <option value="6">PNF en Sistemas de Calidad y Ambiente</option>
                    </select>
                </div>
                <div class="Trayecto form-group">
                    <label for="pwd">Trayecto:</label>
                    <select name="trayecto" id="trayectoN" class="form-control" onchange="setSemestre('#trayectoN','#semestreN')">
                        <option selected disabled value="">Seleccione: </option>
                        <option value="1">Trayecto I</option>
                        <option value="2">Trayecto II</option>
                        <option value="3">Trayecto III</option>
                        <option value="4">Trayecto IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Semestre:</label>
                    <select name="semestre" id="semestreN" class="form-control" >
                        <option selected disabled value="">Seleccione: </option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <div class="col-xs-6">
                <button type="button" onclick="closeM('#myModal2')" class="btn btn-danger btn-modal closeN">Cerrar</button>
            </div>
            <div class="col-xs-6">
                <button type="button" onclick="guardarN()" id="guardarN" class="btn btn-success btn-modal" >Guardar</button>
            </div>
            </div>
        </div>
    </div>
</div>

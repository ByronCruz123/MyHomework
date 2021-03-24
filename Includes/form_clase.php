<?php

/**
 * Este archivo contiene dos formularios y devolvera uno según el valor que se le indique en el parametro "accion"
 */
$atributoid = "";


if ($_REQUEST['accion'] == "agregar") {
    $titulomodal = "Crear una clase";
    $nombreboton = "Crear";
    $atributoboton = "guardar_clase";

    $nombreclase = "";
    $seccion = "";
    $materia = "";
    $salon = "";


} elseif ($_REQUEST['accion'] == "editar") {
    $idclase = $_REQUEST['id'];
    $atributoid = $idclase;

    $titulomodal = "Editar la clase";
    $nombreboton = "Guardar";
    $atributoboton = "actualizar_clase";

    $nombreclase = "";
    $seccion = "";
    $materia = "";
    $salon = "";


    include "../Model/conexion.php";

    $query =  mysqli_query($con, "SELECT * FROM clases WHERE id = $idclase");

    $resultados =  mysqli_num_rows($query);

    if ($resultados > 0) {
        $clase = mysqli_fetch_array($query);

        $nombreclase = $clase['nombre'];
        $seccion = $clase['seccion'];
        $materia = $clase['materia'];
        $salon = $clase['salon'];
    }
}

?>



<form id="formularioclase">
    <div class="modal-body">
        <h6 class="modal-title" id="exampleModalLabel"> <?php echo $titulomodal; ?> </h6>
        <div class="form-group pt-3">
            <input type="text" class="form-control" value="<?php echo $nombreclase; ?>" name="nombre" placeholder="Nombre de clase (obligatorio)" required autocomplete="off">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $seccion; ?>" name="seccion" placeholder="Sección" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $materia; ?>" name="materia" placeholder="Materia" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $salon; ?>" name="salon" placeholder="Salón" autocomplete="off">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary class_management_btn" data-id="<?php echo $atributoid; ?>" data-accion="<?php echo $atributoboton; ?>"><?php echo $nombreboton; ?></button>
    </div>
</form>
<?php
    $tipoTienda = 'tiendaLogOut';
    if( isset($_SESSION['idUsuario']) ){
        $tipoTienda = 'tiendaUser';
    }
?>
<aside>
        <div class="categoria">
            <h1>CATEGORIAS</h1>
          <div class="contenedor-todo-cat">
            
            <div class="contenedor-cat--click">
                <label class="titulo"><ion-icon class="flecha-icon" name="chevron-forward-outline"></ion-icon> COMPUTADORAS ARMADAS </label> 
            </div>

                <ul class="contenedor-cat__sub">
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasMarcaPc=intel"><label class="subtitulo" id="intel">INTEL</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasMarcaPc=amd"><label class="subtitulo" id="amd">AMD</label></a>
                    </li>
                </ul>

            <div class="contenedor-cat--click">
                <label class="titulo"><ion-icon class="flecha-icon" name="chevron-forward-outline"></ion-icon> MICROPROCESADORES </label> 
            </div>

                <ul class="contenedor-cat__sub">
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasMarcaMicro=amd"><label class="subtitulo" id="amd">AMD</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasMarcaMicro=intel"><label class="subtitulo" id="intel">INTEL</label></a>
                    </li>
                </ul>

            <div class="contenedor-cat--click">
                <label class="titulo"><ion-icon class="flecha-icon" name="chevron-forward-outline"></ion-icon> MOTHERBOARDS </label> 
            </div>

                <ul class="contenedor-cat__sub">
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasSocketMother=AM4"><label class="subtitulo" id="amd">AM4</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasSocketMother=LGA1200"><label class="subtitulo" id="intel">LGA1200</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasSocketMother=LGA1700"><label class="subtitulo" id="intel">LGA1700</label></a>
                    </li>
                </ul>

            <div class="contenedor-cat--click">
                <label class="titulo"><ion-icon class="flecha-icon" name="chevron-forward-outline"></ion-icon> MEMORIAS RAM </label> 
            </div>

                <ul class="contenedor-cat__sub">
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasRam=4"><label class="subtitulo" id="4gb">4GB</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasRam=8"><label class="subtitulo" id="8gb">8GB</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasRam=16"><label class="subtitulo" id="16gb">16GB</label></a>
                    </li>
                </ul>

            <div class="contenedor-cat--click">
                <label class="titulo"><ion-icon class="flecha-icon" name="chevron-forward-outline"></ion-icon> PLACAS DE VIDEO </label> 
            </div>

                <ul class="contenedor-cat__sub">
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasPlacaVideo=amd"><label class="subtitulo" id="amd">AMD</label></a>
                    </li>
                    <li class="contenedor-cat__sub--2">
                        <a href="<?= $tipoTienda ?>.php?categoriasPlacaVideo=nvidia"><label class="subtitulo" id="nvidia">NVIDIA</label></a>
                    </li>

          </div>    
        </div>
    </aside>
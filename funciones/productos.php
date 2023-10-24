<?php

    #CRUD computadoras

    // function listarPC()
    // {
    //     try {
    //         // Llamamos a la conexion PDO
    //         $conexion = conectarPDO();
    //         // Consulta SQL
    //         $sql = "SELECT * FROM pc_venta pv
    //                 INNER JOIN marca m ON pv.idMarca = m.idMarca";
    
    //         // Preparar y ejecutar la consulta
    //         $stmt = $conexion->prepare($sql);
    //         $stmt = $conexion->query($sql);
    
    //         // Obtener los resultados como un array asociativo
    //         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //         return $resultado;
    //     } catch (PDOException $e) {
    //         // Manejar errores de conexión o consulta
    //         echo "Error: " . $e->getMessage();
    //         return false;
    //     }
    // }
    
    function totalRegistrosProductos() : int
    {
      $link = conectar();

      $sql = "SELECT * FROM productos";
      $consulta = mysqli_query($link,$sql);
      $resultado = mysqli_num_rows($consulta);
      return $resultado;
    }

    function listarProductos()
    {
        //Paginacion
        $total_registros = totalRegistrosProductos();
        $registros_por_pagina = 6;
        $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
        $primer_registro = ($pagina_actual-1) * $registros_por_pagina;   

        $link = conectar();
        $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, stockPrd, descPrd, nucleosMicro, hilosMicro, socketMicro, frecuenciaBaseMicro, frecuenciaMaxMicro, cacheL1Micro, cacheL2Micro, cacheL3Micro,
                  graficosIntegrados, modeloGraficosIntegradosMicro, cooler, tdpMicro, tempMaximaMicro, litografiaMicro, img1, img2, img3, img4 FROM productos p
                    INNER JOIN categoria c ON p.idCategoria = c.idCategoria
                      INNER JOIN marca m ON p.idMarca = m.idMarca
                        LIMIT $registros_por_pagina OFFSET $primer_registro";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function verPrdPorId( int $idPrd )
    {
        $link = conectar();

        if($_GET['idCategoria'] == 1){
          $camposSQL = 'nucleosMicro, hilosMicro, socketMicro, frecuenciaBaseMicro, frecuenciaMaxMicro, cacheL1Micro, cacheL2Micro, cacheL3Micro,
                        graficosIntegrados, modeloGraficosIntegradosMicro, cooler, tdpMicro, tempMaximaMicro, litografiaMicro,';
        }
        if($_GET['idCategoria'] == 2){
          $camposSQL = 'socketMother, chipsetMother, factorFormaMother, slotsRamMother, cantMaxRamMother, velocidadMaxRamMother, cantCanalesRamMother, slotsExpasionMother, cantSataMother, interfazm2Mother,
          cantPuertosM2Mother, lanMother, wifiMother, bluetoothMother, chipsetAudioMother, puertosUsb20Mother, puertosUsb30Mother, cantDisplayPortMother, cantHdmiMother,
          cantVgaMother, flashBiosButtonMother,';
        }if($_GET['idCategoria'] == 3){
          $camposSQL = 'ddrMemoriaRam, tamanioMemoriaRam, velocidadMemoriaRam, latenciaMemoriaRam, disipadorMemoriaRam, colorMemoriaRam, compatibilidadMemoriaRam,';
        }
        if($_GET['idCategoria'] == 6){
          $camposSQL = 'frecuenciaBasePlacaVideo, frecuenciaMaximaPlacaVideo, tipoPciePlacaVideo, gddrPlacaVideo, tamanioMemoriaPlacaVideo, busPlacaVideo, 
          multiplesPantallasPlacaVideo, numeroFanCoolersPlacaVideo, displayPortPlacaVideo, hdmiPlacaVideo, dviPlacaVideo, anchoPlacaVideo, largoPlacaVideo, pesoPlacaVideo,';
        }

        $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, stockPrd, descPrd, ".$camposSQL." img1, img2, img3, img4 FROM productos p
                    INNER JOIN categoria c ON p.idCategoria = c.idCategoria
                      INNER JOIN marca m ON p.idMarca = m.idMarca
                          WHERE idPrd = ".$idPrd;
                          
        $resultado = mysqli_query( $link,$sql );
        return $resultado; 
    }

    function buscarPc()
    {
      $search = $_GET['search'] ?? '';
      //Paginacion
      $total_registros = totalRegistrosPc();
      $registros_por_pagina = 6;
      $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
      $primer_registro = ($pagina_actual-1) * $registros_por_pagina;   

      $link = conectar();
      $sql = "SELECT * FROM pc_venta pv
                INNER JOIN marca m ON pv.idMarca = m.idMarca
                  WHERE pv.nombrePc LIKE '%".$search."%'
                  LIMIT $registros_por_pagina OFFSET $primer_registro";
      
      $filtroCategoria = '';
      if( isset( $_GET['idCategoria'] ) && $_GET['idCategoria'] != 0 ){
        $filtroCategoria = " AND p.idCategoria = ".$_GET['idCategoria'];
      }

      $filtroMarca = '';
      if( isset( $_GET['idMarca'] ) && $_GET['idMarca'] != 0 ){
        $filtroMarca = " AND p.idMarca = ".$_GET['idMarca'];
      }

      $sql .= $filtroCategoria; //$sql = $sql.$filtroCategoria
      $sql .= $filtroMarca; //$sql = $sql.$filtroMarca
        
      $resultado = mysqli_query( $link,$sql );
      return $resultado;
    }

    function subirImagen() : string
    {
      //si no enviaron un archivo
      $prdImagen = 'sinImagen.png';

      //si no enviaron archivo en modificarProducto()
      if( isset($_POST['imgActual1']) ){
        $prdImagen = $_POST['imgActual1'];
      }

      //si enviaron un archivo
      if( $_FILES['img1']['error'] == 0 ){

        $archivo = $_FILES['img1'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['img1']['tmp_name'];
        $ruta = 'images/';
        
        $extension = pathinfo( $_FILES['img1']['name'], PATHINFO_EXTENSION );
        $prdImagen = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$prdImagen );
      }
      return $prdImagen;
    }

    function subirImagen2() : string
    {
      //si no enviaron un archivo
      $prdImagen = 'sinImagen.png';
      
      //si no enviaron archivo en modificarProducto()
      if( isset($_POST['imgActual2']) ){
        $prdImagen = $_POST['imgActual2'];
      }

      //si enviaron un archivo
      if( $_FILES['img2']['error'] == 0 ){

        $archivo = $_FILES['img2'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['img2']['tmp_name'];
        $ruta = 'images/';
        
        $extension = pathinfo( $_FILES['img2']['name'], PATHINFO_EXTENSION );
        $prdImagen = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$prdImagen );

      }
      return $prdImagen;
    }

    function subirImagen3() : string
    {
      //si no enviaron un archivo
      $prdImagen = 'sinImagen.png';

      //si no enviaron archivo en modificarProducto()
      if( isset($_POST['imgActual3']) ){
        $prdImagen = $_POST['imgActual3'];
      }

      //si enviaron un archivo
      if( $_FILES['img3']['error'] == 0 ){

        $archivo = $_FILES['img3'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['img3']['tmp_name'];
        $ruta = 'images/';
        
        $extension = pathinfo( $_FILES['img3']['name'], PATHINFO_EXTENSION );
        $prdImagen = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$prdImagen );

      }
      return $prdImagen;
    }

    function subirImagen4() : string
    {
      //si no enviaron un archivo
      $prdImagen = 'sinImagen.png';

      //si no enviaron archivo en modificarProducto()
      if( isset($_POST['imgActual4']) ){
        $prdImagen = $_POST['imgActual4'];
      }

      //si enviaron un archivo
      if( $_FILES['img4']['error'] == 0 ){

        $archivo = $_FILES['img4'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['img4']['tmp_name'];
        $ruta = 'images/';
        
        $extension = pathinfo( $_FILES['img4']['name'], PATHINFO_EXTENSION );
        $prdImagen = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$prdImagen );

      }
      return $prdImagen;
    }

    function agregarProducto() : bool
    {
        $link = conectar();  

        $marca = $_SESSION['marcaPc'];
        $monitor = $_SESSION['monitor'];
        $micro = $_SESSION['micro'];
        $mother = $_SESSION['mother'];
        $ram = $_SESSION['ram'];
        $video = $_SESSION['video'];
        $duro = $_SESSION['duro'];
        $solido = $_SESSION['solido'];
        $fuente = $_SESSION['fuente'];
        $gabinete = $_SESSION['gabinete'];

        $nombrePubli = $_SESSION['nombrePubli'] = $_POST['nombrePubli'];
        $precio = $_SESSION['precio'] = $_POST['precio'];
        $stock = $_SESSION['stock'] = $_POST['stock'];
        $descripcion = $_SESSION['descripcion'] = $_POST['descripcion'];

        $img1 = $_SESSION['img1'];
        $img2 = $_SESSION['img2'];
        $img3 = $_SESSION['img3'];
        $img4 = $_SESSION['img4'];

        $sql = "INSERT INTO pc_venta
        ( nombrePc, stockPc, precioPc, estadoPc, descPc, micro, mother, ram, video, hdd, ssd, fuente, gabinete, monitor, 
        img1, img2, img3, img4, idMarca )
        VALUES
        ( '$nombrePubli', $stock , $precio,
          1 , '$descripcion', '$micro', '$mother', '$ram',
          '$video', '$duro', '$solido', '$fuente', '$gabinete',
          '$monitor', '$img1',  '$img2', '$img3', '$img4', $marca )";
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }
        catch( EXCEPTION $e ){
            echo $e->getMessage();
            return FALSE;
        }
    }

    function modificarProducto()
    {
      $link = conectar();

      $id = $_POST['idPrd'];
      $marca = $_POST['marcaPc'];
      $monitor = $_POST['monitor'];
      $micro = $_POST['micro'];
      $mother = $_POST['mother'];
      $ram = $_POST['ram'];
      $video = $_POST['video'];
      $duro = $_POST['duro'];
      $solido = $_POST['solido'];
      $fuente = $_POST['fuente'];
      $gabinete = $_POST['gabinete'];

      $nombrePubli = $_POST['nombrePubli'];
      $precio = $_POST['precio'];
      $stock = $_POST['stock'];
      $estado = $_POST['estadoPc'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "UPDATE pc_venta SET nombrePc = '$nombrePubli', stockPc = $stock, precioPc = $precio, estadoPc = $estado, 
      micro = '$micro', mother = '$mother', ram = '$ram', video = '$video', hdd = '$duro', ssd = '$solido', fuente = '$fuente',
      gabinete = '$gabinete', monitor = '$monitor', img1 = '$img1', img2 = '$img2', img3 = '$img3', img4 = '$img4'
        WHERE idPrd = ".$id;

      try{
          $resultado = mysqli_query( $link,$sql );
          return $resultado;
      }
      catch( EXCEPTION $e ){
          echo $e->getMessage();
          return FALSE;
      }
    }

    function eliminarProducto()
    {
      $link = conectar();

      $id = $_GET['id'];

      $sql = "DELETE FROM pc_venta WHERE idPrd = ".$id;

      try{
          $resultado = mysqli_query( $link,$sql );
          return $resultado;
      }
      catch( EXCEPTION $e ){
          echo $e->getMessage();
          return FALSE;
      }
    }

    function maxIdPc()
    {
      $link = conectar();

      $sql = "SELECT MAX(idPrd) FROM pc_venta";
      $consulta = mysqli_query( $link,$sql );
      $resultado = mysqli_fetch_assoc( $consulta );
      $maximo = $resultado['MAX(idPrd)'] - 4; 
      return $maximo;
    }

    function idRandomPc() 
    {
      $link = conectar();

      $sql = "SELECT idPrd, nombrePc, stockPc, precioPc, img1 FROM pc_venta
                LIMIT 4 OFFSET ".rand(1,maxIdPc());
      $resultado = mysqli_query( $link,$sql );
      return $resultado;
    }
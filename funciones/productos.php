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
        $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, stockPrd, descPrd, img1 FROM productos p
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
        if($_GET['idCategoria'] == 4){
          $camposSQL = 'factorFormaDiscoDuro, interfazDiscoDuro, capacidadDiscoDuro, rpmDiscoDuro, memoriaCacheDiscoDuro,';
        }
        if($_GET['idCategoria'] == 5){
          $camposSQL = 'factorFormaDiscoSolido, interfazDiscoSolido, capacidadDiscoSolido, lecturaDiscoSolido, escrituraDiscoSolido,';
        }
        if($_GET['idCategoria'] == 8){
          $camposSQL = 'certificacionFuente, potenciaFuente, factorFormaFuente, tamanioFanCoolerFuente, 
          conectorMother204PinFuente, conectorCpu44PinFuente, conectorCpu8PinFuente, conectorSataFuente, conectorMolex4PinFuente, conectorFloppy4PinFuente, conectorPcie62PinFuente, conectorPcie124Pin, iluminacionCoolerFuente,';
        }
        if($_GET['idCategoria'] == 15){
          $camposSQL = 'microPc, motherPc, ramPc, videoPc, hddPc, ssdPc, fuentePc, gabinetePc, monitorPc,';
        }

        $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, stockPrd, descPrd,  estadoPrd,".$camposSQL." img1, img2, img3, img4 FROM productos p
                    INNER JOIN categoria c ON p.idCategoria = c.idCategoria
                      INNER JOIN marca m ON p.idMarca = m.idMarca
                          WHERE idPrd = ".$idPrd;
                          
        $resultado = mysqli_query( $link,$sql );
        return $resultado; 
    }

    function buscarProducto()
    {
      $search = $_GET['search'] ?? '';
      //Paginacion
      $total_registros = totalRegistrosProductos();
      $registros_por_pagina = 6;
      $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
      $primer_registro = ($pagina_actual-1) * $registros_por_pagina;   

      $link = conectar();
      $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, descPrd, stockPrd, descPrd, estadoPrd, img1 FROM productos p
                INNER JOIN categoria c ON p.idCategoria = c.idCategoria
                  INNER JOIN marca m ON p.idMarca = m.idMarca
                      WHERE estadoPrd = 1 AND (p.nombrePrd LIKE '%".$search."%' OR c.nombreCategoria LIKE '%".$search."%' 
                        OR m.nombreMarca LIKE '%".$search."%')
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

    function buscarProductoPublicacionesListado()
    {
      $search = $_GET['search'] ?? '';

      $link = conectar();
      $sql = "SELECT c.nombreCategoria, c.idCategoria, m.idMarca, m.nombreMarca, idPrd, nombrePrd, precioPrd, descPrd, estadoPrd, stockPrd, descPrd, img1 FROM productos p
                INNER JOIN categoria c ON p.idCategoria = c.idCategoria
                  INNER JOIN marca m ON p.idMarca = m.idMarca
                      WHERE p.nombrePrd LIKE '%".$search."%' OR c.nombreCategoria LIKE '%".$search."%' 
                        OR m.nombreMarca LIKE '%".$search."%'";

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

    function agregarPc() : bool
    {
        $link = conectar();  

        $marca = $_SESSION['marcaPc'];
        $categoria = 15;
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

        $sql = "INSERT INTO productos
        ( nombrePrd, stockPrd, precioPrd, descPrd, microPc, motherPc, ramPc, videoPc, hddPc, ssdPc, fuentePc, gabinetePc, monitorPc, 
        img1, img2, img3, img4, idMarca, idCategoria )
        VALUES
        ( '$nombrePubli', $stock , $precio,
          '$descripcion', '$micro', '$mother', '$ram',
          '$video', '$duro', '$solido', '$fuente', '$gabinete',
          '$monitor', '$img1',  '$img2', '$img3', '$img4', $marca, $categoria )";
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

      if($_SESSION['idCategoria'] == 15){ //PARTE PC
        $marca = $_POST['marca'];
        $monitor = $_POST['monitor'];
        $micro = $_POST['micro'];
        $mother = $_POST['mother'];
        $ram = $_POST['ram'];
        $video = $_POST['video'];
        $duro = $_POST['duro'];
        $solido = $_POST['solido'];
        $fuente = $_POST['fuente'];
        $gabinete = $_POST['gabinete'];

        $camposSQL = "microPc = '$micro', motherPc = '$mother', ramPc = '$ram', videoPc = '$video', hddPc = '$duro', ssdPc = '$solido', fuentePc = '$fuente',
        gabinetePc = '$gabinete', monitorPc = '$monitor',";

      }elseif($_SESSION['idCategoria'] == 1){ //PARTE MICROPROCESADOR
  
        $nucleos = $_POST['nucleosMicro'];
        $hilos = $_POST['hilosMicro'];
        $socket = $_POST['socketMicro'];
        $frecuenciaBase = $_POST['frecuenciaBaseMicro'];
        $frecuenciaMaxima = $_POST['frecuenciaMaximaMicro'];
        $graficosIntegrados = $_POST['graficosIntegradosMicro'];
        $modeloGraficosIntegrados = $_POST['modeloGraficosIntegradosMicro'];
        $litografia = $_POST['litografiaMicro'];
  
        $cooler = $_POST['coolerMicro'];
        $tdp = $_POST['tdpMicro'];
        $maxTemp = $_POST['maxTempMicro'];
  
        $cacheL1 = $_POST['cacheL1Micro'];
        $cacheL2 = $_POST['cacheL2Micro'];
        $cacheL3 = $_POST['cacheL3Micro'];

        $camposSQL = "nucleosMicro = $nucleos, hilosMicro = $hilos, socketMicro = '$socket', frecuenciaBaseMicro = $frecuenciaBase, 
        frecuenciaMaxMicro = $frecuenciaMaxima, cacheL1Micro = $cacheL1, cacheL2Micro = $cacheL2, cacheL3Micro = $cacheL3,
        graficosIntegrados = $graficosIntegrados, modeloGraficosIntegradosMicro = '$modeloGraficosIntegrados', cooler = $cooler,
        tdpMicro = '$tdp', tempMaximaMicro = '$maxTemp', litografiaMicro = '$litografia',";
        
      }elseif($_SESSION['idCategoria'] == 2){//PARTE MOTHERBOARD

        $socket = $_POST['socketMother'];
        $chipset = $_POST['chipsetMother'];
        $botonFlashBios = $_POST['botonFlashBiosMother'];
        $factorForma = $_POST['factorFormaMother'];
  
        $slotsExpansion = $_POST['slotExpansionMother'];
        $cantSata = $_POST['cantSataMother'];
        $interfazM2 = $_POST['interfazM2Mother'];
        $cantM2 = $_POST['cantM2Mother'];
        $lan = $_POST['lanMother'];
        $wifi = $_POST['wifiMother'];
        $bluetooth = $_POST['bluetoothMother'];
        $chipsetAudio = $_POST['chipsetAudioMother'];
        $cantUsb20 = $_POST['cantUsb20Mother'];
        $cantUsb30 = $_POST['cantUsb30Mother'];
        $displayPort = $_POST['displayPortMother'];
        $hdmi = $_POST['hdmiMother'];
        $vga = $_POST['vgaMother'];
  
        $cantSlotsMemoria = $_POST['cantSlotsMemoriaMother'];
        $capacidadMaximaMemoria = $_POST['capacidadMaximaMemoriaMother'];
        $velocidadMaximaMemoria = $_POST['velocidadMaximaMemoriaMother'];

        $camposSQL = "socketMother = '$socket', chipsetMother = '$chipset', factorFormaMother = '$factorForma', slotsRamMother = $cantSlotsMemoria, 
        cantMaxRamMother = $capacidadMaximaMemoria, velocidadMaxRamMother = $velocidadMaximaMemoria, cantCanalesRamMother = $cantSlotsMemoria,
        slotsExpasionMother = '$slotsExpansion', cantSataMother = $cantSata, interfazm2Mother = $interfazM2, cantPuertosM2Mother = $cantM2,
        lanMother = $lan, wifiMother = $wifi, bluetoothMother = $bluetooth, chipsetAudioMother = '$chipsetAudio', puertosUsb20Mother = $cantUsb20,
        puertosUsb30Mother = $cantUsb30, cantDisplayPortMother = $displayPort, cantHdmiMother = $hdmi, cantVgaMother = $vga, flashBiosButtonMother = $botonFlashBios,";

      }elseif($_SESSION['idCategoria'] == 3){//PARTE MEMORIA RAM

        $ddr = $_POST['ddrMemoriaRam'];
        $capacidad = $_POST['capacidadMemoriaRam'];
        $velocidad = $_POST['velocidadMemoriaRam'];
        $latencia = $_POST['latenciaMemoriaRam'];
        $color = $_POST['colorMemoriaRam'];
  
        $tipo = $_POST['tipoMemoriaRam'];
        $disipador = $_POST['disipadorMemoriaRam'];

        $camposSQL = "ddrMemoriaRam = '$ddr', tamanioMemoriaRam = $capacidad, velocidadMemoriaRam = $velocidad,
        latenciaMemoriaRam = $latencia, disipadorMemoriaRam = $disipador, colorMemoriaRam = '$color', 
        compatibilidadMemoriaRam = '$tipo',";

      }elseif($_SESSION['idCategoria'] == 6){

        $tipoPcie = $_POST['tipoPciePlacaVideo'];
        $gddr = $_POST['gddrPlacaVideo'];
        $frecuenciaBase = $_POST['frecuenciaBasePlacaVideo'];
        $frecuenciaMaxima = $_POST['frecuenciaMaximaPlacaVideo'];
        $tamañoMemoria = $_POST['tamañoMemoriaPlacaVideo'];
  
        $ancho = $_POST['anchoPlacaVideo'];
        $largo = $_POST['largoPlacaVideo'];
        $peso = $_POST['pesoPlacaVideo'];
  
        $displayPort = $_POST['displayPortPlacaVideo'];
        $hdmi = $_POST['hdmiPlacaVideo'];
        $dvi = $_POST['dviPlacaVideo'];
  
        $bus = $_POST['busPlacaVideo'];
        $multiplesMonitores = $_POST['multiplesMonitoresPlacaVideo'];
        $numeroCoolers = $_POST['numeroCoolersPlacaVideo'];

        $camposSQL = "frecuenciaBasePlacaVideo = $frecuenciaBase, frecuenciaMaximaPlacaVideo = $frecuenciaMaxima, tipoPciePlacaVideo = '$tipoPcie',
        gddrPlacaVideo = '$gddr', tamanioMemoriaPlacaVideo = $tamañoMemoria, busPlacaVideo = $bus, multiplesPantallasPlacaVideo = $multiplesMonitores,
        numeroFanCoolersPlacaVideo = $numeroCoolers, displayPortPlacaVideo = $displayPort, hdmiPlacaVideo = $hdmi, dviPlacaVideo = $dvi,
        anchoPlacaVideo = $ancho, largoPlacaVideo = $largo, pesoPlacaVideo = $peso,";

      }elseif($_SESSION['idCategoria'] == 4){

        $interfaz = $_POST['interfazDiscoDuro'];
        $capacidad = $_POST['capacidadDiscoDuro'];
        $factorForma = $_POST['factorFormaDiscoDuro'];
  
        $rpm = $_POST['rpmDiscoDuro'];
        $memoriaCache = $_POST['memoriaCacheDiscoDuro'];

        $camposSQL = "factorFormaDiscoDuro = $factorForma, interfazDiscoDuro = '$interfaz', capacidadDiscoDuro = $capacidad,
        rpmDiscoDuro = $rpm, memoriaCacheDiscoDuro = $memoriaCache,";

      }elseif($_SESSION['idCategoria'] == 5){

        $interfaz = $_POST['interfazDiscoSolido'];
        $capacidad = $_POST['capacidadDiscoSolido'];
        $factorForma = $_POST['factorFormaDiscoSolido'];
  
        $lectura = $_POST['lecturaDiscoSolido'];
        $escritura = $_POST['escrituraDiscoSolido'];

        $camposSQL = "factorFormaDiscoSolido = $factorForma, interfazDiscoSolido = '$interfaz', capacidadDiscoSolido = $capacidad,
        lecturaDiscoSolido = $lectura, escrituraDiscoSolido = $escritura,";

      }elseif($_SESSION['idCategoria'] == 8){

        $potencia = $_POST['potenciaFuente'];
        $factorForma = $_POST['factorFormaFuente'];
        $tamañoFanCooler = $_POST['tamanioFanCoolerFuente'];
        $certificacion = $_POST['certificacionFuente'];
  
        $conectorMother204Pin = $_POST['conectorMother204PinFuente'];
        $conectorCpu44Pin = $_POST['conectorCpu44PinFuente'];
        $conectorCpu8Pin = $_POST['conectorCpu8PinFuente'];
        $conectorSata = $_POST['conectorSataFuente'];
        $conectorMolex4Pin = $_POST['conectorMolex4PinFuente'];
        $conectorFloppy4Pin = $_POST['conectorFloppy4PinFuente'];
        $conectorPcie62Pin = $_POST['conectorPcie62PinFuente'];
  
        $iluminacion = $_POST['iluminacionFuente'];

        $camposSQL = "certificacionFuente = '$certificacion', potenciaFuente = $potencia, factorFormaFuente = '$factorForma',
        tamanioFanCoolerFuente = $tamañoFanCooler, conectorMother204PinFuente = $conectorMother204Pin, conectorCpu44PinFuente = $conectorCpu44Pin,
        conectorCpu8PinFuente = $conectorCpu8Pin, conectorSataFuente = $conectorSata, conectorMolex4PinFuente = $conectorMolex4Pin, 
        conectorFloppy4PinFuente = $conectorFloppy4Pin, conectorPcie62PinFuente = $conectorPcie62Pin, iluminacionCoolerFuente = $iluminacion,";

      }

      $id = $_POST['idPrd'];
      $nombrePubli = $_POST['nombrePubli'];
      $precio = $_POST['precio'];
      $stock = $_POST['stock'];
      $estado = $_POST['estadoPc'];
      $descripcion = $_POST['descPrd'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "UPDATE productos SET nombrePrd = '$nombrePubli', stockPrd = $stock, precioPrd = $precio, descPrd = '$descripcion', estadoPrd = $estado, ".$camposSQL." img1 = '$img1', img2 = '$img2', img3 = '$img3', img4 = '$img4'
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

      $sql = "SELECT MAX(idPrd) FROM productos";
      $consulta = mysqli_query( $link,$sql );
      $resultado = mysqli_fetch_assoc( $consulta );
      $maximo = $resultado['MAX(idPrd)'] - 4; 
      return $maximo;
    }

    function idRandomPrd() 
    {
      $link = conectar();

      $sql = "SELECT idPrd, nombrePrd, stockPrd, precioPrd, img1 FROM productos
                LIMIT 4 OFFSET ".rand(1,maxIdPc());
      $resultado = mysqli_query( $link,$sql );
      return $resultado;
    }

    #PARTE MICROPROCESADOR

    function agregarMicro()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $categoriaProducto = 1;
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $nucleos = $_POST['nucleosMicro'];
      $hilos = $_POST['hilosMicro'];
      $socket = $_POST['socketMicro'];
      $frecuenciaBase = $_POST['frecuenciaBaseMicro'];
      $frecuenciaMaxima = $_POST['frecuenciaMaximaMicro'];
      $graficosIntegrados = $_POST['graficosIntegradosMicro'];
      $modeloGraficosIntegrados = $_POST['modeloGraficosIntegradosMicro'];
      $litografia = $_POST['litografiaMicro'];

      $cooler = $_POST['coolerMicro'];
      $tdp = $_POST['tdpMicro'];
      $maxTemp = $_POST['maxTempMicro'];

      $cacheL1 = $_POST['cacheL1Micro'];
      $cacheL2 = $_POST['cacheL2Micro'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4, 
        nucleosMicro, hilosMicro, socketMicro, frecuenciaBaseMicro, frecuenciaMaxMicro, cacheL1Micro, cacheL2Micro, cacheL3Micro,
        graficosIntegrados, modeloGraficosIntegradosMicro, cooler, tdpMicro, tempMaximaMicro, litografiaMicro)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '', '$img1', '$img2', '$img3', '$img4',
      $nucleos, $hilos, '$socket', $frecuenciaBase, $frecuenciaMaxima, $cacheL1, $cacheL2, 0, '$graficosIntegrados', '$modeloGraficosIntegrados', '$cooler', '$tdp', '$maxTemp', '$litografia')";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }


    #PARTE MOTHERBOARD

    function agregarMother()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $descripcionProducto = $_POST['descProducto'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $socket = $_POST['socketMother'];
      $chipset = $_POST['chipsetMother'];
      $botonFlashBios = $_POST['botonFlashBiosMother'];
      $factorForma = $_POST['factorFormaMother'];

      $slotsExpansion = $_POST['slotExpansionMother'];
      $cantSata = $_POST['cantSataMother'];
      $interfazM2 = $_POST['interfazM2Mother'];
      $cantM2 = $_POST['cantM2Mother'];
      $lan = $_POST['lanMother'];
      $wifi = $_POST['wifiMother'];
      $bluetooth = $_POST['bluetoothMother'];
      $chipsetAudio = $_POST['chipsetAudioMother'];
      $cantUsb20 = $_POST['cantUsb20Mother'];
      $cantUsb30 = $_POST['cantUsb30Mother'];
      $displayPort = $_POST['displayPortMother'];
      $hdmi = $_POST['hdmiMother'];
      $vga = $_POST['vgaMother'];

      $cantSlotsMemoria = $_POST['cantSlotsMemoriaMother'];
      $capacidadMaximaMemoria = $_POST['capacidadMaximaMemoriaMother'];
      $velocidadMaximaMemoria = $_POST['velocidadMaximaMemoriaMother'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4, 
      socketMother, chipsetMother, factorFormaMother, slotsRamMother, cantMaxRamMother, velocidadMaxRamMother, slotsExpasionMother, cantSataMother, interfazm2Mother,
      cantPuertosM2Mother, lanMother, wifiMother, bluetoothMother, chipsetAudioMother, puertosUsb20Mother, puertosUsb30Mother, cantDisplayPortMother, cantHdmiMother,
      cantVgaMother, flashBiosButtonMother)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
        '$socket', '$chipset', '$factorForma', $cantSlotsMemoria, $capacidadMaximaMemoria, $velocidadMaximaMemoria, '$slotsExpansion', $cantSata, $interfazM2,
        $cantM2, $lan, $wifi, $bluetooth, '$chipsetAudio', $cantUsb20, $cantUsb30, $displayPort, $hdmi, $vga, $botonFlashBios )";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }

    #PARTE MEMORIA RAM

    function agregarMemoriaRam()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $descripcionProducto = $_POST['descProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $ddr = $_POST['ddrMemoriaRam'];
      $capacidad = $_POST['capacidadMemoriaRam'];
      $velocidad = $_POST['velocidadMemoriaRam'];
      $latencia = $_POST['latenciaMemoriaRam'];
      $color = $_POST['colorMemoriaRam'];

      $tipo = $_POST['tipoMemoriaRam'];
      $disipador = $_POST['disipadorMemoriaRam'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4, 
        ddrMemoriaRam, tamanioMemoriaRam, velocidadMemoriaRam, latenciaMemoriaRam, disipadorMemoriaRam, 
        colorMemoriaRam, compatibilidadMemoriaRam)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
       '$ddr', $capacidad, $velocidad, $latencia, $disipador, '$color', '$tipo')";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }

    #PARTE PLACA DE VIDEO

    function agregarPlacaVideo()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $descripcionProducto = $_POST['descProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $tipoPcie = $_POST['tipoPciePlacaVideo'];
      $gddr = $_POST['gddrPlacaVideo'];
      $frecuenciaBase = $_POST['frecuenciaBasePlacaVideo'];
      $frecuenciaMaxima = $_POST['frecuenciaMaximaPlacaVideo'];
      $tamañoMemoria = $_POST['tamañoMemoriaPlacaVideo'];

      $ancho = $_POST['anchoPlacaVideo'];
      $largo = $_POST['largoPlacaVideo'];
      $peso = $_POST['pesoPlacaVideo'];

      $displayPort = $_POST['displayPortPlacaVideo'];
      $hdmi = $_POST['hdmiPlacaVideo'];
      $dvi = $_POST['dviPlacaVideo'];

      $bus = $_POST['busPlacaVideo'];
      $multiplesMonitores = $_POST['multiplesMonitoresPlacaVideo'];
      $numeroCoolers = $_POST['numeroCoolersPlacaVideo'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4, 
      frecuenciaBasePlacaVideo, frecuenciaMaximaPlacaVideo, tipoPciePlacaVideo, gddrPlacaVideo, tamanioMemoriaPlacaVideo, busPlacaVideo, 
      multiplesPantallasPlacaVideo, numeroFanCoolersPlacaVideo, displayPortPlacaVideo, hdmiPlacaVideo, dviPlacaVideo,
      anchoPlacaVideo, largoPlacaVideo, pesoPlacaVideo)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
       $frecuenciaBase, $frecuenciaMaxima, '$tipoPcie', '$gddr', $tamañoMemoria, $bus, 
       $multiplesMonitores, $numeroCoolers, $displayPort, $hdmi, $dvi,
       $ancho, $largo, $peso )";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }

    #PARTE DISCO DURO

    function agregarDiscoDuro()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $descripcionProducto = $_POST['descProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $interfaz = $_POST['interfazDiscoDuro'];
      $capacidad = $_POST['capacidadDiscoDuro'];
      $factorForma = $_POST['factorFormaDiscoDuro'];
      $tamañoMemoria = $_POST['tamañoMemoriaDiscoDuro'];

      $rpm = $_POST['rpmDiscoDuro'];
      $memoriaCache = $_POST['memoriaCacheDiscoDuro'];
      $lecturaEscritura = $_POST['lecturaEscrituraDiscoDuro'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4,
        factorFormaDiscoDuro, interfazDiscoDuro, capacidadDiscoDuro, rpmDiscoDuro, memoriaCacheDiscoDuro)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
       $factorForma, '$interfaz', $capacidad, $rpm, $memoriaCache )";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }

    #PARTE DISCO SOLIDO

    function agregarDiscoSolido()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $descripcionProducto = $_POST['descProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $interfaz = $_POST['interfazDiscoSolido'];
      $capacidad = $_POST['capacidadDiscoSolido'];
      $factorForma = $_POST['factorFormaDiscoSolido'];

      $lectura = $_POST['lecturaDiscoSolido'];
      $escritura = $_POST['escrituraDiscoSolido'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4,
        factorFormaDiscoSolido, interfazDiscoSolido, capacidadDiscoSolido, lecturaDiscoSolido, escrituraDiscoSolido)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
       $factorForma, '$interfaz', $capacidad, $lectura, $escritura )";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }

    #PARTE FUENTE

    function agregarFuente()
    {
      $link = conectar();

      $nombreProducto = $_POST['nombreProducto'];
      $marcaProducto = $_POST['marcaProducto'];
      $descripcionProducto = $_POST['descProducto'];
      $categoriaProducto = $_SESSION['categoria'];
      $unidadesProducto = $_POST['unidadesProducto'];
      $precioProducto = $_POST['precioProducto'];

      $potencia = $_POST['potenciaFuente'];
      $factorForma = $_POST['factorFormaFuente'];
      $tamañoFanCooler = $_POST['tamanioFanCoolerFuente'];
      $certificacion = $_POST['certificacionFuente'];

      $conectorMother204Pin = $_POST['conectorMother204PinFuente'];
      $conectorCpu44Pin = $_POST['conectorCpu44PinFuente'];
      $conectorCpu8Pin = $_POST['conectorCpu8PinFuente'];
      $conectorSata = $_POST['conectorSataFuente'];
      $conectorMolex4Pin = $_POST['conectorMolex4PinFuente'];
      $conectorFloppy4Pin = $_POST['conectorFloppy4PinFuente'];
      $conectorPcie62Pin = $_POST['conectorPcie62PinFuente'];

      $iluminacion = $_POST['iluminacionFuente'];

      $img1 = subirImagen();
      $img2 = subirImagen2();
      $img3 = subirImagen3();
      $img4 = subirImagen4();

      $sql = "INSERT INTO productos
      ( idMarca, idCategoria, nombrePrd, precioPrd, stockPrd, descPrd, img1, img2, img3, img4,
        certificacionFuente, potenciaFuente, factorFormaFuente, tamanioFanCoolerFuente, conectorMother204PinFuente, conectorCpu44PinFuente, 
        conectorCpu8PinFuente, conectorSataFuente, conectorMolex4PinFuente, conectorFloppy4PinFuente, 
        conectorPcie62PinFuente, iluminacionCoolerFuente)
      VALUES
      ($marcaProducto, $categoriaProducto, '$nombreProducto', $precioProducto, $unidadesProducto, '$descripcionProducto', '$img1', '$img2', '$img3', '$img4',
       '$certificacion', $potencia, '$factorForma', $tamañoFanCooler, $conectorMother204Pin, $conectorCpu44Pin, 
       $conectorCpu8Pin, $conectorSata, $conectorMolex4Pin, $conectorFloppy4Pin,
       $conectorPcie62Pin, $iluminacion )";

      try{
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
      }catch(EXCEPTION $e){
        return FALSE;
      }
    }
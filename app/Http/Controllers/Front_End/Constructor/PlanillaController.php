<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Constructor\Unidad;
use App\Models\Constructor\PlanillaItem;
use App\Models\Constructor\PlanillaMovimiento;
use App\Models\Constructor\PlanillaDocument;

use Illuminate\Http\Request;

use App\Models\Constructor\document;
use App\Models\Constructor\Planilla;
use Brick\Math\BigInteger;

class PlanillaController extends Controller
{
    public function getPlanillaItem(){
        return PlanillaItem::all();
    }
    public function inicio()
    {
        return view('front-end.constructor.IndexPlanillas');
    }


    public function planillaCSV(Request $request)
    {
        //lo utilizamos para no crear mas rutas, no permite verificar para cargar planillas items por items
        // jalar 
        $tipo_planilla_id=$request->tipo_planilla_id;
        $contrato_id=$request->contrato_id;
        $inicial=DB::table('planillas')
        ->join('planilla_movimientos', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->where('planillas.contrato_id', '=', $contrato_id)
        ->where('planillas.tipo_planilla_id', '=', '1')
        ->select('planilla_movimientos.planilla_id', 'planillas.tipo_planilla_id')->distinct()
        ->get();

        If ((count($inicial)==0)  and ($tipo_planilla_id==1)){


            $mensaje='PUEDE CARGAR LA Planilla  inicial';
            return $mensaje;

        }

        If ((count($inicial)>0)  and ($tipo_planilla_id!=1)){

            $mensaje='PUEDE CARGAR YA ESTA CARGADA LA PLANILLA INICIAL Y ES DE OTRO TIPO';
        return $mensaje;

        }
        //$existe=PlanillaItem::whereb
        $mensaje=1;
        return $mensaje;

    }

    // ahora veamos el archivo no encuetro path
    public function upLoadCSV(Request $request)
    {
        $path='ni mod';
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $nombre_carpeta = "/constructor/documentos/planillacsv";
            //D:\max\constructor\storage\app\documentos\constructor
            $nombre_archivo = $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
            
        }
       return $path;


    }
    public function validarCSV(Request $request)
    {
        // debe devolver un true para poder ir a porcesar o habilitar un boton de procesar
        $path = str_replace('\\', '/', storage_path());
        $tipo_planilla_id=$request->tipo_planilla_id;
       
        $file=$path.'/app/'.$request->path;
        $openfile = fopen($file, "r");
        if($openfile !== FALSE){
           
           /* $cont = fread($openfile, filesize($file));
            dd($cont);*/
            $delimitador=",";
            $linea1 = fgetcsv($openfile);
            // veamos si el separador es , o ;
            $separador=explode(",",$linea1[0] ); 


          

            if(count($separador)>1 ){
                $delimitador=",";

            } else {
                $separador=explode(";",$linea1[0] ); 
                $delimitador=";";
                
            }
            $contador=0;
            if(count($separador) == 9 ){

               $mensaje = "tiene 9 columnas y el delimitador es ". $delimitador;
           
                    // vemos si las columnas tiene el titulo que corresponde
                
                (strtoupper($separador[0]) == "TIPO") ? $contador++ : $contador;
                (strtoupper($separador[1]) == "CODIGO") ? $contador++ : $contador ;
                (strtoupper($separador[2]) == "ITEM") ? $contador++ : $contador;
                (strtoupper($separador[3]) == "DESCRIPCON") ? $contador++ : $contador;
                (strtoupper($separador[4]) == "UNIDAD") ? $contador++ : $contador;
                (strtoupper($separador[5]) == "SIMBOLO") ? $contador++ : $contador;
                (strtoupper($separador[6]) == "CANTIDAD") ? $contador++ : $contador;
                (strtoupper($separador[7]) == "PREC_UNITARIO") ? $contador++ : $contador;
                (strtoupper($separador[8]) == "TOTAL") ? $contador++ : $contador;
                
           
           
            } else {
                $mensaje = "No tiene 9 columnas tiene " .count($separador). " columnas  y el delimitador es ". $delimitador;
            }

            //
          

          if($contador==9){
            $mensaje = "Todo bien El archivo tiene " .count($separador). " columnas  y el delimitador es ". $delimitador;
            return $delimitador;

          } else {
            $mensaje = "El archivo tiene " .count($separador). " columnas  en lugar de 9 y el delimitador es ". $delimitador;
            return $mensaje;
            }
         
        
           
        }


        
      

    }



    public function procesarCSV(Request $request)
    {
       
        
        $path = str_replace('\\', '/', storage_path());
        $tipo_planilla_id=$request->tipo_planilla_id;
        $delimitador=$request->delimitador;

        $archivo=$path.'/app/'.$request->path;
        $file_to_read = fopen($archivo, "r");
        // LEE EL ARCHIVO CSV Y LO GUARDA EN UN ARRAY PLA
        $row=0;
        if($file_to_read !== FALSE){                    
        
            while(($data = fgetcsv($file_to_read, 1000, $delimitador)) !== FALSE){
            
                // LA FILA CERO SON LOS TITULOS
                // tipo;codigo;ITEM;DESCRIPCON;UNIDAD;SIMBOLO;CANTIDAD;PREC_UNITARIO;TOTAL--count($data)

                for($i = 0; $i < 9; $i++) {
                    $pla[$row][$i]=$data[$i];

                  }
                  $pla[$row][9]=2;
                  $pla[$row][10]=0;
                  if($row > 0){
                       
                        if( $pla[$row][5] != ""){
                            $simbolo= $pla[$row][5];
                            $unidades=DB::table('unidades')->select('id')
                            ->where('simbolo', 'like', $simbolo)
                            ->first();   
                            
                            $strUni = json_encode($unidades);
                            $strUni1= (int) substr($strUni, 6, 2);
                         
                            $pla[$row][9]=$strUni1;
                        
                        }
                    }                           

                  $row++;

                   
            }
        
        
            fclose($file_to_read);
    
    
        }


    /*  ********************************************************************************************************************
    *       INICIO ---> CARGAR PLANILLA INICIAL
    *********************************************************************************************************************/

        if($tipo_planilla_id == 1){
            // planilla inicial reciaen creamos los itemes                  

               
                //cargar planilla_item
                $long_max=0;
                $registros=count($pla);
                for($i = 1; $i < $registros; $i++) {
                    if($pla[$i][1] != ''){
                        $item= new PlanillaItem;
                    
                        $item->contrato_id=$request->contrato_id;
                        $item->planilla_id=$request->planilla_id;

                        $item->tipo=$pla[$i][0];
                        $item->item_codigo=$pla[$i][1];
                        $item->item_descripcion=utf8_encode($pla[$i][3]);
                        //$item->item_descripcion=$pla[$i][3];
                        $item->unidad_id=$pla[$i][9];
                        $item->padre=0;

                        $item->save();
                    }

                    
                }
               
                // encontrar padres
                // traemos todo de planil_items

                $items_planilla=PlanillaItem::where('contrato_id', '=', $request->contrato_id)
                ->where('planilla_id', '=', $request->planilla_id)
                ->get();


                $items=json_decode($items_planilla);
                $fila=0;
                foreach($items as $item) { //foreach element in $arr
                    //$codigos[] = $item['item_codigo']; //etc
                    //$a_item=$item->toArray();
                    //$obj=json_encode($item, true);
                    //le quito comillas al inicio y final substr($mystring, 0, -1);   $str = substr($str, 1);
                    $fila++;
                    $obj=str_replace('"', '', json_encode($item, true));

                    $partes=explode(",",$obj );
                    $item_codigo=explode(":",$partes[4]);
                    $codigoLen=strLen($item_codigo[1]);
                    $c_id=explode(":",$partes[0]);
                    $codigo[$fila]['id']=$c_id[1];
                    $codigo[$fila]['item_codigo']=$item_codigo[1];
                    $codigo[$fila]['padre']=0;                                      

                }
                
               
                for($i = 1; $i <= count($codigo); $i++) {
                    $body ='';
                    $valor=$codigo[$i]['item_codigo'];
                    // hacemps volar el ultimo carcater si es .
                    $valor = (substr($valor, -1) =='.' ? substr($valor, 0, -1) : $valor); // si tiene punto al final lo elimina
                    $familia=explode(".",$valor); // separa los numeros en elemento de array
                    $codigoLen=count($familia); // cuandos digito tiene el codigo 7.6 tiene 2
                   
                    if($codigoLen>1){                       
                        
                          for ($x = 0; $x <$codigoLen-1; $x++){
                            
                            $body .= $familia[$x]."." ;
                         } 

                    }
                    
                    $fam[$i]= $body; 


                    if($body!=""){  
                        for ($x = 1; $x <= count($codigo); $x++){
                            
                            if($body == $codigo[$x]['item_codigo']){
                                $codigo[$i]['padre']=$codigo[$x]['id'];
                                $x=5+count($codigo);
                            }

                         } 
                       
                    }

                }


               // dd($codigo);
                //DELETE FROM planilla_items WHERE `planilla_id` = 49 AND `contrato_id` = 24;

                //ahora actualizamos padres en la tabla
                for ($x = 1; $x <= count($codigo); $x++){

                    $item= new PlanillaItem;
                    $id= $codigo[$x]['id'];
                    $padre= $codigo[$x]['padre'];

                    $data = PlanillaItem::where('id', $id)
                            ->update(['padre' => $padre]);


                } 
                
                
                // cargar cantidades y montos iniciales en planilla movimientos
                for ($x = 1; $x <= count($codigo); $x++){
                    $id= $codigo[$x]['id'];
                    $item_codigo= $codigo[$x]['item_codigo'];

                    for ($i = 1; $i <count($pla); $i++){
                        //$pla[$i][10]=0;
                        $valor=$pla[$i][1];
                        //$valor = (substr($valor, -1) =='.' ? substr($valor, 0, -1) : $valor);
                        $comp=strcmp($valor, $item_codigo);
                        $val1[$x][$i] =$valor.'---'.$item_codigo.'---'.$id.'---'.$comp.'---'.$i.'---'.$x;

                                 if($comp == 0){
                                    $pla[$i][10]=$id;                          
                                     $i=5+count($pla);
                                 }
                     } 

                } 
                // insertar pla en la tabla moviminetos

                $registros=count($pla);
                for($i = 1; $i < $registros; $i++) {
                    if($pla[$i][10] != 0){
                        $movi= new PlanillaMovimiento;
                        $cant=explode(",",$pla[$i][6]); $cant=implode(".",$cant); $cantidad = floatval($cant);
                        $prec=explode(",",$pla[$i][7]); $prec=implode(".",$prec); $precio_unitario = floatval($prec);

                        $movi->planilla_id=$request->planilla_id;
                        $movi->planilla_item_id =$pla[$i][10];
                        $movi->cantidad=$cantidad;
                        $movi->precio_unitario=$precio_unitario;
                        

                        $movi->save();
                    }
                    
                }
                //grabamos en planilla-dcoumentos
                
                $relacion= new PlanillaDocument;
                $relacion->document_id =$request->contrato_id;
                $relacion->planilla_id=$request->planilla_id;
                $relacion->save();


            
                 // aqui cierra para planilla inicial
        }
        
    /********************************************************************************************************************
     * FIN DE CARGAR PLANILLA INICIAL
     *********************************************************************************************************************/

    /*  ********************************************************************************************************************
    *       INICIO ---> CARGAR PLANILLA MODIFICATORIAS 2
    *********************************************************************************************************************/  
    if($tipo_planilla_id == 2){
                // ya tenemos leido el archivo, ahota debemos pnerle  item_id
                $items_planilla=PlanillaItem::where('contrato_id', '=', $request->contrato_id)
                ->get();


                $items=json_decode($items_planilla);
                $fila=0;
                foreach($items as $item) {
                    $fila++;
                    $obj=str_replace('"', '', json_encode($item, true));

                    $partes=explode(",",$obj );
                    //$codigo[$fila]['item']= $partes;
                
                    $item_codigo=explode(":",$partes[4]);
                    $codigoLen=strLen($item_codigo[1]);
                    $c_id=explode(":",$partes[0]);
                    $padre=explode(":",$partes[7]);
                    $codigo[$fila]['id']=$c_id[1];
                    $codigo[$fila]['item_codigo']=$item_codigo[1];
                    $codigo[$fila]['padre']=$padre[1];

                    // ahora ponemos id y contrato a pla
                    // cargar cantidades y montos iniciales en planilla movimientos
                    for ($x = 1; $x <= count($codigo); $x++){
                        $id= $codigo[$x]['id'];
                        $item_codigo= $codigo[$x]['item_codigo'];

                        for ($i = 1; $i <count($pla); $i++){
                            //$pla[$i][10]=0;
                            $valor=$pla[$i][1];
                            //$valor = (substr($valor, -1) =='.' ? substr($valor, 0, -1) : $valor);
                            $comp=strcmp($valor, $item_codigo);
                            $val1[$x][$i] =$valor.'---'.$item_codigo.'---'.$id.'---'.$comp.'---'.$i.'---'.$x;

                                    if($comp == 0){
                                        $pla[$i][10]=$id;                          
                                        $i=5+count($pla);
                                    }
                        } 

                    } 
                } 


                // insertar pla en la tabla moviminetos

                $registros=count($pla);
                for($i = 1; $i < $registros; $i++) {
                    if($pla[$i][10] != 0){
                        $movi= new PlanillaMovimiento;
                        $cant=explode(",",$pla[$i][6]); $cant=implode(".",$cant); $cantidad = floatval($cant);
                        $prec=explode(",",$pla[$i][7]); $prec=implode(".",$prec); $precio_unitario = floatval($prec);

                        $movi->planilla_id=$request->planilla_id;
                        $movi->planilla_item_id =$pla[$i][10];
                        $movi->cantidad=$cantidad;
                        $movi->precio_unitario=$precio_unitario;

                        $movi->save();
                    }
                    
                }
                //grabamos en planilla-dcoumentos
                
                $relacion= new PlanillaDocument;
                $relacion->document_id =$request->contrato_id;
                $relacion->planilla_id=$request->planilla_id;
                $relacion->save();






                
               // dd($pla);
    }    
    /********************************************************************************************************************
     * FIN DE CARGAR PLANILLA MODIFICATORIAS TIPO 2
     *********************************************************************************************************************/


 /*  ********************************************************************************************************************
    *       INICIO ---> CARGAR PLANILLA AVANCE 3
    *********************************************************************************************************************/  
    if($tipo_planilla_id == 3 ){
        // ya tenemos leido el archivo, ahota debemos pnerle  item_id
        $items_planilla=PlanillaItem::where('contrato_id', '=', $request->contrato_id)
        ->get();


        $items=json_decode($items_planilla);
        $fila=0;
        foreach($items as $item) {
            $fila++;
            $obj=str_replace('"', '', json_encode($item, true));

            $partes=explode(",",$obj );
            //$codigo[$fila]['item']= $partes;
        
            $item_codigo=explode(":",$partes[4]);
            $codigoLen=strLen($item_codigo[1]);
            $c_id=explode(":",$partes[0]);
            $padre=explode(":",$partes[7]);
            $codigo[$fila]['id']=$c_id[1];
            $codigo[$fila]['item_codigo']=$item_codigo[1];
            $codigo[$fila]['padre']=$padre[1];

            // ahora ponemos id y contrato a pla
            // cargar cantidades y montos iniciales en planilla movimientos
            for ($x = 1; $x <= count($codigo); $x++){
                $id= $codigo[$x]['id'];
                $item_codigo= $codigo[$x]['item_codigo'];

                for ($i = 1; $i <count($pla); $i++){
                    //$pla[$i][10]=0;
                    $valor=$pla[$i][1];
                    //$valor = (substr($valor, -1) =='.' ? substr($valor, 0, -1) : $valor);
                    $comp=strcmp($valor, $item_codigo);
                    $val1[$x][$i] =$valor.'---'.$item_codigo.'---'.$id.'---'.$comp.'---'.$i.'---'.$x;

                            if($comp == 0){
                                $pla[$i][10]=$id;                          
                                $i=5+count($pla);
                            }
                } 

            } 
        } 


        // insertar pla en la tabla moviminetos

        $registros=count($pla);
        for($i = 1; $i < $registros; $i++) {
            if($pla[$i][10] != 0){
                $movi= new PlanillaMovimiento;
                $cant=explode(",",$pla[$i][6]); $cant=implode(".",$cant); $cantidad = floatval($cant);
                $prec=explode(",",$pla[$i][7]); $prec=implode(".",$prec); $precio_unitario = floatval($prec);

                $movi->planilla_id=$request->planilla_id;
                $movi->planilla_item_id =$pla[$i][10];
                $movi->cantidad=$cantidad;
                $movi->precio_unitario=$precio_unitario;

                $movi->save();
            }
            
        }
        //grabamos en planilla-dcoumentos
        
        $relacion= new PlanillaDocument;
        $relacion->document_id =$request->contrato_id;
        $relacion->planilla_id=$request->planilla_id;
        $relacion->save();


        // debemos actualizar el estado en planilla
        $actEstado = Planilla::findOrFail($request->planilla_id);
        $actEstado->estado_planilla =1;
        $actEstado->save();


        
       // dd($pla);
}      
    /********************************************************************************************************************
     * FIN DE CARGAR PLANILLA AVANCE TIPO 3
     *********************************************************************************************************************/



      //DELETE FROM planilla_items WHERE planilla_id=49 and contrato_id=24;
      //DELETE FROM planilla_movimientos WHERE planilla_id=49
           // dd($pla);
        return $request;
        


    }



    public function getValoresItem($id){

       

        $json=PlanillaItem::where('id',$id )->with('Unidad')->first();
       
        
        $contrato_id=$json->contrato_id;
        $planilla_item_id=$id;


        //dd($contrato_id);

        $obj = json_decode($json, true);

        $items[0]['id']=$id;
        $items[0]['item_codigo']=$json->item_codigo;
        $items[0]['item_descripcion']=$json->item_descripcion;
        $items[0]['simbolo']=$json->unidad->simbolo;


            // vigente
                $json=DB::table('planillas')
                    ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                    ->where('planillas.contrato_id', $contrato_id)
                    ->where('planillas.tipo_planilla_id', '2')
                    ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                    ->orderBy('planillas.fecha_planilla')
                    ->get();

                    
                        $json=DB::table('planillas')
                        ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                        ->where('planillas.contrato_id', $contrato_id)
                        ->where('planillas.tipo_planilla_id', '1')
                        ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                        ->orderBy('planillas.fecha_planilla')
                        ->get();

                    
                    $obj1 = json_decode($json, true);
                
                    $items[0]['vigente']=$obj1[0]['cantidad'];
                    $items[0]['precio_unitario']=$obj1[0]['precio_unitario'];

                    // avance
                    $json=DB::table('planillas')
                    ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                    ->select(DB::raw("SUM(cantidad) as avance"), 'precio_unitario')
                    ->where('planillas.contrato_id', $contrato_id)
                    ->where('planillas.tipo_planilla_id', '3')
                    ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                    ->groupBy('planillas.tipo_planilla_id', 'precio_unitario')
                    ->orderBy('planillas.fecha_planilla')
                    ->get();
                    $obj1 = json_decode($json, true);

                    $items[0]['avance']=$obj1[0]['avance'];
                    $items[0]['precio_unit_avance']=$obj1[0]['precio_unitario'];

                    // calculamos el saldo
                    $items[0]['saldo']=$items[0]['vigente']- $items[0]['avance'];
                    $items[0]['monto_por_cobrar']=$items[0]['saldo']*$items[0]['precio_unitario'];
                    
                    
                    $items[0]['fvigente']=number_format($items[0]['vigente'],2,",",".");
                    $items[0]['fprecio_unitario']=number_format($items[0]['precio_unitario'],2,",",".");
                    $items[0]['favance']=number_format($items[0]['avance'],2,",",".");
                    $items[0]['fprecio_unit_avance']=number_format($items[0]['precio_unit_avance'],2,",",".");
                    $items[0]['fsaldo']=number_format($items[0]['saldo'],2,",",".");
                    $items[0]['fmonto_por_cobrar']=number_format($items[0]['monto_por_cobrar'],2,",",".");
                
    
        return $items;
    }


    public function index()
    {
        //lo utilizamos para no crear mas rutas, no permite verificar para cargar planillas items por items
        // jalar 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //subimos el archivo y armamos el path doc
        if($request->hasFile('files')){
           $extension = $request->file('files')->getClientOriginalExtension();
            $files = $request->file('files');
            $nombre_carpeta = "/constructor";
           
            $nombre_archivo = $request->contrato_id.'_pla_'.$_FILES['files']['name'];

            //$path= $nombre_carpeta.'/'.$nombre_archivo;
           // $alma = $files->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
           $archivo_guardado = $files->storeAs( $nombre_carpeta, $nombre_archivo, 'constructor');

           // $archivo_guardado = $files->storeAs( '', $nombre_archivo, 'constructor'); // graba en el raiz del dico constructor asi no me sale construcor constructor.

           $path= asset(Storage::disk('constructor')->url($archivo_guardado));
           //substr("Hello world",6);
           //$archivo_guardado = $archivo_original->storeAs($path, $file_full_name, 'drive' );

            //dd($path);

/* 
            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "constructor";
            $files = $request->file('files');
            $nombre_archivo = $request->contrato_id.'_pla_'.$_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
           // $path = Storage::url($path);*/

        } else {
            $path= $request->path_planilla;

        }   

        // grbamos en planilla

        if ($request->accion==0) {
           // insert
         
            $planilla_save = Planilla::create([
                'tipo_planilla_id'=>$request->tipo_planilla_id,
                'contrato_id'=>$request->contrato_id,
                'numero_planilla'=>$request->numero_planilla,
                'nuri_planilla'=>$request->nuri_planilla,
                'fecha_planilla'=>$request->fecha1,
                'total_planilla'=>$request->total_planilla,
                'anticipo_planilla'=>$request->anticipo_planilla,
                'retencion_planilla'=>$request->retencion_planilla,
                'referencia'=>$request->referencia,
                'path_planilla'=>$path,
            ]);


            // obtenesmos el id del ultimo insert y grabamos en planilla_documentos
                $planilla_id = $planilla_save->id;
                $document_id = $request->document_id;

                $relacion = PlanillaDocument::create([
                    'planilla_id'=>$planilla_id,
                    'document_id'=>$document_id,
                ]);
                return $planilla_save;

        } else {
            //update
           
            $planilla_update = Planilla::where("id", $request->id)
            ->update([                
                'tipo_planilla_id'=>$request->tipo_planilla_id,
                'contrato_id'=>$request->contrato_id,
                'numero_planilla'=>$request->numero_planilla,
                'nuri_planilla'=>$request->nuri_planilla,
                'fecha_planilla'=>$request->fecha1,
                'total_planilla'=>$request->total_planilla,
                'anticipo_planilla'=>$request->anticipo_planilla,
                'retencion_planilla'=>$request->retencion_planilla,
                'referencia'=>$request->referencia,
                'path_planilla'=>$path,
            ]);


            
            return $planilla_update;
        }
            

        

        //$mensaje='volviendo del backend grabar path documento '.$path;
       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Planilla::where('contrato_id',$id)->orderBy('fecha_planilla')->get();
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Planilla $planilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planilla $planilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planilla $planilla)
    {
        //
    }

}

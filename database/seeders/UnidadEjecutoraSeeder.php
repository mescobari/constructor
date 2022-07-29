<?php
namespace Database\Seeders;

use App\Models\BackEnd\intervenciones\ClaSectorial;
use App\Models\Constructor\UnidadEjecutora;
use Illuminate\Database\Seeder;

class UnidadEjecutoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $unidades = [
            
            
            ['institucion_id' => '271',  'unidad_ejecutora' =>'1', 'dir_admin_id' =>'1',  'nombre' => 'DIRECCION ADMINISTRATIVA - GASTOS DE OPERACION',  'palabras_clave'  => 'ADMINISTRATIVA GASTOS  OPERACION',  'fecha_inicial'  => '2012/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'2', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA VILLA TUNARI - ISINUTA',  'palabras_clave'  => 'VILLA TUNARI ISINUTA',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '2017/12/31',  'estado'  => 'INACTIVO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'3', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA AEROPUERTO - FASE II',  'palabras_clave'  => 'AEROPUERTO FASE COPACABANA TITO YUPANQUI',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'4', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA VELODROMO - TARIJA',  'palabras_clave'  => 'VELODROMO TARIJA GOBERNACION',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'5', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA PISCINA - TARIJA',  'palabras_clave'  => 'PISCINA TARIJA GOBERNACION',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'6', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA SEDE PARLAMENTO UNASUR',  'palabras_clave'  => 'PARLAMENTO UNASUR',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '2018/6/07',  'estado'  => 'INACTIVO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'7', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION PLANTA EMULSIONES ASFALTICAS',  'palabras_clave'  => 'EMULSIONES ASFALTICAS ASFALTOS',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'8', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION LABORATORIO',  'palabras_clave'  => 'LABORATORIO',  'fecha_inicial'  => '2016/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'9', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA PUENTE LATAMBORADA - VILLA ISRAEL',  'palabras_clave'  => 'TAMBORADA VILLA ISRAEL',  'fecha_inicial'  => '2017/01/01',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'10', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA PUENTE TAMBORADA - VILLA ISRAEL',  'palabras_clave'  => 'TAMBORADA VILLA ISRAEL',  'fecha_inicial'  => '2016/09/14',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'11', 'dir_admin_id' =>'1',  'nombre' => 'SERVICIO DE TRANSPORTE, NIVELADOY COMPACTACION',  'palabras_clave'  => 'TRANSPORTE NIVELADO COMPACTACION',  'fecha_inicial'  => '2016/09/20',  'fecha_final'  => '2017/12/31',  'estado'  => 'INACTIVO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'12', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA DOBLE VIA HUARINA - ACHACACHI',  'palabras_clave'  => 'HUARINA ACHACACHI',  'fecha_inicial'  => '2016/10/17',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'13', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA RIO SEQUE - LA CUMBRE',  'palabras_clave'  => 'RIO SEQUE CUMBRE',  'fecha_inicial'  => '2017/06/30',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'14', 'dir_admin_id' =>'1',  'nombre' => 'OBRAS COMPLEMENTARIAS PARA EL PROYECTO TAMBORADA -ETAPA I',  'palabras_clave'  => 'TAMBORADA OBRAS COMPLEMENTARIAS',  'fecha_inicial'  => '2018/03/23',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'15', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA PAVIMENTACION VIACHA - CENTRAL CHAMA - NAZACARA',  'palabras_clave'  => 'VIACHA CENTRAL CHAMA NAZACARA',  'fecha_inicial'  => '2018/06/07',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'16', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA MEJORAMIENTO SAN IGNACIO - MONTE GRANDE',  'palabras_clave'  => 'SAN IGNACIO MOXOS MONTE GRANDE',  'fecha_inicial'  => '2018/08/31',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'17', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION CONSTRUCCION CARRETERA MONTEAGUDO IPATI - TRAMO II',  'palabras_clave'  => 'MUYUPAMPA IPATI MONTEAGUDO TRAMO II',  'fecha_inicial'  => '2019/01/21',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'18', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION CONSTRUCCION DOBLE VIA EL ALTO - VIACHA',  'palabras_clave'  => 'DOBLE VIA ALTO VIACHA',  'fecha_inicial'  => '2019/03/25',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'19', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA PAVIMENTACION AV. ARICA - ABEN',  'palabras_clave'  => 'ARICA ABEN NUCLEAR',  'fecha_inicial'  => '2019/07/02',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'20', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION EJECUCION DOBLE VIA YACUIBA - CAMPO PAJOSO, FASE I',  'palabras_clave'  => 'YACUIBA CAMPO PAJOSO',  'fecha_inicial'  => '2019/08/16',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'21', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION DE LA CONSTRUCCION Y REHABILITACION TRAMO VILLAMONTES - LA VERTIENTE - PALO MARCADO',  'palabras_clave'  => 'VILLAMONTES VERTIENTE PALO MARCADO',  'fecha_inicial'  => '2019/09/19',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'22', 'dir_admin_id' =>'1',  'nombre' => 'DIRECCION ADMINISTRATIVA - PROTECCION Y MEJORAMIENTO PORTUARIO PUERTO VILLARROEL',  'palabras_clave'  => 'PROTECCION MEJORAMIENTO PORTUARIO PUERTO VILLARROEL',  'fecha_inicial'  => '2021/08/20',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],
['institucion_id' => '271',  'unidad_ejecutora' =>'23', 'dir_admin_id' =>'1',  'nombre' => 'ADMINISTRACION OBRA CONSTRUCCION, EQUIPAMIENTO E INSTALACION DE PLANTA DE ALMACENAMIENTO DE GRANOS',  'palabras_clave'  => 'SILOS PAILON GRANOS ALMACENAMIENTO PLANTA EQUIPAMIENTO',  'fecha_inicial'  => '2022/03/25',  'fecha_final'  => '1900/01/01',  'estado'  => 'APROBADO' ],


            
        ];

        foreach ($unidades as $unidad) {
			$item = (object) $unidad;
            
			$unidadEjecutora = [
				"institucion_id" => $item->institucion_id,
				"unidad_ejecutora" => $item->unidad_ejecutora,
                "dir_admin_id" => $item->dir_admin_id,
				"nombre" => $item->nombre,
				"palabras_clave" => $item->palabras_clave,
                "fecha_inicial" => $item->fecha_inicial,
				"fecha_final" => $item->fecha_final,
				"estado" => $item->estado,

			];
			UnidadEjecutora::create($unidadEjecutora);

        }

    }
}

<?php
namespace Database\Seeders;

use App\Models\CotizacionDolar;

use Illuminate\Database\Seeder;

class CotizacionDolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $institucion = [

            ['fecha'=>'2021-11-01','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-03','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-04','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-05','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-08','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-09','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-10','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-11','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-12','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-15','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-16','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-17','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-18','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-19','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-22','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-23','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-24','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-25','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-26','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-29','valor_venta'=>'6.96','valor_compra'=>'6.86'],
['fecha'=>'2021-11-30','valor_venta'=>'6.96','valor_compra'=>'6.86'],





        ];



        foreach ($institucion as $claInst) {
			$item = (object) $claInst;
			$inst = [
				"fecha" => $item->fecha,
				"valor_venta" => $item->valor_venta,
				"valor_compra" => $item->valor_compra,
			];
			CotizacionDolar::create($inst);
        }

    }
}

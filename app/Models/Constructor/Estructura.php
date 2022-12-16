<?php

//namespace App\Models\BackEnd\administracion\menu;
namespace App\Models\Constructor;



use Illuminate\Database\Eloquent\Model;
use App\Models\BackEnd\administracion\spatie\Rol;
use App\Models\BackEnd\administracion\spatie\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Estructura extends Model
{
    protected $table = "estructura";
    protected $fillable = 
    [
        'id', 
        'contrato_id',
        'nombre', 
        'descripcion', 
        'link_url', 
        'id_padre', 
        'icon_logo', 
        'icon_logo_color',
        'id_permission', 
        'orden', 
        'estado', 
        'user_create', 
        'user_update', 
        'user_delete', 
        'created_at', 
        'updated_at',
        'deleted_at',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'menu_rol');
    }

    public function getHijos($padres, $line, $tipo)
    {
        $children = [];
        foreach ($padres as $line1) {
            if($tipo == true){                
                if ($line['id'] == $line1['id_padre'] && trim($line1['estado']) == 'ACT') {
                    $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getHijos($padres, $line1, $tipo)])]);
                }
            }else{
                if ($line['id'] == $line1['id_padre']) {
                    $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getHijos($padres, $line1, $tipo)])]);
                }
            }
        }
        return $children;
    }

    public function getPadres($front)
    {
        if ($front) {
            //aqui poner las nuevas reglas de roles y permisos
            return $this->orderby('id_padre')
            ->orderby('orden')
            ->get()
            ->toArray();
        } else {
            return $this->orderby('id_padre')
                ->orderby('orden')
                ->get()
                ->toArray();
        }
    }

    public static function getMenu($front = false, $tipo = false)
    {
        
        
        $menus = new Estructura();        
        $padres = $menus->getPadres($front);
        $padres2 = [];
        if(isset(auth()->user()->id)){
            
            $user = User::where('id', auth()->user()->id)->where(DB::raw('TRIM(estado)'),'ACT')->first();
            if(!isset($user->id)){
                return [];
            }            
            if($tipo == true){                
                foreach($padres as $padre){
                    $permission = Permission::where('id', $padre['id_permission'])->first();        
                    if($user->hasPermissionTo($permission->name)==true){
                        array_push($padres2, $padre);
                    }               
                }
            }else{
                $padres2 = $padres;
            }
        }        
        $padres = $padres2;
        $menuAll = [];
        foreach ($padres as $line) {
            if ($line['id_padre'] != 0)
                break;
            $item = [array_merge($line, ['submenu' => $menus->getHijos($padres, $line, $tipo)])];
            $menuAll = array_merge($menuAll, $item);
        }
        if($tipo == true){
            $array = [];
            foreach($menuAll as $val){
                if(trim($val['estado'])=='ACT'){
                    array_push($array, $val);
                }
            }
            $menuAll = $array;
        }
        return $menuAll;
    }

    public function guardarOrden($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $value) {
            $this->where('id', $value->id)->update(['id_padre' => 0, 'orden' => $var + 1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);

                    if (!empty($vchild->children)) {
                        foreach ($vchild->children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $parent_id = $vchild->id;
                            $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);

                            if (!empty($vchild1->children)) {
                                foreach ($vchild1->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $parent_id = $vchild1->id;
                                    $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);

                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2->children as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $parent_id = $vchild2->id;
                                            $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);

                                            // if (!empty($vchild3->children)) {
                                            //     foreach ($vchild3->children as $key => $vchild4) {
                                            //         $update_id = $vchild4->id;
                                            //         $parent_id = $vchild4->id;
                                            //         $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);

                                            //         if (!empty($vchild4->children)) {
                                            //             foreach ($vchild4->children as $key => $vchild4) {
                                            //                 $update_id = $vchild4->id;
                                            //                 $parent_id = $vchild4->id;
                                            //                 $this->where('id', $update_id)->update(['id_padre' => $parent_id, 'orden' => $key + 1]);
                                            //             }
                                            //         }
                                            //     }
                                            // }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

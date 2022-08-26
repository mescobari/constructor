<template>
    <div>
        <!-- cabecera -->
        <b-button-group size="sm">
            <b-button v-b-toggle="'collapse-' + ferd_variable_collapse.id + ''" variant="outline-white" @click="cambia_clase('collapse-' + ferd_variable_collapse.id + '');">
                <i :class="'collapse-' + ferd_variable_collapse.id + ' fas fa-plus text-success'" style="font-size:0.8em"></i>
                &nbsp;
                <i class="fas fa-folder text-warning" style="font-size:1.5em"></i>
            </b-button>
            <b-button variant="outline-white">
                <div class="row">
                    <div class="col-md-9" @click="edit_observacion(ferd_variable_collapse)">                        
                        <p class="text-black" style="text-align: left; font-size:1.5em; white-space: nowrap; overflow: hidden; width: 700px; text-overflow: ellipsis;">
                            {{ferd_variable_collapse.desc_corta}}
                        </p>
                    </div>
                    <div class="col-md-3 text-rigth">   
                        <div class="btn-group">
                            <button class="btn btn-primary" title="Resultados e Indicadores" @click="resultado(ferd_variable_collapse)">
                                <span class=""><i class="fas fa-poll"></i></span>
                            </button>             
                            <!-- <button class="btn btn-info" title="Indicadores" @click="indicador()">
                                <span><i class="fas fa-clipboard-list"></i></span>
                            </button>             
                            <button class="btn btn-warning" title="Programa" @click="programa()">
                                <span><i class="fas fa-tasks"></i></span>
                            </button>    -->
                            <button class="btn btn-success" title="Adicionar Hijo" @click="adicionar_hijo(ferd_variable_collapse);" v-if="ferd_variable_collapse.objetivetype_id !== 1">
                                <span><i class="fas fa-plus"></i></span>
                            </button>
                            <button class="btn btn-success" title="Adicionar Hijo" @click="adicionar_hijo(ferd_variable_collapse);" v-else-if="ferd_variable_collapse.dependientes.length === 0">
                                <span><i class="fas fa-plus"></i></span>
                            </button>
                            <!-- <button class="btn btn-warning" title="Adicionar Hermano"  @click="adicionar_hermano();" v-if="ferd_variable_collapse.objetivetype_id !== 1 && ferd_variable_collapse.objetivetype_id !== 2">
                                <span><i class="fas fa-plus"></i></span>
                            </button> -->
                        </div>
                    </div>
                </div>
            </b-button>
        </b-button-group>
        <!-- contenido -->
        <b-collapse :id="'collapse-' + ferd_variable_collapse.id + ''">
            <b-card>     
                <div v-if="ferd_variable_collapse.dependientes.length === 0">
                    contenido/file segun doc
                </div>
                <div v-else>
                    <div v-for="dependiente in ferd_variable_collapse.dependientes" :key="dependiente.id">
                        <ferd-collapse  :ferd_variable_collapse="dependiente" @escuchaArbol="respuestaSubArbol" ref="llamarSubArbol"></ferd-collapse>
                    </div> 
                </div>                           
            </b-card>                
        </b-collapse>
    </div>
</template>

<script>
    import BootstrapVue from 'bootstrap-vue'
    Vue.use(BootstrapVue)
export default {
    data() {
        return {
            otro:false,
        }
    },  
    props:{
        ferd_variable_collapse:null ,
    },
    methods:{
        llamarSubArbol(){//funcion para llamar desde padre
            
        },
        respuestaSubArbol(tipo_objetivo_y_objetivo_seleccionado){            
            this.$emit('escuchaArbol', tipo_objetivo_y_objetivo_seleccionado);
        },
        cambia_clase(clase){
            $('.' + clase).each(function(){
                if( $(this).hasClass('text-success') ){
                    $("." + clase).removeClass("text-success");
                    $("." + clase).removeClass("fa-plus");
                    $("." + clase).addClass("text-danger");
                    $("." + clase).addClass("fa-minus");
                }else{
                    if( $(this).hasClass('text-danger') ){     
                        $("." + clase).removeClass("text-danger");
                        $("." + clase).removeClass("fa-minus");                   
                        $("." + clase).addClass("text-success");
                        $("." + clase).addClass("fa-plus");
                    }
                }
            });
        },
        async edit_observacion(objetivo){
            var respuesta = await axios.get('tipo_objetivo/' + objetivo.objetivetype_id);
            respuesta.data.forEach(element => {
                var datos = [{"tipo_objetivo":element, "objetivo":objetivo, "estado":"verModificarObjetivo"}];
                this.$emit('escuchaArbol', datos);
            });            
        },
        async resultado(objetivo){
            console.log(objetivo);
            var respuesta = await axios.get('resultado/' + objetivo.id);
            var respuesta2 = await axios.get('tipo_objetivo/' + objetivo.objetivetype_id);
            respuesta2.data.forEach(element => {
                var datos = [{"tipo_objetivo":element, "resultado":respuesta.data, "objetivo":objetivo, "estado":"verModificarResultado"}];
                this.$emit('escuchaArbol', datos);
            });   
        },
        async indicador(){
            alert("indiador");
        },
        async programa(){
            alert("programa");
        },        
        async tipos_objetivos_hijos(id_tipo_objetivo_padre){
            var respuesta = await axios.get('tipos_objetivos_hijos/' + id_tipo_objetivo_padre.objetivetype_id);
            respuesta.data.forEach(element => {
                var datos = [{"tipo_objetivo_hijo":element, "objetivo_padre":id_tipo_objetivo_padre, "estado":"agregaHijo"}];
                this.$emit('escuchaArbol', datos);
                // console.log("enmvio");
            });
        },        
        //funciones que son replica del padre
        adicionar_hijo(objetivo_padre){
            this.tipos_objetivos_hijos(objetivo_padre)
        },
        adicionar_hermano(){

        },
    },
}
</script>

<style>

</style>
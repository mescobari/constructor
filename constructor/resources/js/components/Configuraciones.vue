<template>
    <div>
    </div>
</template>

<script>
    import {en, es} from 'vuejs-datepicker/dist/locale'
export default {
    data(){
        return{
            configToolBarEditText: [
                [{ font: [] }],
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],//mismo que tamaño pequeño, mediano y grande pero esta tiene seis niveles
                // [{ size: ["small", "large", "huge"] }],    //misma que tamaño 1-6 pero esta solo seria pequeño, mediano y grande
                ["bold", "italic", "underline", "strike"], // toggled buttons
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                ["link"],
                // ["link", "image", "video"],//comentamos por que no quiero que se cargue imagenes ni video
                ["clean"] // remove formatting button
            ],
            configFechas:{
                nombreClaseParaModal:"clase-modal-datepicker",
                nombreClaseParaInput:"clase-input-datepicker",
                en: en,
                es: es,
                DatePickerFormat: 'dd/MMMM/yyyy',
                disablesFullDate: {
                    to: new Date(1987, 5, 25), //ojo los meses menos uno //fecha desde
                    from: new Date(1987, 5, 25), //fecha hasta
                },
                fecha:'2021-05-05',
                placeholder:"Selecione Fecha",
                placeholderDisbled:"Fecha Bloqueada",
                format:"dd-MM-yyyy",
                IconoBotonBorrar:"fa fa-times-circle fa-1x text-danger",
                IconoBotonAbrir: "fa fa-calendar-alt fa-1x text-success",
                typeable:false,//bloquear edicion por teclado
                disabledDates:{},
            },
                 
            actions: [//botones ejem el de descarga
                {
                    btn_text: "Download",
                    event_name: "on-download",
                    class: "btn btn-primary my-custom-class",
                    event_payload: {
                        msg: "my custom msg"
                    }
                }
            ],
            classes: {//clases para la tabla
                tableWrapper: "outer-table-div-class wrapper-class-two",
                table : {
                    "table-striped my-class" : true,
                    "table-striped my-class-two" : function(rows) {
                        return true
                    }
                },
                row : {
                    "my-row my-row2" : true,
                    "function-class" : function(row) {
                        return row.id == 1
                    }
                },
                cell : {
                    "my-cell my-cell2" : true,
                    "text-danger" : function(row,column,cellValue) {
                        return column.name == "salary" && row.salary > 2500
                    }
                }
            },     
            configTablas: {
                actions: [//botones ejem el de descarga
                    {
                        btn_text: "Download",
                        event_name: "on-download",
                        class: "btn btn-primary my-custom-class",
                        event_payload: {
                            msg: "my custom msg"
                        }
                    }
                ],
                classesTablas: {//clases para la tabla
                    tableWrapper: "outer-table-div-class wrapper-class-two",
                    table : {
                        "table-striped my-class" : true,
                        "table-striped my-class-two" : function(rows) {
                            return true
                        }
                    },
                    row : {
                        "my-row my-row2" : true,
                        "function-class" : function(row) {
                            return row.id == 1
                        }
                    },
                    cell : {
                        "my-cell my-cell2" : true,
                        "text-danger" : function(row,column,cellValue) {
                            return column.name == "salary" && row.salary > 2500
                        }
                    }
                }, 
                card_mode: false,
                card_title: "Vue Bootsrap 4 advanced table",
                checkbox_rows: false,
                rows_selectable: false,
                global_search:  {
                    placeholder:  "Buscar...",
                    visibility: true,
                    case_sensitive:  true,
                    showClearButton: true,
                },
                show_refresh_button:  false,
                show_reset_button:  false,
                
                pagination: true, // default true
                pagination_info: true, // default true
                num_of_visibile_pagination_buttons: 7, // default 5
                per_page: 10, // default 10
                per_page_options:  [5,  10,  20,  30, -1],
            },
        }
    },  
    props:{
        datosEnviarConfiguracion:null ,
    },
    methods: {
        RecuperaConfig(){
            var configuracion = {
                'configFechas':this.configFechas,
                'configTablas':this.configTablas,
                'configTablasAction':this.actions,
                'configTablasClases':this.classes,
                'configToolBarEditText':this.configToolBarEditText,
            };
            this.$emit('enviaConfiguracionHijoAPadre', configuracion);
        },
    },
}
</script>

<style>

</style>
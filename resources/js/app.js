require('./bootstrap');
// require('admin-lte');//al parecer esto evitaba que el menu desplegable de lte oculte y muestre (ese menenu de tres lineas horizontales  que muestra y oculta todo el sider)

window.Vue = require('vue').default;
axios = require('axios').default;
Vue.config.devtools = false;//quitar mensaje molesto habilita si quieres ver el mensaje "att fercho"
Vue.config.productionTip = false;//quitar mensaje molesto hecho por ferdy fercho
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example', require('./components/ExampleComponent.vue').default);
// Vue.component('indexIntervencion', require('./components/Index-Intervencion.vue').default);


//pruebas
Vue.component('netstable', require('./components/Netstable.vue').default);
//constructor
Vue.component('unidad-ejecutora', require('./constructor/unidades_ejecutoras.vue').default);
Vue.component('contrato-principal', require('./constructor/contrato_principal.vue').default);

//componentes
Vue.component('alert', require('./components/Alerta.vue').default);
Vue.component('alert-confirmacion', require('./components/AlertaConfirmacion.vue').default);
Vue.component('alertMensaje', require('./components/AlertaMensaje.vue').default);
Vue.component('configuraciones', require('./components/Configuraciones.vue').default);
Vue.component('ferdCollapse', require('./components/ferCollapse.vue').default);
//paginas
Vue.component('datos-generales', require('./registroProyectos/IdentificacionDatosGenerales.vue').default);
Vue.component('ubicacion', require('./registroProyectos/IdentificacionUbicacion.vue').default);
Vue.component('cofinanciador', require('./registroProyectos/IdentificacionCofinanciador.vue').default);
Vue.component('marcoLogico', require('./registroProyectos/IdentificacionMarcoLogico.vue').default);
Vue.component('estructuraFinanciamiento', require('./registroProyectos/IdentificacionEstructuraYFinanciamiento.vue').default);
Vue.component('documentosLegales', require('./registroProyectos/IdentificacionDocumentosLegales.vue').default);

Vue.component('formulacionPoa', require('./registroProyectos/PlanificacionFormulacionPoa.vue').default);
Vue.component('poaCollapse', require('./components/poaCollapse.vue').default);

Vue.component('reportes', require('./reportes/Reporte.vue').default);
Vue.component('responsable', require('./registroProyectos/IdentificacionResponsable.vue').default);
Vue.component('reportesDocumentosLegales', require('./reportes/IndexReportesDocumentosLegales.vue').default);

Vue.component('suscripcionPoa', require('./registroProyectos/PlanificacionSuscripcionPoa.vue').default);
Vue.component('seguimientoFinanciero', require('./registroProyectos/SeguimientoFinanciero.vue').default);
Vue.component('seguimientoFisico', require('./registroProyectos/SeguimientoFisico.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

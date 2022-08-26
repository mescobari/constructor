<template>    
    <div>
        <vue-nestable v-model="nestableItems" @change="ver();">
            <vue-nestable-handle
                slot-scope="{ item }"
                :item="item">
                {{ item.text }}
            </vue-nestable-handle>
        </vue-nestable>
    </div>
</template>

<script>
import { VueNestable, VueNestableHandle } from 'vue-nestable';
export default {
    data () {
        return {
            nestableItems: [{
                id: 0,
                text: 'Andy'
            }, {
                id: 1,
                text: 'Harry',
                children: [{
                    id: 2,
                    text: 'David'
                }]
            }, {
                id: 3,
                text: 'Lisa'
            }]
        }
    },
    methods: {
        ver(){
            console.log(this.nestableItems);
        }
    },
    components: { 
        VueNestable ,
        VueNestableHandle
    }
}
</script>

<style>

</style>
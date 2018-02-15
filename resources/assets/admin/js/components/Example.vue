<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component {{ tempo }} </div>
                    {{ teste }}

                    <div class="panel-body">
                        Eduardo Mattos 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                tempo: Date.now(),
                teste: "VueJs"
            }
        },
        created(){
            console.log('created');
        },
        ready(){
            console.log('ready');
        }
    }
</script>

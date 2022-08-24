<template>
    <div class="row">
        <div class="col-lg-6 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">

                            <div class="chartjs-bar-wrapper mt-3">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <div  :key="count" style="display: block;height: 506px;max-height: 506px;min-height: 506px" class="certification-render-monitor some-selector">
                                    <div class="screenshot-border"></div>
                                    <img class="img-fluid" :src="image || null"/>
                                    <div v-for="(draggable,key) in draggables"
                                        :item="`${key}`"
                                        :id="`myDraggable${draggable.id || (draggable.key ? draggable.key : 0)}`"
                                        :class="['draggable' , views.indexOf(key) != -1 ? 'trans' : '' ]"
                                        :key="draggable.id || (draggable.key ? draggable.key : 0)"
                                        :data-x="draggable.transformX ? draggable.transformX : 0"
                                        :data-y="draggable.transformY ? draggable.transformY : 0"
                                        :f="draggable.view"
                                        :style="{  color     : `${draggable.color_text}`,
                                                   fontSize  : `${draggable.font_size_text}px`,
                                                   direction : `${draggable.direction_text}`,
                                                   textAlign : `${draggable.text_align}`,
                                                   transform : `translate(${draggable.transformX ? draggable.transformX : 0}px,${draggable.transformY ? draggable.transformY : 0}px)`,
                                                   width     : `${draggable.width_box  ? draggable.width_box : 0}px`,
                                                   height    : `${draggable.height_box ? draggable.height_box : 0}px`,
                                                   fontFamily: `${draggable.font ? draggable.font.font_family : '' }`
                                                 }">
                                            <link rel="stylesheet" v-if="draggable.font" :href="`${draggable.font.full_url_file || draggable.font.cdn_font_url}`" defer/>
                                            <template v-if="draggable.type_field == 1" >
                                                {{ data[draggable.id].value || null }}
                                            </template>

                                            <template v-if="draggable.type_field == 3">
                                                {{ (data[draggable.id].value || null) | FormatDateRules(draggable) }}
                                            </template>

                                            <template v-if="draggable.type_field == 2">
                                                <img v-if="data[draggable.id].value" :src="[data[draggable.id].value]"
                                                     :style="{
                                                        width     : `${draggable.image_width  ? draggable.image_width : 0}%`,
                                                        height    : `${draggable.image_height ? draggable.image_height : 0}%`
                                                }"/>
                                            </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            screenX: 0,
            screenY: 0,
            options:{
                edit:-1,
                target:null,
                type_field:1,
                font:null
            },
            deletes:[],
            draggables:[],
            index:0,
            errors:[],
            views:[],
            count:1
        };
    },
    props: ["certification","image",'Fonts','data'],
    created:function(){
        let self = this;
        this.draggables = this.certification.options;
    }
}
</script>
<style>
.list-item{
    padding: 10px;
    border: 12px solid #eee;
}
.card-title-dash{
    padding:10px 0px;
}
.draggable {
  width: 120px;
  padding: 12px 10px;
  margin: 1rem;
  background-color: transparent;
  color: white;
  font-size: 20px;
  font-family: sans-serif;
  touch-action: none;
  /* position: relative;
  display: inline-block; */
  /* This makes things *much* easier */
  box-sizing: border-box;
  /*border-radius: 30px;*/
}
.trans{
    background-color: transparent !important;
}
.screenshot-border{
    position: absolute;
    left: 30px;
    right: 15px;
    background-color: transparent;
    top: 32px;
    bottom: 18px;
}
</style>

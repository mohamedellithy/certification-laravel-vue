<template>
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 col-sm-9">
                <label class="col-form-label">{{ title }}</label>
                <input name="image"
                       @change="uploadImage($event)"
                       :key="fileInputKey"
                       type="file"
                       class="form-control">

            </div>
            <div class="col-md-4 col-sm-12 container-image" v-if="(preview_image != null ) || (fileImage == true ? require('../file-font-icon.png') : (savedImage ? savedImage.path_url : null))">
                <img  class="img-fluid img-thumbnail"
                      :src="preview_image || (fileImage == true ? require('../file-font-icon.png') : (savedImage ? savedImage.path_url : null))" />

                <button v-if="fileImage != true" type="button"
                        class="btn btn-primary btn-sm"
                        data-toggle="modal"
                        data-target="#exampleModal"
                        data-whatever="@mdo">
                        {{__('dashboard.Preview_Image')}}
                </button>

                <i v-if="fileImage != true" class="mdi mdi-close-circle remove-image"
                   @click="removeImage">
                </i>

                <input type="hidden"
                       name="image-info"
                       v-model="ok_details"/>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 image-frame">
                                    <img class="img-fluid"
                                         :src="preview_image || (fileImage == true ? require('../file-font-icon.png') : (savedImage ? savedImage.path_url : null))"/>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('dashboard.title') }}:</label>
                                        <input v-model="image_details.title"
                                               type="text"
                                               class="form-control"
                                               id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{__('dashboard.alt') }}:</label>
                                        <input v-model="image_details.alt"
                                               type="text"
                                               class="form-control"
                                               id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{__('dashboard.description')}}:</label>
                                        <textarea v-model="image_details.description_image"
                                               type="text"
                                               class="form-control"
                                               id="recipient-name"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('dashboard.save_and_close')}}</button>
                    <button type="button" class="btn btn-primary" @click="clearInfo($event)">{{__('dashboard.clear_info') }}</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        savedImage:{
            default:null,
            type:Object
        },
        title:{
            default:'تحميل البطاقة',
            type:String
        },
        fileImage:{
            default:null,
            type:String
        }
    },
    data(){
        return {
            fileInputKey:0,
            image :null,
            preview_image:null,
            image_details:{
                title:'',
                alt:'',
                description_image:''
            },
            ok_details:null
        };
    },
    methods:{
        uploadImage(event){
            this.image         = event.target.files[0];
            this.preview_image = (this.fileImage == true ? require('../file-font-icon.png') : URL.createObjectURL(this.image));
            console.log(this.preview_image);
        },
        removeImage(event){
            this.fileInputKey++;
            this.preview_image = null;
            if(this.savedImage){
                let params = new FormData();
                params.append('image_id',this.savedImage.id);
                this.axios.post('/destroy-image-certification',params).then(function({data}){
                    console.log(data);
                }).catch(function({response}){
                    console.log(response);
                });
                this.savedImage    = null;
            }
            console.log("removed");
        },
        clearInfo(event){
            this.image_details = {};
        },
        DownloadFile(){
           
        }
    },
    mounted(){
        this.image_details.title = this.savedImage.title;
        this.image_details.alt   =this.savedImage.alt;
        this.image_details.description_image =this.savedImage.description;
        console.log(this.savedImage);
    },
    watch:{
        image_details:function(value){
            this.ok_details = JSON.stringify(value);
        }
    }
}
</script>
<style type="text/css" scoped>
.container-image
{
    height: 150px;
    width: 200px;
    border: 4px solid white;
    padding:10px;
}
.container-image img
{
    /* width: 100%;
    height: 100%; */
}
.container-image button
{
    margin: 10px 0px;
}
.container-image .remove-image{
   cursor: pointer;
}
.modal-body .form-group{
    margin-bottom: 0px !important;
}
.modal-body .form-group label
{
    font-weight: bold;
}
.img-fluid {
    max-width: 70%;
    margin: auto;
}
.image-frame{
    text-align: center;
    background-color: #eee;
    padding: 23px;
}
.modal .modal-dialog .modal-content .modal-body {
    padding: 5px 10px;
}
.modal .modal-dialog .modal-content .modal-header {
    padding: 7px 17px;
}
</style>

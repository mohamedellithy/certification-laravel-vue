<template>
    <div class="container py-5">
        <div class="overflow-show-certification" v-show="preview_certification">
            <button @click="preview_certification = null" class="btn btn-danger btn-sm" style="margin: 12px;">{{__('master.close_preview')}}</button>
            <img class="img-fluid" :src="preview_certification_url" />
        </div>
        <div class="loading" v-if="generate_launch == 1">
            <img :src="require('../Double Ring-1s-217px2.gif')" />
            <p style="font-size: 20px; line-height: 2em">
                توليد البطاقات ....
            </p>
        </div>
        <h2 class="section-heading">
            {{ __("master.Generate_Certification") }}
            <a
                :href="['/' + certification.department.slug]"
                class="forward-back"
            >
                <img :src="require('../wrap-forward-svgrepo-com.svg')" />
                {{ __("master.back_to_certifications") }}
            </a>
        </h2>
        <form
            method="post"
            @submit.prevent="GenerateCertification()"
            enctype="multipart/form-data"
        >
            <div class="row container-certification text-center">
                <div
                    class="bar-fields col-md-8"
                    v-if="this.certification.options.length > 0"
                >
                    <h5 class="second-title">{{ __("master.Import_Data") }}</h5>
                    <div
                        class="alert alert-success"
                        v-if="results.success == 1"
                    >
                        {{ __("master.Certification_Generated_successfully") }}
                    </div>
                    <div
                        class="alert alert-danger"
                        v-if="results.success == -1"
                    >
                        Opps! , {{ results.message }}
                    </div>
                    <div class="row frame-fields">
                        <div
                            class="col-md-12"
                            v-for="(options, key) in Fields"
                            :key="key"
                        >
                            <div class="col-12 actions" v-if="options != null">
                                <td colspan="10">
                                    <div class="form-group text-right">
                                        <img
                                            v-if="key != 0"
                                            @click="deleteField(key, options)"
                                            class="img-fluid copy-field"
                                            :src="
                                                require('../delete-svgrepo-com.svg')
                                            "
                                        />
                                        <img
                                            v-if="
                                                certification.multi_generate ==
                                                    1
                                            "
                                            @click="copyField(key)"
                                            class="img-fluid copy-field"
                                            :src="
                                                require('../copy-svgrepo-com.svg')
                                            "
                                        />
                                    </div>
                                </td>
                            </div>
                            <div
                                class="col-12 container-groups"
                                v-if="options != null"
                            >
                                <div
                                    v-for="(option, index) in options"
                                    :key="index"
                                    :class="[
                                        'col-lg-12 container-form-group '
                                    ]"
                                >
                                    <div class="form-group">
                                        <label>
                                            <img
                                                style="width: 20px"
                                                :src="
                                                    require('../star-svgrepo-com.svg')
                                                "
                                            />
                                            {{ option.field_name }}</label
                                        >
                                        <template v-if="option.type_field == 1 && option.type_input == 0">
                                            <input
                                                rows="20"
                                                type="text"
                                                class="form-control"
                                                name="value"
                                                v-model="
                                                    Values[key][`val${index}`][
                                                        `field_value${key}`
                                                    ]
                                                "
                                            />
                                        </template>

                                        <template v-if="option.type_field == 1 && option.type_input == 1">
                                            <textarea
                                                rows="50"
                                                style="min-height: 130px;"
                                                type="text"
                                                class="form-control"
                                                name="value"
                                                v-model="
                                                    Values[key][`val${index}`][
                                                        `field_value${key}`
                                                    ]
                                                "
                                            ></textarea>
                                        </template>

                                        <template v-if="option.type_field == 3">
                                            <input
                                                type="date"
                                                class="form-control"
                                                name="value"
                                                v-model="
                                                    Values[key][`val${index}`][
                                                        `field_value${key}`
                                                    ]
                                                "
                                            />
                                        </template>

                                        <template v-if="option.type_field == 2">
                                            <img
                                                :id="
                                                    `img${option.id}${index}${key}`
                                                "
                                                class="img-fluid img-field"
                                                :src="
                                                    Values[key][`val${index}`][
                                                        `img_preview${key}`
                                                    ]
                                                "
                                            />
                                            <div class="container-upload-btn">
                                                <button
                                                    style="width: 100%"
                                                    type="button"
                                                    class="btn btn-info upload-new"
                                                >
                                                    {{
                                                        __(
                                                            "master.Upload_Image"
                                                        )
                                                    }}
                                                </button>
                                                <input
                                                    type="file"
                                                    @change="
                                                        UploadImage(
                                                            $event,
                                                            key,
                                                            index,
                                                            option.id
                                                        )
                                                    "
                                                    class="form-upload"
                                                    name="value"
                                                />
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center container-button">
                        <button type="submit" class="btn btn-success btn-sm">
                            {{
                                __(
                                    "master.Generate_Certifications_and_Download"
                                )
                            }}
                        </button>
                        <button
                            type="button"
                            @click="generatePDF"
                            class="btn btn-warning btn-sm"
                        >
                            {{ __("master.Generate_pdf") }}
                        </button>
                        <button
                            type="button"
                            @click="previewImage"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __("master.preview_image") }}
                        </button>
                        <button
                            type="button"
                            @click="ResetFields"
                            class="btn btn-danger btn-sm"
                        >
                            {{ __("master.Reset_Fields") }}
                        </button>
                    </div>
                </div>
                <div class="bar-fields col-md-8" v-else>
                    <p class="alert alert-info">
                        {{ __("master.certification_not_have_any_Fields") }}
                    </p>
                </div>
                <div class="text-left frame-image-preview col-md-4">
                    <img
                        class="image-certification-preview"
                        :src="certification.image.path_url"
                    />
                    <div class="overview-certification">
                        <ul class="overview-static">
                            <li>
                                <img
                                    :src="
                                        require('../orders-order-svgrepo-com.svg')
                                    "
                                />
                                <strong
                                    >20102
                                    <p>
                                        {{
                                            __(
                                                "master.Certification_is_visites"
                                            )
                                        }}
                                    </p></strong
                                >
                            </li>
                            <li>
                                <img
                                    :src="
                                        require('../certificate-svgrepo-com.svg')
                                    "
                                />
                                <strong
                                    >20102
                                    <p>
                                        {{
                                            __("master.Download_Certification")
                                        }}
                                    </p></strong
                                >
                            </li>
                        </ul>
                        <h6 class="certification-title">
                            {{ certification.name }}
                        </h6>
                        <p class="certification-description">
                            {{ certification.description }}
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: {
        certification: {
            default: {},
            type: Object,
            componentKey: 0
        }
    },
    data() {
        return {
            Fields: [],
            Values: [],
            index: 0,
            preview: null,
            rand: null,
            generate_launch: 0,
            preview_certification:null,
            preview_certification_url:null,
            results: {
                success: null,
                message: null
            }
        };
    },
    mounted() {
        let self = this;
        let item = [];
        this.certification.options.forEach(function(value, key) {
            item[`val${key}`] = {};
            item[`val${key}`]["field_value0"] = null;
            item[`val${key}`]["field_id0"] = value.id;
        });
        this.Values.push(item);
        this.Fields.push(this.certification.options);
    },
    methods: {
        copyField: function(key) {
            let self = this;
            // push fields row
            this.Fields.push(this.Fields[key]);
            // next inputs row
            this.index += 1;
            // container next inputs row
            let item = [];
            // defined that next input will be object type
            item[this.index] = [];
            // foreach all keys of previouse index copied input fields
            Object.keys(this.Values[key]).forEach(function(val) {
                // set key in vaiable
                let value = `field_value${key}`;
                // defined as object
                item[self.index][val] = {};
                // set values
                item[self.index][val][`field_value${self.index}`] =
                    self.Values[key][val][value];
                item[self.index][val][`field_id${self.index}`] =
                    self.Values[key][val][`field_id${key}`];
                if (self.Values[key][val][`img_preview${key}`]) {
                    item[self.index][val][`img_preview${self.index}`] =
                        self.Values[key][val][`img_preview${key}`];
                }
                // for text and track
                // console.log(item);
            });
            // push new row input to new row
            this.Values.push(item[this.index]);
            console.log(this.Values);
        },
        deleteField: function(key, options) {
            console.log(key);
            this.Values.splice(key, 1, null);
            this.Fields.splice(key, 1, null);
            console.log(this.Fields);
            console.log(this.Values);
        },
        UploadImage: function(event, key, index, field_id) {
            this.Values[key][`val${index}`][`field_value${key}`] =
                event.target.files[0]; //Object.assign({},event.target.files[0]);
            this.Values[key][`val${index}`][`field_id${key}`] = field_id;
            this.Values[key][`val${index}`][
                `img_preview${key}`
            ] = URL.createObjectURL(event.target.files[0]);
            document
                .getElementById(`img${field_id}${index}${key}`)
                .setAttribute(
                    "src",
                    URL.createObjectURL(event.target.files[0])
                );
        },
        GenerateCertification: function(type = "jpg", download = 1) {
            let self = this;
            let values = [];
            let certification_data = new FormData();
            // set extension with type
            let extension = type;
            let params = {};
            this.generate_launch = 1;
            this.Values.forEach(function(value, key) {
                if (value) {
                    Object.values(value).forEach(function(v, k) {
                        if (v) {
                            if (v[`img_preview${key}`]) {
                                certification_data.append(
                                    `image${key}${v[`field_id${key}`]}`,
                                    v[`field_value${key}`]
                                );
                            }
                        }
                    });
                    values.push(Object.assign({}, value));
                } else {
                    values.push(null);
                }
            });
            certification_data.append("attr", JSON.stringify(values));
            certification_data.append(
                "certification_id",
                this.certification.id
            );
            certification_data.append("type", type);
            certification_data.append("download", download);
            if (this.rand) {
                certification_data.append("rand", this.rand);
            }

            // set extension
            if (values.length > 1) {
                extension = "zip";
            }

            // set download
            if (download == 1) {
                params = {
                    responseType: "blob"
                };
            }

            this.axios
                .post(`/generate/certifications`, certification_data, params)
                .then(function({ data }) {
                    console.log(data);
                    self.generate_launch = 0;
                    self.rand = data.rand || null;
                    self.results.success = 1;

                    if (download == 1) {
                        // download file
                        let fileURL = window.URL.createObjectURL(
                            new Blob([data])
                        );
                        let fileLink = document.createElement("a");
                        fileLink.href = fileURL;
                        fileLink.setAttribute(
                            "download",
                            "Certification." + extension
                        );
                        document.body.appendChild(fileLink);
                        fileLink.click();
                    } else if (download == 0) {
                        // preview file
                        let fileLink = document.createElement("a");
                        // fileLink.href = data;
                        // fileLink.setAttribute("target", "_blank");
                        // document.body.appendChild(fileLink);
                        // fileLink.click();
                        self.preview_certification = true;
                        self.preview_certification_url = data;
                    }
                })
                .catch(function({ response }) {
                    console.log(response);
                    self.generate_launch = 0;
                    self.results.success = -1;
                    self.results.message = response.data
                        ? response.data.message
                        : self.__("master.somethings_wrong_happends");
                });
        },
        generatePDF: function() {
            this.GenerateCertification("pdf");
        },
        previewImage: function() {
            this.GenerateCertification("jpg", 0);
        },
        ResetFields: function() {
            window.location.reload();
        }
    }
};
</script>
<style scoped>
.overflow-show-certification{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #0e0d0d66;
    z-index:100;
    padding: 40px;
    overflow: auto;
    direction: ltr;
}
.alert {
    text-align: right;
}
h1,
.h1,
h2,
.h2,
h3,
.h3,
h4,
.h4,
h5,
.h5,
h6,
.h6 {
    color: #424243;
    font-weight: bold;
}
.section-heading {
    font-size: 1.5rem;
    padding: 0px 18px;
    color: #ea802a;
}
.container-certification {
    padding: 10px 30px;
    background-color: #fcfdfe;
    /*border: 5px solid #ffc107;*/
}
h5.second-title {
    line-height: 2.5em;
    text-align: right;
}
.bar-fields {
    text-align: left !important;
    background-color: white;
    padding: 30px;
    /*box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;*/
    border: 6px dashed #eee;
}
label {
    height: 2em;
    font-size: 13px;
}
.form-control {
    border-radius: 11px;
    border: 2px solid #89b0a9;
    min-height: 70px;
    background-color: #f5f5f5;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
}
.frame-fields {
    background-color: white;
    width: 100%;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    padding: 41px 11px;
}
.frame-fields .form-group {
    padding: 10px;
    text-align: left;
}
.container-button {
    padding: 30px;
}
table tr:not(.actions) {
    background-color: white;
    border: 6px solid #eee;
    border-top: 0px solid #eee;
}
table tr.actions {
    border: 6px solid #eee;
    border-bottom: 0px solid #eee;
    text-align: right !important;
}
.copy-field {
    width: 30px;
    cursor: pointer;
}
.frame-image-preview .image-certification-preview {
    width: 100% !important;
}
.frame-image-preview {
    text-align: left;
}
.container-upload-btn {
    position: relative;
}
input.form-upload {
    opacity: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    right: 0;
    top: 11px;
    cursor: pointer;
    background-color: red;
}
button.upload-new {
    font-size: 13px;
    padding: 8px 8px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    color: white;
}
.img-field {
    width: 100px;
    margin: 13px;
    /* margin-right: 100% !important; */
}
.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #396c68;
    text-align: right;
}
.form-group input[type="file"] {
    /* margin-right: 100%; */
}
.form-group.text-right {
    text-align: right;
}
.loading {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    text-align: center;
    background-color: #ffffff96;
    z-index: 100000;
}
.loading img {
    position: relative;
    top: 35%;
}
.overview-certification {
    padding: 16px 18px;
    background-color: white;
    margin: 10px 0px;
    border: 1px solid #eee;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    text-align: right;
    color: gray;
}
.overview-certification .certification-title {
    font-size: 19px;
    line-height: 2.5em;
    color: #1a5a3c;
    font-weight: 200;
}
.overview-certification .certification-description {
    font-size: 15px;
}
.overview-static {
    display: inline-flex;
    text-align: center;
    /* padding-left: 0px;*/
    background-color: #eee;
    padding: 35px;
}
.overview-static li {
    display: inline-block;
    width: auto !important;
    padding: 8px 7px;
}
.overview-static img {
    width: 40%;
    display: block;
    text-align: center;
    margin: auto;
}
.overview-static strong {
    line-height: 2em;
    font-size: 13px;
    color: #454444;
}
.overview-static strong p {
    line-height: 1.2em;
    font-size: 13px;
    color: #2e9483;
}
.forward-back {
    width: 38px;
    font-size: 15px;
    cursor: pointer;
    color: #848381;
    text-decoration: none;
}
.container-form-group {
    display: inline-flex !important;
    text-align: right;
    direction: rtl;
}
.col-lg-12.container-form-group,
.col-12.container-form-group {
    display: block !important;
}
.container-groups {
    text-align: right;
    direction: rtl;
}
.container-button button {
    padding: 12px 21px;
    display: inline-block;
    margin: 10px;
    text-align: center;
}

@media (min-width: 1200px) {
    .forward-back {
        margin-right: 50%;
    }
}
@media (max-width: 800px) {
    .frame-fields {
        box-shadow: none !important;
        padding: 7px 0px;
        border: 2px dashed #eee;
    }
    .container-button {
        padding: 5px;
        text-align: center;
    }
    .container-button button {
        padding: 6px 13px;
        display: block;
        margin: 10px auto;
        text-align: center;
    }
    .container-groups {
        text-align: center;
    }
}
</style>

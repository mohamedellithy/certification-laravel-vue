<template>
    <div class="row">
        <div class="loading" v-if="saved_launch == 1">
            <img :src="require('../Double Ring-1s-217px2.gif')"/>
            <p style="font-size: 20px;line-height: 2em;"> حفظ الاعدادات ...  </p>
        </div>
        <div class="col-lg-12 d-flex flex-column container-certification-image">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash"> {{ certification.name }}</h4>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button @click="saveCustomize" class="btn btn-success btn-md" type="button" id="dropdownMenuButton2" > {{__('dashboard.save_customize') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-bar-wrapper mt-3">
                                <div id="certificationOverview" :style="{
                                    display: `block`,
                                    height : `${height}px` || `auto`,
                                    width  : `${width}px` || `auto`,
                                    }" class="certification-render-monitor">
                                    <img :style="{
                                            height : `${height}px` || `auto`,
                                            width  : `${width}px` || `auto`,
                                            }"
                                    :src="this.image"/>
                                    <div v-for="(draggable,key) in draggables" @click="EditOption(draggable,key)"
                                        :item="`${key}`"
                                        :id="`myDraggable${draggable.id || (draggable.key ? draggable.key : 0)}`"
                                        :class="['draggable' , views.indexOf(key) != -1 ? 'trans' : '' ]"
                                        :key="draggable.id || (draggable.key ? draggable.key : 0)"
                                        :data-x="draggable.transformX ? draggable.transformX : -69.6"
                                        :data-y="draggable.transformY ? draggable.transformY : -206.2"
                                        :f="draggable.view"
                                        :style="{  color     : `${draggable.color_text} !important`,
                                                   fontSize  : `${draggable.font_size_text}px !important`,
                                                   textAlign : `${draggable.text_align} !important`,
                                                   direction : `${draggable.direction_text} !important`,
                                                   transform : `translate(${draggable.transformX ? draggable.transformX : -206.2}px,${draggable.transformY ? draggable.transformY : -69.6}px) !important`,
                                                   width     : `${draggable.width_box  ? draggable.width_box : 50}px !important`,
                                                   height    : `${draggable.height_box ? draggable.height_box : 50}px !important`,
                                                   fontFamily: `${draggable.font ? draggable.font.font_family : '' } !important`
                                                 }">
                                                <link rel="stylesheet" v-if="draggable.font" :href="`${draggable.font.full_url_file || draggable.font.cdn_font_url}`" defer/>
                                            <template v-if="draggable.type_field == 1" >
                                                {{ draggable.text_for_test || ''  }}
                                            </template>

                                            <template v-if="draggable.type_field == 3">
                                                {{ draggable.text_for_test | FormatDateRules(draggable) }}
                                            </template>

                                            <template v-if="draggable.type_field == 2">
                                                <img :src="require('../image_here.jpg')"
                                                     :style="{
                                                        width     : `${draggable.image_width  ? draggable.image_width : 0}%`,
                                                        height    : `${draggable.image_height ? draggable.image_height : 0}%`
                                                }"/>
                                            </template>

                                        <i @click="DeleteOptions(draggable,key)"
                                           class="mdi mdi-delete-sweep options-delete"></i>

                                        <i @click="viewDraggable(key)"
                                           :class="[views.indexOf(key) == -1 ? 'mdi mdi-eye' : 'mdi mdi-eye-off','options-view']"></i>

                                        <div class="alert alert-default alert-setting" v-if="edit_element == key && draggable.type_field == 1">
                                            <div class="row" style="">
                                                <ul class="col-12 list-unstyled setting-list">

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FieldName') }}</label>
                                                            <input type="text" class="form-control form-control-xs" placeholder="Field Name" name="field_name" v-model="options.field_name">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.MaxWords')}}</label>
                                                            <input type="number" class="form-control form-control-xs" placeholder="-1" name="max_words" v-model="options.max_words">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.MinWords')}}</label>
                                                            <input type="number" class="form-control form-control-xs" placeholder="-1" name="min_words" v-model="options.min_words">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.Maxcharacters')}}</label>
                                                            <input type="number" class="form-control form-control-xs" placeholder="-1" name="max_characters" v-model="options.max_characters">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('dashboard.Mincharacters') }}</label>
                                                            <input type="number" class="form-control form-control-xs" placeholder="-1" name="min_characters" v-model="options.min_characters">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.ColorText')}}</label>
                                                            <input type="color" class="form-control form-control-xs" placeholder="#0000000" name="color_text" v-model="options.color_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FontSizeText')}} ( <strong>{{__('dashboard.sizebypx')}}</strong> ) </label>
                                                            <input type="text" class="form-control form-control-xs" placeholder="12px" name="font_size_text" v-model="options.font_size_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.Font')}}</label>
                                                            <select @change="setFont($event)" class="form-control form-check-input" placeholder="font type" name="font_id" v-model="options.font_id" style="width: 100%;">
                                                                <option v-for="(Font,key) in Fonts"
                                                                        :key="key"
                                                                        :value="Font.id"
                                                                        :font="JSON.stringify(Font)"> {{ Font.name }} </option>
                                                            </select>
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.DirectionText')}}</label>
                                                            <input type="text" class="form-control form-control-xs" placeholder="RTL or RTL" name="direction_text" v-model="options.direction_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.long_text')}}</label>
                                                            <input type="checkbox" placeholder="RTL or RTL" name="type_input" v-model="options.type_input" :value="1">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.textAlign')}} </label>
                                                            <select class="form-control form-check-input" placeholder="Text align" v-model="options.text_align" style="width: 100%;">
                                                                <option value="right" selected>{{ __('master.right') }}</option>
                                                                <option value="left">{{ __('master.left') }}</option>
                                                                <option value="center">{{ __('master.center') }}</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="alert alert-default alert-setting" v-if="edit_element == key && draggable.type_field == 3">
                                            <div class="row">
                                                <ul class="col-12 list-unstyled setting-list">
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FieldName') }}</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="Field Name" name="field_name" v-model="options.field_name">
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FormateDate')}} </label>
                                                            <select class="form-control form-check-input" name="formate_date" v-model="options.formate_date" style="width: 100%;">
                                                                <option selected      > default </option>
                                                                <option value="M/D/Y" >MM/DD/YY</option>
                                                                <option value="D/M/Y" >DD/MM/YY</option>
                                                                <option value="Y/M/D" >YY/MM/DD</option>
                                                                <option value="M-D-Y" >MM-DD-YY</option>
                                                                <option value="D-M-Y" >DD-MM-YY</option>
                                                                <option value="Y-M-D" >YY-MM-DD</option>
                                                                <option value="m d, y">Month Day, Year</option>
                                                                <option value="D m, y">D Month, Year</option>
                                                                <option value="y, m D">Yr, Month D</option>
                                                            </select>
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.ColorText')}}</label>
                                                            <input type="color" class="form-control form-control-lg" placeholder="#0000000" name="color_text" v-model="options.color_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_year" v-model="options.date_year" :value="1">
                                                            <label>{{__('dashboard.AllowYear')}} </label>
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_month" v-model="options.date_month" :value="1">
                                                            <label>{{__('dashboard.AllowMonth')}}</label>
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_day" v-model="options.date_day" :value="1">
                                                            <label>{{__('dashboard.AllowDay')}}</label>
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.TextBeforeDate')}}</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="text before date" name="text_before_date" v-model="options.text_before_date">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.TextAfterDate')}}</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="text after date" name="text_after_date" v-model="options.text_after_date">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FontSizeText')}} ( <strong>{{__('dashboard.sizebypx')}}</strong> ) </label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="12px" name="font_size_text" v-model="options.font_size_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.Font')}}</label>
                                                            <select class="form-control form-check-input" placeholder="font type" name="font_type" v-model="options.font_type" style="width: 100%;">
                                                                <option v-for="(Font,key) in Fonts" :key="key" :value="Font.id"> {{ Font.name }} </option>
                                                            </select>
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.DirectionText')}}</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="RTL or RTL" name="direction_text" v-model="options.direction_text">
                                                        </div>
                                                    </li>

                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.TestDate')}}</label>
                                                            <input type="date" class="form-control" placeholder="text for test" name="text_for_test" v-model="options.text_for_test" required>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="alert alert-default alert-setting" v-if="edit_element == key && draggable.type_field == 2">
                                            <div class="row">
                                                <ul class="col-12 list-unstyled setting-list">
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.FieldName')}}</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="Field Name" name="field_name" v-model="options.field_name">
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.ImageWidth')}}</label>
                                                            <input type="number" class="form-control" placeholder="Image Width" name="image_width" v-model="options.image_width" required>
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.ImageHeight')}}</label>
                                                            <input type="number" class="form-control" placeholder="Image Height" name="image_height" v-model="options.image_height" required>
                                                        </div>
                                                    </li>
                                                    <li class="col-4">
                                                        <div class="form-group">
                                                            <label>{{__('dashboard.ImageAsBackground')}}</label>
                                                            <input type="checkbox" placeholder="Image Height" name="image_asBackground"  v-model="options.image_asBackground" :value="1">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="row">
                                <div id="accordion" class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h4 id="items-settings"  class="card-title card-title-dash">{{__('dashboard.Fields')}}</h4>
                                    </div>
                                    <ul class="list-unstyled list-wrapper col-12 todo-list todo-list-rounded ps-0">

                                        <li>
                                            <div class="alert alert-danger" v-if="errors.length != 0">
                                                <p v-for="error in errors" :key="error">{{ error }}</p>
                                            </div>
                                        </li>

                                        <li class="mb-1 col-md-3 d-block list-item">
                                            <a type="button" class=" align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse-3" aria-controls="home-collapse-3" aria-expanded="false">
                                            {{__('dashboard.TextLine')}}
                                            </a>
                                            <div class="collapse multi-collapse" id="home-collapse-3" style="">
                                                <form method="post" @submit.prevent="SubmitTextLine">
                                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.edit">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.key">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.type_field">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FieldName') }}</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="Field Name" name="field_name" v-model="new_options.field_name">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.MaxWords')}}</label>
                                                                <input type="number" class="form-control form-control-lg" placeholder="-1" name="max_words" v-model="new_options.max_words">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.MinWords')}}</label>
                                                                <input type="number" class="form-control form-control-lg" placeholder="-1" name="min_words" v-model="new_options.min_words">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.Maxcharacters')}}</label>
                                                                <input type="number" class="form-control form-control-lg" placeholder="-1" name="max_characters" v-model="new_options.max_characters">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{ __('dashboard.Mincharacters') }}</label>
                                                                <input type="number" class="form-control form-control-lg" placeholder="-1" name="min_characters" v-model="new_options.min_characters">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.ColorText')}}</label>
                                                                <input type="color" class="form-control form-control-lg" placeholder="#0000000" name="color_text" v-model="new_options.color_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FontSizeText')}} ( <strong>{{__('dashboard.sizebypx')}}</strong> ) </label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="12px" name="font_size_text" v-model="new_options.font_size_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.Font')}}</label>
                                                                <select @change="setFont($event)" class="form-control form-check-input" placeholder="font type" name="font_id" v-model="new_options.font_id" style="width: 100%;">
                                                                    <option v-for="(Font,key) in Fonts"
                                                                            :key="key"
                                                                            :value="Font.id"
                                                                            :font="JSON.stringify(Font)"> {{ Font.name }} </option>
                                                                </select>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.DirectionText')}} ( {{__('dashboard.RTLorRTL')}} )</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="RTL or RTL" name="direction_text" v-model="new_options.direction_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.textAlign')}} </label>
                                                                <select class="form-control form-check-input" placeholder="Text align" v-model="new_options.text_align" style="width: 100%;">
                                                                    <option value="right" selected>{{ __('master.right') }}</option>
                                                                    <option value="left">{{ __('master.left') }}</option>
                                                                    <option value="center">{{ __('master.center') }}</option>
                                                                </select>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.long_text')}}</label>
                                                                <input type="checkbox" placeholder="RTL or RTL" name="type_input" v-model="new_options.type_input" :value="1">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.TextForTest')}}</label>
                                                                <textarea type="text" class="form-control" placeholder="text for test" name="text_for_test" v-model="new_options.text_for_test" required></textarea>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                    <button type="submit" class="add btn btn-icons btn-rounded btn-primary text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                                </form>
                                            </div>
                                        </li>

                                        <li class="mb-1 col-md-3 d-block list-item">
                                            <a type="button" class=" align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse-1" aria-expanded="false" aria-controls="home-collapse-1">
                                            {{__('dashboard.DateandTime')}}
                                            </a>
                                            <div class="collapse multi-collapse" id="home-collapse-1" style="">
                                                <form method="post" @submit.prevent="SubmitDataTime">
                                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.edit">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.key">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.type_field">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FieldName') }}</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="Field Name" name="field_name" v-model="new_options.field_name">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_year" v-model="new_options.date_year" :value="1">
                                                                <label>{{__('dashboard.AllowYear')}} </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_month" v-model="new_options.date_month" :value="1">
                                                                <label>{{__('dashboard.AllowMonth')}}</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="checkbox" class="form-check-input" placeholder="#0000000" name="date_day" v-model="new_options.date_day" :value="1">
                                                                <label>{{__('dashboard.AllowDay')}}</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FormateDate')}} </label>
                                                                <select class="form-control form-check-input" name="formate_date" v-model="new_options.formate_date" style="width: 100%;">
                                                                    <option selected      > default </option>
                                                                    <option value="M/D/Y" >MM/DD/YY</option>
                                                                    <option value="D/M/Y" >DD/MM/YY</option>
                                                                    <option value="Y/M/D" >YY/MM/DD</option>
                                                                    <option value="M-D-Y" >MM-DD-YY</option>
                                                                    <option value="D-M-Y" >DD-MM-YY</option>
                                                                    <option value="Y-M-D" >YY-MM-DD</option>
                                                                    <option value="m d, y">Month Day, Year</option>
                                                                    <option value="D m, y">D Month, Year</option>
                                                                    <option value="y, m D">Yr, Month D</option>
                                                                </select>
                                                            </div>
                                                        </li>

                                                        <!-- <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.MaxDate')}}</label>
                                                                <input type="date" class="form-control form-control-lg" placeholder="max date" name="max_date" v-model="options.max_date">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.MinDate')}}</label>
                                                                <input type="date" class="form-control form-control-lg" placeholder="min date" name="min_date" v-model="options.min_date">
                                                            </div>
                                                        </li> -->

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.TextBeforeDate')}}</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="text before date" name="text_before_date" v-model="new_options.text_before_date">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.TextAfterDate')}}</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="text after date" name="text_after_date" v-model="new_options.text_after_date">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.ColorText')}}</label>
                                                                <input type="color" class="form-control form-control-lg" placeholder="#0000000" name="color_text" v-model="new_options.color_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FontSizeText')}} ( <strong>{{__('dashboard.sizebypx')}}</strong> ) </label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="12px" name="font_size_text" v-model="new_options.font_size_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.Font')}}</label>
                                                                <select class="form-control form-check-input" placeholder="font type" name="font_type" v-model="new_options.font_type" style="width: 100%;">
                                                                    <option v-for="(Font,key) in Fonts" :key="key" :value="Font.id"> {{ Font.name }} </option>
                                                                </select>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.DirectionText')}} ( {{__('dashboard.RTLorRTL')}} )</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="RTL or RTL" name="direction_text" v-model="new_options.direction_text">
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.TestDate')}}</label>
                                                                <input type="date" class="form-control" placeholder="text for test" name="text_for_test" v-model="new_options.text_for_test" required>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="add btn btn-icons btn-rounded btn-primary text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                                </form>
                                            </div>
                                        </li>

                                        <li class="mb-1 col-md-3 d-block list-item">
                                            <a type="button" class=" align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse-2" aria-expanded="false" aria-controls="home-collapse-2">
                                                {{__('dashboard.ImageandLogo')}}
                                            </a>

                                            <div class="collapse multi-collapse" id="home-collapse-2" style="">
                                                <form method="post" @submit.prevent="SubmitImageAndLogo">
                                                    <br/>
                                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                        <li>
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.edit">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.key">
                                                                <input type="hidden" class="form-control form-control-lg" placeholder="-1" v-model="new_options.type_field">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.FieldName')}}</label>
                                                                <input type="text" class="form-control form-control-lg" placeholder="Field Name" name="field_name" v-model="new_options.field_name">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.ImageWidth')}}</label>
                                                                <input type="number" class="form-control" placeholder="Image Width" name="image_width" v-model="new_options.image_width" required>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.ImageHeight')}}</label>
                                                                <input type="number" class="form-control" placeholder="Image Height" name="image_height" v-model="new_options.image_height" required>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-group">
                                                                <label>{{__('dashboard.ImageAsBackground')}}</label>
                                                                <input type="checkbox" placeholder="Image Height" name="image_asBackground" v-model="new_options.image_asBackground" :value="1">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="add btn btn-icons btn-rounded btn-primary text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                                </form>
                                            </div>
                                        </li>

                                    </ul>
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
import interact from "interactjs";
export default {
    data() {
        return {
            screenX: 20,
            screenY: 20,
            options:{
                edit:-1,
                target:null,
                type_field:1,
                font:null
            },
            new_options:{
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
            saved_launch:0,
            edit_element:null,
        };
    },
    props: ["certification","image",'Fonts','width','height'],
    mounted:function(){
        let self = this;
        this.draggables = this.certification.options;
        console.log(this.draggables);
        this.index      = this.certification.options.length;
        setTimeout(function(){
            self.certification.options.forEach(function(draggable,key){
                self.initInteract(document.getElementById(`myDraggable${draggable.id}`));
            });
        },2000);
        console.log(this.certification);
    },
    methods: {
        initInteract: function(selector) {
            let self = this;
            interact(selector).draggable({
                // enable inertial throwing
                inertia: true,
                // keep the element within the area of it's parent
                restrict: {
                    restriction: "parent",
                    endOnly: false,
                    elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
                },
                // enable autoScroll
                autoScroll: false,
                // call this function on every dragmove event
                onmove: this.dragMoveListener,
                // call this function on every dragend event
                onend: this.onDragEnd
            }).resizable({
                // resize from all edges and corners
                edges: { left: true, right: true, bottom: true, top: true },
                listeners: {
                    move (event) {
                        var target = event.target
                        var x = (parseFloat(target.getAttribute('data-x')) || 0)
                        var y = (parseFloat(target.getAttribute('data-y')) || 0)
                        let dimensions = target.getBoundingClientRect();

                        // update the element's style
                        target.style.width = event.rect.width + 'px'
                        target.style.height = event.rect.height + 'px'

                        // translate when resizing from top or left edges
                        x += event.deltaRect.left
                        y += event.deltaRect.top

                        target.style.transform = 'translate(' + x + 'px,' + y + 'px)'

                        target.setAttribute('data-x', x)
                        target.setAttribute('data-y', y)

                        self.draggables[target.getAttribute('item')].transformX = x;
                        self.draggables[target.getAttribute('item')].transformY = y;
                        self.draggables[target.getAttribute('item')].height_box = event.rect.height;
                        self.draggables[target.getAttribute('item')].width_box  = event.rect.width;

                        self.draggables[target.getAttribute('item')].recX      = dimensions.x;
                        self.draggables[target.getAttribute('item')].recY      = dimensions.y;
                        self.draggables[target.getAttribute('item')].recHeight = dimensions.height;
                        self.draggables[target.getAttribute('item')].recWidth  = dimensions.width;
                        self.draggables[target.getAttribute('item')].recTop    = target.getBoundingClientRect().y - document.getElementById('certificationOverview').getBoundingClientRect().y;
                        self.draggables[target.getAttribute('item')].recBottom = dimensions.bottom;
                        self.draggables[target.getAttribute('item')].recLeft   = target.getBoundingClientRect().x - document.getElementById('certificationOverview').getBoundingClientRect().x;
                        self.draggables[target.getAttribute('item')].recRight  = dimensions.right;
                        //console.log(" height : "+event.rect.height);
                        console.log(dimensions.y + ' ' + dimensions.x);
                        // target.textContent = Math.round(event.rect.width) + '\u00D7' + Math.round(event.rect.height)
                    }
                },
                modifiers: [
                    // keep the edges inside the parent
                    interact.modifiers.restrictEdges({
                        outer: 'parent'
                    }),

                    // minimum size
                    interact.modifiers.restrictSize({
                        min: { width: 100, height: 50 }
                    })
                ],
                inertia: true
            });
        },
        dragMoveListener: function(event) {
            var target = event.target,
            // keep the dragged position in the data-x/data-y attributes
            x = (parseFloat(target.getAttribute("data-x")) || this.screenX) + event.dx,
            y = (parseFloat(target.getAttribute("data-y")) || this.screenY) + event.dy;

            // translate the element
            target.style.webkitTransform = target.style.transform = "translate(" + x + "px, " + y + "px)";

            // update the posiion attributes
            target.setAttribute("data-x", x);
            target.setAttribute("data-y", y);

        },
        onDragEnd: function(event) {
            let self = this;
            var target = event.target;
            let dimensions = target.getBoundingClientRect();
            var x = (parseFloat(target.getAttribute('data-x')) || 0);
            var y = (parseFloat(target.getAttribute('data-y')) || 0);
            // update the state
            this.screenX = target.getBoundingClientRect().left;
            this.screenY = target.getBoundingClientRect().top;
            self.draggables[target.getAttribute('item')].transformX = x;
            self.draggables[target.getAttribute('item')].transformY = y;
            self.draggables[target.getAttribute('item')].recX      = dimensions.x;
            self.draggables[target.getAttribute('item')].recY      = dimensions.y;
            self.draggables[target.getAttribute('item')].recHeight = dimensions.height;
            self.draggables[target.getAttribute('item')].recWidth  = dimensions.width;
            self.draggables[target.getAttribute('item')].recTop    = target.getBoundingClientRect().y - document.getElementById('certificationOverview').getBoundingClientRect().y;
            self.draggables[target.getAttribute('item')].recBottom = dimensions.bottom;
            self.draggables[target.getAttribute('item')].recLeft   = target.getBoundingClientRect().x - document.getElementById('certificationOverview').getBoundingClientRect().x;
            self.draggables[target.getAttribute('item')].recRight  = dimensions.right;

            // let style = getComputedStyle(target);
            // let marginLeft = parseInt(style.marginLeft);
            // let marginRight = parseInt(style.marginRight);
            // let marginTop = parseInt(style.marginTop);
            // let marginBottom = parseInt(style.marginBottom);
            console.log(' top : ' + target.getBoundingClientRect().y);
            console.log(' left : ' + target.getBoundingClientRect().x);

            console.log(' top parent : ' + ( target.getBoundingClientRect().y - document.getElementById('certificationOverview').getBoundingClientRect().y));
            console.log(' left parent : ' + ( target.getBoundingClientRect().x - document.getElementById('certificationOverview').getBoundingClientRect().x));
        },
        SubmitOptions:function(){
            let words_array = this.options.text_for_test ? this.options.text_for_test.split(' ') : [];
            this.errors     = [];

            // validate max words
            if(this.options.max_words != null){
                if(words_array.length > this.options.max_words){
                    this.errors.push("Max words is must less than " + this.options.max_words);
                    window.location.href="#items-settings";
                    console.log(this.errors);
                    return;
                }
            }

            // validate min words
            if(this.options.min_words != null){
                if(words_array.length < this.options.min_words){
                    this.errors.push("min words is must greater than " + this.options.min_words);
                    window.location.href="#items-settings";
                    console.log(this.errors);
                    return;
                }
            }

            // validate max characters
            if(this.options.max_characters != null){
                if(this.options.text_for_test.length > this.options.max_characters){
                    this.errors.push("max characters is must less than " + this.options.max_characters);
                    window.location.href="#items-settings";
                    console.log(this.errors);
                    return;
                }
            }

            // validate min characters
            if(this.options.min_characters != null){
                if(this.options.text_for_test.length < this.options.min_characters){
                    this.errors.push("min characters is must greater than " + this.options.min_characters);
                    window.location.href="#items-settings";
                    console.log(this.errors);
                    return;
                }
            }

            // validate min characters
            // let D   = new Date(this.options.text_for_test);
            // if(this.options.date_year){
            //     let year = D.getFullYear();
            //     if(!year){
            //         this.errors.push("Year not exist in test date must contain on Year. ");
            //         window.location.href="#items-settings";
            //         console.log(this.errors);
            //         return;
            //     }
            // }

            // if(this.options.date_month){
            //     let month = D.getMonth();
            //     if(!month){
            //         this.errors.push("Month not exist in test date must contain on Month. ");
            //         window.location.href="#items-settings";
            //         console.log(this.errors);
            //         return;
            //     }
            // }

            // if(this.options.date_day){
            //     let day = D.getDay();
            //     if(!day){
            //         this.errors.push("Day not exist in test date must contain on Day. ");
            //         window.location.href="#items-settings";
            //         console.log(this.errors);
            //         return;
            //     }
            // }

            if(this.options.edit == -1){
                this.AddNewDrag();
            }
            else{
                this.EditDrag();
            }
        },
        AddNewDrag:async function(){
            this.index +=1;
            this.options.key = this.index;
            await this.draggables.push(this.options);
            await this.initInteract(document.getElementById(`myDraggable${this.index}`));
            this.options = {
                edit:-1,
                target:null
            };
        },
        DeleteOptions:function(option,key){
            interact(document.getElementById(`myDraggable${option.id || option.key}`)).unset();
            this.draggables.splice(key,1);
            if(option.id){
                this.deletes.push(option.id);
            }
        },
        EditDrag:function(){
            this.draggables[this.options.edit] = this.options;
            this.options = {
                edit:-1,
                target:null
            };
        },
        SubmitTextLine:function(){
            this.options = this.new_options;
            this.options.target     = 'home-collapse-3';
            this.options.type_field = 1;
            console.log(this.draggables);
            this.SubmitOptions();
            console.log(this.options);
            console.log(this.draggables);
            this.new_options = {
                edit:-1,
                target:null,
                type_field:1,
                font:null
            };
        },
        SubmitImageAndLogo:function(){
            this.options = this.new_options;
            this.options.target = 'home-collapse-2';
            this.options.type_field = 2;
            console.log("hi");
            this.SubmitOptions();
            console.log(this.draggables);
            this.new_options = {
                edit:-1,
                target:null,
                type_field:1,
                font:null
            };
        },
        SubmitDataTime:function(){
            this.options = this.new_options;
            this.options.target = 'home-collapse-1';
            this.options.type_field = 3;
            this.SubmitOptions();
            console.log("hi");
            this.new_options = {
                edit:-1,
                target:null,
                type_field:1,
                font:null
            };
        },
        saveCustomize:async function(){
            let self = this;
            console.log(this.draggables);
            let customize = new FormData();
            customize.append('customaziation',JSON.stringify(this.draggables));
            customize.append('deletes',JSON.stringify(this.deletes));
            this.saved_launch = 1;
            await this.axios.post(`/save-customize-certification/${this.certification.id}`,customize).then(({data}) => {
                self.draggables = data.draggable_updates;
                console.log(data.draggable_updates);
                self.saved_launch = 0;
            }).catch(({response}) => {
                console.log(response.data);
            });
        },
        viewDraggable:function(key){
            if(this.views.indexOf(key) == -1){
                this.views.push(key);
            } else{
                this.views.pop(key);
            }
            console.log(this.views.indexOf(key));
            console.log(this.views);
        },
        setFont:function(event){
            this.options.font = JSON.parse(event.target.querySelector(`option[value="${event.target.value}"]`).getAttribute("font"));
            console.log(this.options);
        },
        EditOption:function(option,key){
            this.options         = option;
            // window.location.href = '#' + option.target;
            // document.querySelectorAll('.show').forEach(function(item){
            //    item.classList.remove('show');
            //    item.setAttribute('class','collapse');
            //    document.getElementById(`${option.target}`).setAttribute('class','show');
            // });
            // this.options.edit    = key;
            this.edit_element = key;
        }
    }
}
</script>
<style scoped>
.list-item{
    padding: 10px;
    border: 12px solid #eee;
}
.card-title-dash{
    padding:10px 0px;
}
.draggable {
  width: 120px;
  padding: 0px 10px;
  margin: 1rem;
  background-color: #29e;
  color: white;
  font-size: 20px;
  font-family: sans-serif;
  touch-action: none;
  /* position: relative;
  display: inline-block; */
  /* This makes things *much* easier */
  box-sizing: border-box;
  position: absolute;
  /*border-radius: 30px;*/
}
.list-item a
{
    font-size: 15px;
    text-decoration: none;
    font-weight: bold;
    color: #1f3bb3;
}
.btn-toggle-nav.list-unstyled li a{
    font-size: 13px;
    color: #000000;
}
.list-wrapper{
    padding-right: 0px;
}
.list-wrapper ul li {
    font-size: 0.9375rem;
    padding: 0;
    border-bottom: unset;
    text-align: right;
}
.btn-toggle-nav li .form-control-lg
{
    min-height: 0.5rem !important;
    height: 0.5rem !important;
    padding: 0.94rem;
}
.options-settings{
    left: 1px;
    top: -5px;
    font-size: 21px;
    color: #880e4f;
    position: absolute;
    background-color: white;
    border-radius: 30px;
    padding: 2px 6px 1px 6px;
    cursor: pointer;
}
.options-delete{
    left: 40px;
    top: -5px;
    font-size: 21px;
    color: #880e4f;
    position: absolute;
    background-color: white;
    border-radius: 30px;
    padding: 2px 6px 1px 6px;
    cursor: pointer;
}
.Label-Field{
    right: 0px;
    top: -25px;
    font-size: 21px;
    color: #880e4f;
    position: absolute;
    border-radius: 30px;
    padding: 2px 6px 1px 6px;
    cursor: pointer;
}
.options-view{
    left: 80px;
    top: -5px;
    font-size: 21px;
    color: #880e4f;
    position: absolute;
    background-color: white;
    border-radius: 30px;
    padding: 2px 6px 1px 6px;
    cursor: pointer;
}
.trans{
    background-color: transparent !important;
}
.loading{
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    text-align: center;
    background-color: #ffffff96;
    z-index: 100000;
}
.loading img{
    position:relative;
    top: 35%;
}
#accordion{
    width:100% !important;
}
#accordion .form-group{
    width: 100%;
}
.list-item{
    display: inline-block !important;
    float: right;
    margin: 10px;
}
.container-certification-image .card-body{
    overflow:auto;
}
#certificationOverview{
    position:relative !important;
    /* width: 1745px;
    height: 1240px; */
    width: auto;
    height: auto;
}
.alert-default.alert-setting
{
    position: absolute;
    left: -100px;
    right: -100px;
    bottom: 90%;
    z-index: -1;
    background-color: white;
    color: #292525;
    border-radius: 0px;
    padding-bottom: 0px;
}
.setting-list{
    padding-right: 20px;
    padding-left: 20px;
    direction: rtl;
    text-align: right;
}
.setting-list li{
    display: inline-block;
}
.setting-list .form-group label{
    font-size: 12px;
}
.setting-list .col-4{
    width: 30.33333%;
}
</style>

@extends('admin.master', ['menu' => 'catbad', 'submenu' => 'Service'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Edit Service')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Service')}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="gallery__area bg-style">
                <div class="gallery__content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-vertical__item bg-style">
                                        <form enctype="multipart/form-data" method="POST" action="{{route('admin.Service.update')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$edit->id}}">
                                            <div class="input__group mb-25">
                                                <label>{{ __('Service Name '.langString('en'))}}</label>
                                                <input type="text" id="en_Service_name" name="en_Service_name" value="{{$edit->en_Service_Name}}" placeholder="Name (English)">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Service Name '.langString('fr'))}}</label>
                                                <input type="text" id="fr_Service_name" name="fr_Service_name" value="{{$edit->fr_Service_Name}}" placeholder="Name (Arabic)">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Icon Class')}}</label>
                                                <input type="text" id="icon_class" name="icon_class" value="{{$edit->Service_Icon}}" placeholder="Icon">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{__('Description '.langString('en'))}}</label>
                                                <textarea name="en_description" id="en_description" placeholder="Description (English)">{{$edit->en_Description}}</textarea>
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{__('Description '.langString('fr'))}}</label>
                                                <textarea name="fr_description" id="fr_description" placeholder="Description (Arabic)">{{$edit->fr_Description}}</textarea>
                                            </div>
                                            <div class="input__button">
                                                <button type="submit" class="btn btn-blue">{{ __('Update')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


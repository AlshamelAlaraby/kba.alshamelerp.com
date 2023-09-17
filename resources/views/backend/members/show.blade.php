@extends('backend.layouts.app')
@section('title','بطاقة اللاعب')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>بطاقة اللاعب</h1>
                </div>
                <div  class="col-sm-6"  >
                   <h1 style="float: left"><a href="javascript:void(0)" onClick="window.print()"><i class="fa fa-print"></i></a></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section id="playerCard" class="content">
        <div class="container-fluid">
            <div class="container mt-5 rows-print-as-pages">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card p-4 text-center front">
                            <h1 class="kbatitl">الاتحاد الكويتي لكرة السلة</h1>
                            <div class="row">
                                <div class="col-md-8 info py-6">
                                        <div style="margin-top: 5.5rem!important;"> <span class="dd">رقم البطاقة:</span> <span class="bottom">{{ $record->playernum }}</span> </div>
                                        <div> <span class="dd">الإسم:</span> <span class="bottom">{{ $record->name }}</span> </div>
                                        <div> <span class="dd">الجنسية:</span> <span class="bottom nationalityClass">{{ optional($record->nationality)->name }}</span> </div>
                                        <div> <span class="dd">النادى:</span> <span class="bottom">{{ $record->cfamily }}</span> </div>
                                        <div> <span class="dd">الصفة:</span> <span class="bottom categoryClass">{{ optional($record->category)->name }}</span> </div>
                                        <div> <span class="dd">الدرجة:</span> <span class="bottom">{{ optional($record->group)->name }}</span> </div>
                                        <div> <span class="dd">تاريخ الميلاد:</span> <span class="bottom">{{ $record->birth_date }}</span> </div>
{{--                                        <div> <span class="dd">تاريخ التسجيل:</span>--}}
{{--                                            <span class="bottom">{{ $record->register_date }}</span>--}}
{{--                                        </div>--}}
                                        <div> <span class="dd">الموسم:</span> <span class="bottom">{{ optional($record->session)->name }}</span> </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ optional($record->getFirstMedia('profile'))->getUrl() }}" class="playerimg">
                                </div>
                                <div class="copy">
                                    <p>أمين السر</p>
                                    <h4>ثامر الشنفا</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div  class="row">
                    <div class="col-md-12">
                        <div class="card back mt-5">
                            <div class="category">
                               بطاقة {{ optional($record->category)->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@php
    $nationality = optional($record->nationality)->name;
    $status = optional($record->status)->name;
    $category = optional($record->category)->name;
    $nationalityColor = "#000000";
    $categoryColor = "#000000";
    //if($status=="نشط"){
    if($nationality!="كويتي"){
        $nationalityColor = "#f90909";
    }
    // }else{
    //     $nationalityColor = "#f90909";
    // }
    if($category != 'لاعب'){
        $categoryColor = "#f90909";
    }
@endphp
@push('css')
    <style>
        .category {
            color: #11a7e4;
            font-weight: bold;
            position: relative;
            top: 450px;
            font-size: 45px;
            text-align: center;
        }
        .nationalityClass{
            color:{{ $nationalityColor }};
        }
        .categoryClass{
            color:{{ $categoryColor }};
        }
        .kbatitl{
            position: absolute;
            top: 20px;
            right: 300px;
            color: #ffffff;
            font-weight: bold;
        }
        .playerimg{
            width: 250px;
            height: 240px;
            position: absolute;
            left: 0px;
            top: 85px;
        }
        .copy{
            background-image: url('{{ asset('signature.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 10px;
            width: 251px;
            height: 150px;
            position: absolute;
            top: 410px;
            left: 7px;
        }
        .copy p {
            position: absolute;
            top: -52px;
            left: 81px;
            font-weight: bold;
            font-size: 23px!important;
            color: #000000;

        }
        .copy h4 {
            position: absolute;
            top: -15px;
            left: 71px;
            font-weight: bold;
            font-size: 23px!important;
            color: #000000;
            padding-top: 10px;
        }
        .front{
            background-image: url('{{ asset('front.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 160mm;
            font-size: 32px!important;
            font-weight: bold;
            color:#000000;

        }
        .front .info{
            text-align: right;
        }

        .front .info span.dd{
            font-weight: bold;
        }
        .back{
            background-image: url('{{ asset('backwithout.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 162mm;
            max-height:100%;

        }
        @media print {
            * {
                -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
                color-adjust: exact !important;  /*Firefox*/,

            }
            /* .rows-print-as-pages .row {
                page-break-before:  always;
                margin: 0!important;
            } */

            .table,table td,table th {
                border: none!important;
                background-color: transparent!important;
            }
            .table td {
                border: none !important;
            }
            @page{
                size: auto;
                margin-left: 0.2cm!important;
                margin-right: 0.2cm!important;
                margin-top: 0cm!important;
                margin-bottom: 0cm!important;
                padding: 0cm!important;
            }


            .printHeader{
                display: none!important;
            }
        }

    </style>
@endpush

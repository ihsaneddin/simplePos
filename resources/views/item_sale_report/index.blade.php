@extends('app')

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Report</div>

                    <div class="panel-body">
                        <div class="well">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center">Report Sold Items from {{$data['startDate']->format('j F, Y')}}
                                        to {{ $data['endDate']->format('j F, Y') }}</h2>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <form class="form-inline" id="report">
                                        <div class="form-group">
                                            <label for="startDate">Start Date</label>
                                            <input type="text" class="form-control datepicker" name="startDate"
                                                   id="startDate" value="{{$data['startDate']->format('Y-m-d')}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="endDate">End Date</label>
                                            <input type="text" class="form-control datepicker" name="endDate"
                                                   id="endDate" value="{{$data['endDate']->format('Y-m-d')}}"/>
                                        </div>
                                        <button type="submit" class="btn btn-default">Generate</button>
                                        <a href="#" class="btn btn-default" id="export">Export</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                @include("item_sale_report._table", array("data" => $data))

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });

        $(document).ready(function(){
            $(document).on("click", "a#export", function(e){
                e.preventDefault();
                form = $("form#report");
                if (form.length){
                    form.attr("action", "/item_sale_reports/export");
                    form.attr("method", "POST");
                    form.submit();
                }
                form.attr("action", "/reports");
                    form.attr("method", "GET");
                return false;
            });
        });

    </script>
@endsection

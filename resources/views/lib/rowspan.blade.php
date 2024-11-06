@extends('layouts.header')
@section('content')
<script type="text/javascript" src="{{ asset('assets\js\plugins\rowspanizer\jquery.rowspanizer.js')}}"></script>
<script>
    $(function(){
        $(".Auto_rowspan").rowspanizer({
            cols : [0], // 첫번째 td부터 0,1,2,3
            vertical_align : "middle"
        });
    })
</script>
<article class="sub-contents">
        <div class="sub-conbox inner-layer">


    

            <div class="sub-contit-wrap">
    <h4 class="sub-contit">대한신경중재치료의학회 임원 명단</h4>
</div>
<div class="table-wrap">
    <table class="cst-table Auto_rowspan">
        <caption class="hide">대한신경중재치료의학회 임원 명단</caption>
        <colgroup>
            <col style="width:33%">
            <col>
            <col style="width:33%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">직책</th>
            <th scope="col">성명</th>
            <th scope="col">소속</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $executive as $eKey => $ex )
            <tr>
                <td>{{ $ex->level }}</td>
                <td>{{ $ex->name_kr }} {{ $ex->name_en }}</td>
                <td>{{ $ex->sosok }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
        </div>
    </article>
@endsection

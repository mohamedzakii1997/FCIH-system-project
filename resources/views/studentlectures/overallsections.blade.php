@extends('layouts.frontend')

@section('title')
  Sections Table
@endsection

@section('extraStyle')
	thead tr th{
	text-align:center
}
td div{
	text-align:center
}
td .course{
	font-weight:bold;
}
td .professor{
	font-size:12px
}
td .location{
  font-size:9px
}
@endsection
@section('content')

<div class="container">
		<table class="table table-bordered">
			 <thead>
			    <tr>
                    <th>day</th>
                    <th scope="col">8</th>
				    <th scope="col">9</th>
				    <th scope="col">10</th>
				    <th scope="col">11</th>
				    <th scope="col">12</th>
				    <th scope="col">1</th>
				    <th scope="col">2</th>
				    <th scope="col">3</th>
				    <th scope="col">4</th>
				    <th scope="col">5</th>
				    <th scope="col">6</th>
				    <th scope="col">7</th>
				    <th scope="col">8</th>
				    <th scope="col">9</th>
			    </tr>
			 </thead>
<tbody>

@php $days=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday'] @endphp
@for($q=0;$q<count($sectiondays);$q++)
@if($maxes[$q]!=0)
  <tr>
    <td  rowspan="{{$maxes[$q]}}">{{$days[$q]}}</td>
    @php
        $sections=$sectiondays[$q];
      $lastSection=null;
      $flag=false;
    @endphp
    @for($r=0;$r<$maxes[$q];$r++)
      @if($flag)
        <tr>
      @endif
    @for($k=0;$k<$sections->count(); $k++)
      @if(empty($lastSection))
          @for($i=0;$i<($sections[$k]->time-8);$i++)
            <td></td>
          @endfor
          <td colspan="{{$sections[$k]->duration}}">
            <div class="course">{{$sections[$k]->course->englishName}}</div>
            <div class="professor">ass: {{$sections[$k]->assistant->englishName}}</div>
            <div class="location">{{$sections[$k]->location}}</div>
          </td>
          @php
            $lastSection=$sections[$k];
            $sections->forget($k);
            $k--;
            $sections=$sections->values();
          @endphp
                    
                    @if($sections->count()==0)
             
                       @for($g=0;$g<22-($lastSection->time+$lastSection->duration);$g++)
            <td></td>
              @endfor
             </tr> 
                    @endif 
      @else
        @if($sections[$k]->time >=$lastSection->time && $sections[$k]->time<($lastSection->time+$lastSection->duration))
        @if(!(($k+1)<$sections->count())) 
           
                     @for($f=0;$f<22-($lastSection->time+$lastSection->duration);$f++)
                  <td></td>
                @endfor
             </tr> 
           @php 
               $flag=true; $lastSection=null; 
           @endphp 
        @endif
          @continue;

        @else
          @for($i=0;$i<($sections[$k]->time-($lastSection->time+$lastSection->duration));$i++)
            <td></td>
          @endfor
          <td colspan="{{$sections[$k]->duration}}">
            <div class="course">{{$sections[$k]->course->englishName}}</div>
            <div class="professor">Ass: {{$sections[$k]->assistant->englishName}}</div>
            <div class="location">{{$sections[$k]->location}}</div>
          </td>
        @endif
        @if($k==$sections->count()-1)
          @for($i=0;$i<22-($sections[$k]->time+$sections[$k]->duration);$i++)
            <td></td>
          @endfor
          </tr>
          @php
            $sections->forget($k);
            $k--;
            $sections=$sections->values();
            $lastSection=null;
            $flag=true;
            break;
          @endphp
        @else
          @php
            $lastSection=$sections[$k];
            $sections->forget($k);
            $k--;
            $sections=$sections->values();
          @endphp
        @endif

      @endif

    @endfor
    @endfor

   @else
<tr>
<td>{{$days[$q]}}</td>
  @for($i=0;$i<14;$i++)
    <td></td>
  @endfor
</tr> 
    @endif 
@endfor


</tbody>





		</table>


	</div>

@endsection